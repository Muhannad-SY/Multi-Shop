<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_picture' => 'required|image|mimes:png,jpg',
        ]);

        $category = Category::create($request->all());

        $image = $request->file('category_picture');

        $image_name = time() . '.' . $image->extension();

        $image->move(public_path('storage/categories/'), $image_name);

        $category->image()->create(['path' => $image_name]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $filter_case = 0;
        $categories = Category::withCount('products')
                    ->where('status', '>=' , 1) // Filter categories with status = 1
                    ->get();
                // $products = Product::withCount('order__details')
                // ->where('status' , '>=' , 1)->get();
                
        return view('theme.category.show' , compact('category' , 'categories' , 'filter_case'));
    }

    // for filterd data
    public function filterd(Category $category, Request $request)
{
    $products = $category->products();
    $categories = Category::withCount('products')
                    ->where('status', '>=' , 1) // Filter categories with status = 1
                    ->get();
    $filter_case = 1;
    $products = $products->when($request->p == 1, function ($query) {
        return $query->where('price', '<', 100);
    })
    ->when($request->p == 2, function ($query) {
        return $query->whereBetween('price', [100, 300]);
    })
    ->when($request->p == 3, function ($query) {
        return $query->whereBetween('price', [300, 800]);
    })
    ->when($request->p == 4, function ($query) {
        return $query->whereBetween('price', [800, 1000]);
    })
    ->when($request->p == 5, function ($query) {
        return $query->whereBetween('price', [1000, 2000]);
    })
    ->when(!$request->p, function ($query) {
        return $query->where('price', '>', 0); // Default case when no `p` is provided
    });

    // Fetch the filtered products
    $products = $products->get();

    return view('theme.category.show', compact('products', 'categories' , 'category' , 'filter_case'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string',
            'category_picture' => 'sometimes|image|mimes:png,jpg',
        ]);

        $category->update($request->all());

        if ($request->hasFile('category_picture')) {
            Storage::delete('public/categories/' . $category->image->path);
            $category->image->delete();
            $image = $request->file('category_picture');
            $image_name = time() . '.' . $image->extension();
            $image->move(public_path('storage/categories/'), $image_name);
            $category->image()->create(['path' => $image_name]);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function setStatus(Request $request, Category $category)
    {
        // return $request;

        if ($request->status == 1) {
            $category->update([
                'status' => 1
            ]);
            return redirect()
                ->back()
                ->with('success', 'Category Became ' . 'Active');
        } elseif ($request->status == 2) {
            $category->update([
                'status' => 2
            ]);
            return redirect()
                ->back()
                ->with('success', 'Category Became ' . 'Featuerd');
        }elseif($request->regular_status == 1){
            $category->update([
                'status' => 1
            ]);
            return redirect()
                ->back()
                ->with('warning', 'Category Became ' . 'Not     Featuerd');
        }else{
            $category->update([
                'status' => 0
            ]);
            return redirect()
                ->back()
                ->with('warning', 'Category Became ' . 'Inactive');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Storage::delete('public/categories/' . $category->image->path);
        $category->image->delete();
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
