<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\ShopRequest;
use Signifly\Shopify\Shopify;
use App\Traits\ShopTrait;

class ShopController extends Controller{
    use ShopTrait;
    protected $shop;
    protected $shopify;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $shops = Shop::paginate(10);
        return view('shops.index')->withShops($shops);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('shops.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ShopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request){
        try{
            $shop = Shop::create($request->validated());
            if($this->init_shop($shop))
                return redirect()->route('shops.edit', ['shop' => $shop->id])->with('success', 'Shop saved successfully');

            return redirect()->route('shops.edit', ['shop' => $shop->id])->with('warning', 'Shop saved successfully, but unfortunately couldn\'t connect to shopify API, please make sure the creditions are correct.');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop){
        return view('shops.form')->withShop($shop);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop){
        return view('shops.form')->withShop($shop);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ShopRequest  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, Shop $shop){
        try{
            $shop->update($request->validated());
            if($this->init_shop($shop))
                return redirect()->back()->with('success', 'Shop updated successfully');

            return redirect()->back()->with('warning', 'Shop updated successfully, but unfortunately couldn\'t connect to shopify API, please make sure the creditions are correct.');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop){
        try{
            $shop->delete();
            return redirect()->back()->with('success', 'Shop deleted successfully');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }
    }

    /**
     * Login to shop.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function login(Shop $shop){
        try{
            \Session::put('shop_id', $shop->id);
            return redirect()->route('home');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', 'Sorry, something went wrong.');
        }
    }
}
