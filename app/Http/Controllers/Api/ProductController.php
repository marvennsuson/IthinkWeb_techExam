<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Transformers\ProductTransformer;

class ProductController extends Controller
{
    
    public function index(Request $request){
        return 'true';
    }

    public function show($id = null){
        return 'true';
    }

    public function store(ProductRequest $product){
        return 'true';
    }

    public function destroy(Request $request, $id = null){
        return 'true';
    }
}
