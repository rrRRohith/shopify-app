<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'custom_url',
        'api_key',
        'api_password',
        'api_version',
        'theme_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function pages(){
		return $this->hasMany('App\Models\Page');
	}

    public function getDomainAttribute(){
    	return $this->custom_url ?? $this->url;
	}

    public function collections(){
		return $this->hasMany('App\Models\Collection');
	}
}
