<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SearchController extends Controller
{
    public function typingTimeSearch(Request $request)
    {
        // $filter_case = 0;

        // $products = Product::withCount('order__details')
        // ->where('status' , '>' , 0)->get();
        // $categories = Category::where('status' , '>' , 0)->get();

        $categoriesSearchReasult = Category::where('status' , '>' , 0)
        ->where('name' , 'LIKE' , '%'. $request->search . '%' )
        ->get();

        $productsSearchReasult = Product::where('status' , '>' , 0)
        ->where('name' , 'LIKE' , '%'. $request->search . '%' )
        ->orWhere('description' , 'LIKE' , '%'. $request->search . '%' )
        ->orWhere('in_description' , 'LIKE' , '%'. $request->search . '%' )
        ->get();
        $searchResault = ['categories' => $categoriesSearchReasult ,'products' => $productsSearchReasult ];
        // $cart = json_decode(Cookie::get('cart', '[]'), true);
        // return $searchResault;
        return response()->json($searchResault) ;
    }

    public function search(Request $request)
    {
        // $filter_case = 0;

        // $products = Product::withCount('order__details')
        // ->where('status' , '>' , 0)->get();
        // $categories = Category::where('status' , '>' , 0)->get();

        $categoriesSearchReasult = Category::where('status' , '>' , 0)
        ->where('name' , 'LIKE' , '%'. $request->search . '%' )
        ->get();

        $productsSearchReasult = Product::where('status' , '>' , 0)
        ->where('name' , 'LIKE' , '%'. $request->search . '%' )
        ->orWhere('description' , 'LIKE' , '%'. $request->search . '%' )
        ->orWhere('in_description' , 'LIKE' , '%'. $request->search . '%' )
        ->get();
        $searchResault = ['categories' => $categoriesSearchReasult ,'products' => $productsSearchReasult ];
        // $cart = json_decode(Cookie::get('cart', '[]'), true);
        // return $searchResault;
        // return view('') $searchResault) ;
    }

    public function showProductResult($id){

        $categories = Category::where('status' , '>' , 0)->get();

        $cart = json_decode(Cookie::get('cart', '[]'), true);

        $product = Product::withCount('reviews')
        ->with('reviews', function ($query) {
            $query->where('status', 2);
        })
        ->where('id', $id)
        ->first();

        return view('theme.product.details', compact('categories', 'product', 'cart'));
    }


    public function showCategoryResult( $id)
    {
        $cart = json_decode(Cookie::get('cart', '[]') , true);

        $filter_case = 0;

        $categories = Category::withCount('products')
                    ->where('status', '>' , 0) // Filter categories with status = 1
                    ->get();
        $category = Category::where('id' , $id)->first();
        return view('theme.category.show' , compact('category' , 'categories' , 'filter_case' , 'cart'));
    }
}
