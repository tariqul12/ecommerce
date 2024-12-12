<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy("id", "desc")->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        $sub_categories = SubCategory::where('status', 1)->orderBy('id', 'desc')->get();
        $brands = Brand::where('status', 1)->orderBy('id', 'desc')->get();
        $units = Unit::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.product.create', compact('categories', 'sub_categories', 'brands', 'units'));
    }

    // function for dynamically get subcategory according to category
    public function getSubCategoryByCategory()
    {
        return response()->json(SubCategory::where('category_id', $_GET['id'])->get()); //getting all subcategory according to category_id
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required|integer|exists:categories,id',
            'sub_category_id'   => 'nullable|integer|exists:sub_categories,id',
            'brand_id'          => 'nullable|integer|exists:brands,id',
            'unit_id'           => 'required|integer|exists:units,id',
            'name'              => 'required|string|unique:products,name',
            'code'              => 'required|string|unique:products,code',
            'short_description' => 'nullable|string|max:255',
            'long_description'  => 'nullable|string',
            'regular_price'     => 'required|integer|min:0',
            'selling_price'     => 'required|integer|min:0',
            'stock_amount'      => 'required|integer|min:0',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|',
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif',
            'other_image'       => 'required',
            'other_image.*'     => 'required|image|mimes:jpeg,png,jpg,gif',
            'hit_count'         => 'integer|min:0',
            'sales_count'       => 'integer|min:0'
        ]);

        $product                    = new Product();
        $product->category_id       = $request->category_id;
        $product->sub_category_id   = $request->sub_category_id;
        $product->brand_id          = $request->brand_id;
        $product->unit_id           = $request->unit_id;
        $product->name              = $request->name;
        $product->code              = $request->code;
        $product->short_description = $request->short_description;
        $product->long_description  = $request->long_description;
        $product->regular_price     = $request->regular_price;
        $product->selling_price     = $request->selling_price;
        $product->stock_amount      = $request->stock_amount;
        $product->meta_title        = $request->meta_title;
        $product->meta_description  = $request->meta_description;
        $product->image             = getFileUrl($request->file('image'), 'uploads/product-images/');
        $product->status            = $request->status;
        $product->save();

        foreach ($request->file('other_image') as $image) {
            $productImage             = new ProductImage();
            $productImage->product_id = $product->id;
            $productImage->image      = getFileUrl($image, 'uploads/product-images/');
            $productImage->save();
        }
        return back()->with('message', 'Product info created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        $sub_categories = SubCategory::where('category_id', $product->category_id)->get();
        $brands = Brand::where('status', 1)->orderBy('id', 'desc')->get();
        $units = Unit::where('status', 1)->orderBy('id', 'desc')->get();
        return view('admin.product.edit', compact('product', 'categories', 'sub_categories', 'brands', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->category_id       = $request->category_id;
        $product->sub_category_id   = $request->sub_category_id;
        $product->brand_id          = $request->brand_id;
        $product->unit_id           = $request->unit_id;
        $product->name              = $request->name;
        $product->code              = $request->code;
        $product->short_description = $request->short_description;
        $product->long_description  = $request->long_description;
        $product->regular_price     = $request->regular_price;
        $product->selling_price     = $request->selling_price;
        $product->stock_amount      = $request->stock_amount;
        $product->meta_title        = $request->meta_title;
        $product->meta_description  = $request->meta_description;
        if ($request->hasFile('image')) {
            $product->image         = getFileUrl($request->file('image'), 'uploads/product-images/');
        }
        $product->status            = $request->status;
        $product->save();


        if ($request->file('other_image')) {
            $productImages = ProductImage::where('product_id', $product->id)->get();
            foreach ($productImages as $productImage) {
                if (file_exists($productImage->image)) {
                    unlink($productImage->image);
                    $productImage->delete();
                }
            }

            foreach ($request->file('other_image') as $image) {
                $productImage             = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image      = getFileUrl($image, 'uploads/product-other-images/');
                $productImage->save();
            }
        }
        return redirect('/product')->with('message', "product info updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (file_exists($product->image)) {
            unlink($product->image);
        }
        $product->delete();

        $productImages = ProductImage::where('product_id', $product->id)->get();
        foreach ($productImages as $productImage) {
            if (file_exists($productImage->image)) {
                unlink($productImage->image);
            }
            $productImage->delete();
        }
        return back()->with('message', 'Product info delete successfully');
    }
}
