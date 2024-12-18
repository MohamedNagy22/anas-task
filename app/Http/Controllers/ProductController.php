<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function showSpecificProduct($id)
        {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['message'=>'Product dont found'],404);
            }else{
                // return response()->json(['product'=>$product],404);
                return view('product.showSpecificProduct')->with("product",$product);
            }
        }
    public function expensiveProduct($minPrice){
        $product = Product::where('price','>',$minPrice)->get();
        return view('product.showProductsWithPriceGreater')->with("product",$product)->with("minPrice",$minPrice);
    }
    public function allProducts(){
        $products = Product::all();
        $userRole = Auth::user()->role;
        if($userRole === 'admin'){
            return view('admin.allProducts')->with("products",$products);
        }else{
            return view('user.allProducts')->with("products",$products);
        }
    }
    public function storeProduct(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ]);
        $product = Product::create($validated);
        return response()->json(['success' => 'Product Stored Successfully','product' => $product], 200);
    }
}
