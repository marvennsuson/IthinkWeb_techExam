<?php

namespace App\Transformers;

use Illuminate\Support\Str;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract{

	protected $availableIncludes = [
    ];


	public function transform(Product $product) {

	    return [
	     	'id' => $product->id,
	     	'product_name' => Str::title($product->name) ?: "",
            'product_description' => $product->description ?: "",
            'price' => "₱".number_format($product->price , 2) ?: "",
	     ];
	}
}
