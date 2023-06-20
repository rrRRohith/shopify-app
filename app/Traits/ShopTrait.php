<?php

namespace App\Traits;
use Signifly\Shopify\Shopify;
use App\Models\Shop;

trait ShopTrait{
    public function init_shop(Shop $shop) : bool{

        $collection = $this->fetch_collections($shop);
        $theme = $this->set_theme($shop);

        return ($collection || $theme) ? true : false;
    }
    public function fetch_collections(Shop $shop) : bool{

        $shopify = new Shopify(
            $shop->api_key,
            $shop->api_password,
            $shop->url,
            $shop->api_version
        );
        try{
            $custom_collections = $shopify->get('custom_collections.json');
            $smart_collections = $shopify->get('smart_collections.json');

            foreach((array) $custom_collections->collect()['custom_collections'] as $collection){
                $filteredParameters = array_intersect_key((array) $collection, array_flip(['title', 'handle']));
                $shop->collections()->firstOrcreate($filteredParameters);
            }
            foreach((array) $smart_collections->collect()['smart_collections'] as $collection){
                $filteredParameters = array_intersect_key((array) $collection, array_flip(['title', 'handle']));
                $shop->collections()->firstOrcreate($filteredParameters);
            }
            return true;
        }
        catch(\Exception $e){
            return false;
        }
    }

    public function set_theme(Shop $shop) : bool{
        $shopify = new Shopify(
            $shop->api_key,
            $shop->api_password,
            $shop->url,
            $shop->api_version
        );

        try{
            $response = $shopify->get('themes.json');
            foreach((array) $response->collect()['themes'] as $theme){
                if($theme['role'] === 'main'){
                    $shop->update([
                        'theme_id' => $theme['id'] ?? null,
                    ]);
                    return true;
                }
            }
            return true;
        }
        catch(\Exception $e){
            return false;
        }
    }
}