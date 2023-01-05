<?php

namespace App\CacheManager;

use Illuminate\Support\Facades\Cache;
use App\Models\Product;

class ProductStatisticsCache{

	public static function clear(){

		Cache::forget('productCount');
	}


	public static function write(){
		
		$productCount = Product::all()->count();
        Cache::put('productCount', $productCount);

	}

	public static function read(){

		$productCount = Cache::get('productCount');
        if($productCount == null){
            self::write();
            $productCount = Cache::get('productCount');
        }

        return [
            'productCount' => $productCount
        ];
	}
}

?>