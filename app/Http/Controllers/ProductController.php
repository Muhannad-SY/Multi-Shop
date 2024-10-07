<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'in_description' => 'required|string',
            'price' => 'required|int',
            'discount_price' => 'sometimes',
            'stock' => 'required|string',
            'product_images.*' => 'required|image|mimes:png,jpg',
        ]);

        $product = Product::create($request->all());

        $images = $request->file('product_images');

        foreach ($images as $value) {
            $image_name = microtime() . rand(0000,9999) .'.' . $value->extension();
            $value->move(public_path('storage/products/'), $image_name);

            $product->images()->create(['path' => $image_name]);
        }

        return redirect()->route('product.index')->with('success', 'Product Added SSuccessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|int',
            'stock' => 'required|string',
            'product_images.*' => 'sometimes|required|image|mimes:png,jpg',
            // max:2048|',
        ]);
        $product->update($request->all());

        if ($request->hasFile('product_images')) {
            $images = $request->file('product_images');

            foreach ($images as $value) {
                $image_name = time() . '.' . $value->extension();
                $value->move(public_path('storage/products/'), $image_name);

                $product->images()->create(['path' => $image_name]);
            }
        }
        return redirect()->route('product.index')->with('success', 'product update successfully');
    }

    //TO  update the status of the product
    public function setStatus(Request $request, Product $product)
    {
        if($product->status == 0 && $request->status > 1){
            return redirect()
            ->back()
            ->with('warning' , "Your Product Is Not Active");
        }
        if($request->status ){
            if ($request->status == 1) {
            $product->update([
                'status' => 1,
            ]);
            return redirect()
                ->back()
                ->with('success', 'Product Became ' . 'Active');
        }elseif ($request->status == 2 && $product->status == 3) {
            $product->update([
                'status' => 4,
            ]);
            return redirect()
                ->back()
                ->with('success', 'Product Became ' . 'Featuerd');
        }elseif ($request->status == 2 && $product->status == 1) {
            $product->update([
                'status' => 2,
            ]);
            return redirect()
                ->back()
                ->with('success', 'Product Became ' . 'Featuerd');
        }elseif ($request->status == 3 && $product->status == 1) {
            $product->update([
                'status' => 3,
            ]);
            return redirect()
                ->back()
                ->with('success', 'Product Became ' . 'Popular');
        }elseif ($request->status == 3 && $product->status == 2) {
            $product->update([
                'status' => 4,
            ]);
            return redirect()
                ->back()
                ->with('success', 'Product Became ' . 'Popular');
        }
        }elseif($request->dis == 0){
            $product->update([
                'status' => 0,
            ]);
            return redirect()
                ->back()
                ->with('warning', 'Product Became ' . 'Inactive');
        }elseif($request->dis == 3 && $product->status == 4){
            $product->update([
                'status' => 2,
            ]);
            return redirect()
                ->back()
                ->with('warning', 'Product Became ' . 'Not Popular');
        }elseif($request->dis == 3 && $product->status == 3){
            $product->update([
                'status' => 1,
            ]);
            return redirect()
                ->back()
                ->with('warning', 'Product Became ' . 'Not Popular');
        }elseif($request->dis == 2 && $product->status == 4){
            $product->update([
                'status' => 3,
            ]);
            return redirect()
                ->back()
                ->with('warning', 'Product Became ' . 'Not Featuerd');
        }elseif($request->dis == 2 && $product->status == 2){
            $product->update([
                'status' => 1,
            ]);
            return redirect()
                ->back()
                ->with('warning', 'Product Became ' . 'Not Featuerd');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::delete('public/products/' . $image->path);
            $image->delete();
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted');
    }

    public function destroyOneImage(Image $image)
    {
        Storage::delete('public/products/' . $image->path);
        Image::destroy($image->id);
        return redirect()->back()->with('success', 'The sinrle Image deleted successfuly');
    }
}
