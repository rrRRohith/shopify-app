<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Requests\PageRequest;
use Signifly\Shopify\Shopify;
use App\Models\Shop;
use App\Traits\PageTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Http\Requests\SavePageRequest;
use App\Http\Requests\DuplicatePageRequest;

class PageController extends Controller{
    use PageTrait, UploadTrait;

    protected $shop;
    protected $shopify;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('shop');
        $this->middleware(function ($request, $next) {
            $this->shop = shop();
            $this->shopify = new Shopify(
                $this->shop->api_key,
                $this->shop->api_password,
                $this->shop->url,
                $this->shop->api_version
            );
            return $next($request);
        });
        $this->shop = shop();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pages = $this->shop->pages()->paginate(10);
        return view('pages.index')->withPages($pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('pages.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request){
        try{
            $page = $this->shop->pages()->create($request->validated());
            $page->update([
                'template_suffix' => "indig_{$page->id}",
            ]);
            if($this->savePage($page))
                return redirect()->route('pages.edit', ['page' => $page->id])->with('success', 'Page saved successfully');

            return redirect()->route('pages.edit', ['page' => $page->id])->with('warning', 'Page saved successfully,  but unfortunately couldn\'t connect to shopify API, please make sure the creditions are correct.');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page){
        return view('pages.editor.index')->withPage($page)->withCollections($this->shop->collections);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page){
        return view('pages.form')->withPage($page);
    }

    /**
     * Duplicate the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Page $page){
        return view('pages.duplicator')->withPage($page);
        /*try{
            $page_duplicate = $page->replicate();
            $page_duplicate->push();
            $page_duplicate->update([
                'title' => "Duplicate of {$page_duplicate->title}",
                'handle' => "duplicate-of-{$page_duplicate->handle}",
                'template_suffix' => "indig_{$page_duplicate->id}",
                'shopify_page_id' => null,
            ]);
            if($this->savePage($page_duplicate))
                return redirect()->back()->with('success', 'Page duplicated successfully');

            return redirect()->back()->with('warning', 'Page duplicated successfully,  but unfortunately couldn\'t connect to shopify API, please make sure the creditions are correct.');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }*/
    }

    /**
     * Duplicate the specified resource.
     *
     * @param  \App\Http\Requests\DuplicatePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function saveDuplicate(DuplicatePageRequest $request, Page $page){
        try{
            foreach((array) $request->pages as $pageRequest){
                $page_duplicate = $page->replicate();
                $page_duplicate->push();
                $page_duplicate->update([
                    'title' => $pageRequest['title'] ?? "Duplicate of {$page_duplicate->title}",
                    'handle' => $pageRequest['handle'] ?? null,
                    'template_suffix' => "indig_{$page_duplicate->id}",
                    'status' => $pageRequest['status'] ?? null,
                    'shopify_page_id' => null,
                ]);

                $replacers = (array) ($pageRequest['replacer'] ?? []);
                if(count($replacers))
                    $this->replaceStrings($page_duplicate, $replacers);

                if(!$this->savePage($page_duplicate))
                    return redirect()->route('pages.index')->with('warning', 'Unfortunately couldn\'t connect to shopify API, please make sure the creditions are correct.');
            }
            return redirect()->route('pages.index')->with('success', 'Page duplicated successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page){
        try{
            $page->update($request->validated());
            if($this->updatePage($page))
                return redirect()->back()->with('success', 'Page updated successfully');

            return redirect()->back()->with('warning', 'Page updated successfully,  but unfortunately couldn\'t connect to shopify API, please make sure the creditions are correct.');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }
    }

    /**
     * Save the specified resource in storage.
     *
     * @param  \App\Http\Requests\SavePageRequest  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function save(SavePageRequest $request, Page $page){
        try{
            $page->update($request->validated());
            if($this->pushTemplate($page))
                return $request->ajax() ? response()->json([
                    'success' => true,
                    'message' => 'Page contents saved successfully.'
                ]) : redirect()->back()->with('success', 'Page contents successfully');
                
            return $request->ajax() ? response()->json([
                    'success' => true,
                    'message' => 'Page contents saved successfully, but unfortunately couldn\'t connect to shopify API.',
                ]) : redirect()->back()->with('success', 'Page contents saved successfully, but unfortunately couldn\'t connect to shopify API.');
        }
        catch(\Exception $e){
            return $request->ajax() ? response()->json([
                'success' => false,
                'message' => 'Sorry, something went wrong.'
            ]) : redirect()->back()->with('error', 'Sorry, something went wrong.');
        }
        
    }

    /**
     * Upload image to storage and return full path.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function image(Request $request, Page $page){
        try{
            if($image = $this->upload('image','/uploads/static/'))
                return response()->json([
                    'success' => true,
                    'image' => asset('uploads/static/'.$image),
                ]);
            
        }
        catch(\Exception $e){}
        return response()->json([
            'success' => false,
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page){
        try{
            $this->deletePage($page);
            $page->delete();
            return redirect()->back()->with('success', 'Page deleted successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }
    }
}
