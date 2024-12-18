<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function allProducts(){
        $products = Product::paginate(2);
        return response()->json(['data'=>$products],200);
    }

}
