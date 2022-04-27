<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use App\Services\ProductSentimentality;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(8);
        return view('admin.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product_sentimentality = new ProductSentimentality($product);
        $reviews = Review::where('product_uuid', $product->uuid)->paginate(5);
        return view('admin.product.show', compact('product', 'reviews', 'product_sentimentality'));
    }

    public function import(Request $request)
    {
        Excel::import(new ProductImport, $request->file('products'));
        return redirect()->route('products')->withSuccess('Import Successful.');
    }
}
