<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model{
    use HasFactory;

    protected $fillable = [
        'title',
        'handle',
        'shop_id',
        'template_suffix',
        'shopify_page_id',
        'template_contents',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'template_contents' => 'object',
    ];

    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }

    public function getUrlAttribute(){
    	return "https://{$this->shop->domain}/pages/{$this->handle}";
	}
}
