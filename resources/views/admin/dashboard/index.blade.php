@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Sentiment Analysis</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Sentiment Analysis </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card">
        <div class="card-body shadow-lg p-2">
            @livewire('most-positive-review-products')
        </div>
    </div>
    <div class="card">
        <div class="card-body shadow-lg">
            <form action="{{route('import-products')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-around">
                    <div>
                        <b>Import Product</b>
                        <br>
                        <div class="input-group">
                            <input type="file" name="products" id="import-products">
                        </div>
                    </div>
                    <input type="submit" value="Upload" class="btn btn-primary brn-air-primary">
                </div>
            </form>
            <br>
            {{-- ================================Card================================ --}}
            @if (isset($products))
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Categories</th>
                        <th>Reviews</th>
                        <th>Dominant Sentiment Class</th>
                        <th>Dominant Score</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr class="bg-{{$product->product_sentimentality->dominant_sentiment_color ?? 'primary'}}">
                        <td>{{$product->name ?? 'N/A'}}</td>
                        <td>
                            @isset($product->categories)
                            @foreach ($product->categories as $category)
                            <span class="badge badge-primary badge-air-primary">{{$category}}</span>
                            @endforeach
                            @endisset
                        </td>
                        <td>{{$product->reviews->count() ?? 'N/A'}}</td>
                        <td>{{$product->product_sentimentality->dominant_decision ?? 'N/A'}}</td>
                        <td>{{$product->product_sentimentality->dominant_score ?? 'N/A'}}</td>
                        <td>
                            <a href="{{route('product.show',['product' => $product->uuid])}}"
                                class="btn btn-info btn-air-info"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>UUID</th>
                        <th>Name</th>
                        <th>Categories</th>
                        <th>Dimention</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
            <br>
            {{ $products->links() }}
            @else
            <div class="card">
                <div class="card-body shadow-lg bg-danger">
                    <span class="text-center">No Product Available !</span>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('custom_js')
@include('admin.layouts.modules.dashboard.scripts')
@endsection