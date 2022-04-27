<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Pratiksh\Adminetic\Contracts\DashboardInterface;

class MyDashboard implements DashboardInterface
{
    public function view()
    {
        $products = Product::latest()->paginate(10);
        $sentimentality = Cache::has('sentimentality') ? Cache::get('sentimentality') : Cache::rememberForever('sentimentality', function () {
            $data = [];
            $products = Product::all();
            foreach ($products as $product) {
                $data[$product->name] = new ProductSentimentality($product);
            }
            return $data;
        });

        $view = view()->exists('admin.dashboard.index') ? 'admin.dashboard.index' : 'adminetic::admin.dashboard.index';
        return view($view, compact('products'));
    }
}
