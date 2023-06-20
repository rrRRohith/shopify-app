<?php

namespace App\Traits;
use App\Models\Page;
use Signifly\Shopify\Exceptions\NotFoundException;
use PHPHtmlParser\Dom;

trait PageTrait{
    public function savePage(Page $page){
        try{
            $this->pushTemplate($page);
            $shopifyPage = $this->shopify->createPage([
                'title' => $page->title,
                'handle' => $page->handle ?? null,
                'body_html' => "",
                'published_at' => $page->status == 'publish' ? now() : null,
                'template_suffix' => $page->template_suffix,
            ]);
            $page->update([
                'shopify_page_id' => $shopifyPage['id'],
                'handle' => $shopifyPage['handle'],
            ]);
            return true;
        }
        catch(\Exception $e){
            return false;
        }
    }

    public function updatePage(Page $page){
        try{
            $this->pushTemplate($page);
            $shopifyPage = $this->shopify->updatePage($page->shopify_page_id, [
                'title' => $page->title,
                'handle' => $page->handle ?? null,
                'body_html' => "",
                'published_at' => $page->status == 'publish' ? now() : null,
                'template_suffix' => $page->template_suffix,
            ]);
            $page->update([
                'handle' => $shopifyPage['handle'],
            ]);
            return true;
        }
        catch(\Exception $e){
            if($e instanceof NotFoundException)
                return $this->savePage($page);
            return false;
        }
    }

    public function deletePage($page){
        try{
            $this->shopify->deletePage($page->shopify_page_id);
            $this->deleteTemplate($page);
        }
        catch(\Exception $e){
            return true;
        }
    }

    public function pushTemplate(Page $page){
        try{
            $template = $this->shopify->put("themes/{$this->shop->theme_id}/assets.json", [
                'theme_id' => $this->shop->theme_id,
                "asset" => [
                    'key' => "templates/page.{$page->template_suffix}.liquid",
                    'value' => view('vendor.page.index', ['page' => $page])->render(),
                ],
            ]);
            return $template->collect()['asset'] ?? null;
        }
        catch(\Exception $e){
            return false;
        }
        
    }

    private function deleteTemplate(Page $page){
        return $this->shopify->delete("themes/{$this->shop->theme_id}/assets.json", [
            'theme_id' => $this->shop->theme_id,
            "asset" => [
                'key' => "templates/page.{$page->template_suffix}.liquid",
            ],
        ]);
    }

    public function replaceStrings(Page $page, array $replacers){
        foreach($replacers as $replacer){
            $find = $replacer['find'] ?? null;
            $replace = $replacer['replace'] ?? null;
            if($find && $replace){
                try{
                    $this->startReplace($find, $replace, $page);
                }
                catch(\Exception $e){
                    continue;
                }
            }
        }
        return $page;
    }

    private function startReplace(string $find, string $replace, Page &$page){
        $templateContents = $newContents = $page->template_contents;
        foreach($templateContents as $key => $content){
            $html_content = isset($content->html_content) ? $content->html_content : null;
            if($html_content){
                $content->html_content = $this->replaceContent($html_content, $find, $replace);
            }

            $sections = $newSections = isset($content->sections) ? $content->sections : [];
            if(count($sections)){
                foreach($sections as $key2 => $section){
                    $html_content = isset($section->html_content) ? $section->html_content : null;
                    if($html_content){
                        $section->html_content = $this->replaceContent($html_content, $find, $replace);
                    }
                    $content->sections[$key2] = $section;
                }
            }
            
            $newContents->{$key} = $content;
        }
        $page->update([
            'template_contents' => $newContents,
        ]);
    }

    private function replaceContent(string $html_content, string $find, string $replace){
        $dom = new \DOMDocument();
        $dom->loadHTML($html_content, LIBXML_HTML_NODEFDTD);
        $xPath = new \DOMXPath($dom);
        $texts = $xPath->evaluate("//text()");
        foreach($texts as $textNode) {
            $textNode->nodeValue = str_ireplace($find, $replace, $textNode->nodeValue);
        }
        $html_content = $dom->saveHTML();
        return $html_content;
    }
}