<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function list(Request $request) {
        $page = $request->page ?? 1;

        $skip = ($page * 15) - 15;

        $products = \App\Models\Products::orderBy('product_name')->skip($skip)->take(15)->get();
        
        $countProducts = \App\Models\Products::count();

        $totalPages = ceil($countProducts / 15);

        return response()->json([
            'code' => '200', 
            'status' => true, 
            'data' => [
                'products' => $products,
                'page' => $page,
                'limit' => 15,
                'totalPages' => $totalPages,
                ]
            ]);
    }

    public function get(Request $request, \App\Models\Products $product) {
        return response()->json(['code' => '200', 'status' => true, 'data' => $products]);
    }
}