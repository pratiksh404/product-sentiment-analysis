@extends('adminetic::admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Amazon Product Review</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('products') }}"> Products</a>
                    </li>
                    <li class="breadcrumb-item active">Amazon Product Review</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<x-adminetic-card title="Amazon Product Review">
    <x-slot name="content">
        {{-- ================================Card================================ --}}
        <div class="row">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body shadow-lg p-2">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Name :</b> <span class="text-muted">{{$product->name}}</span>
                            </li>
                            <li class="list-group-item"><b>Categories :</b> @isset($product->categories)
                                <hr>
                                @foreach ($product->categories as $category)
                                <span class="badge badge-primary badge-air-primary">{{$category}}</span>
                                @endforeach
                                @endisset
                            </li>
                        </ul>
                    </div>
                </div>

                @livewire('admin.charts.product.sentiment-class-occurrence-pie-chart',
                [
                'positive_occurrence' =>
                $product_sentimentality->result['sentiment_class_occurrence']['positive'] ?? 0,
                'negative_occurrence' =>
                $product_sentimentality->result['sentiment_class_occurrence']['negative'] ?? 0,
                'neutral_occurrence' => $product_sentimentality->result['sentiment_class_occurrence']['neutral']
                ?? 0
                ])

                @livewire('admin.charts.product.sentiment-class-scores-bar-chart',
                [
                'positive_score' =>
                $product_sentimentality->result['positive_score'] ?? 0,
                'negative_score' =>
                $product_sentimentality->result['negative_score'] ?? 0,
                'neutral_score' => $product_sentimentality->result['neutral_score']
                ?? 0
                ])

                <div class="card">
                    <div
                        class="card-body shadow-lg p-2 bg-{{$product_sentimentality->dominant_sentiment_color ?? 'primary'}}">
                        <b>Overall Product Review Sentiment</b>
                        <br>
                        <b>{{$product_sentimentality->dominant_decision ?? 'N/A'}}</b>
                        {{$product_sentimentality->dominant_score ?? 'N/A'}}
                    </div>
                </div>
                <div class="card">
                    <div class="card-body shadow-lg p-2 bg-success">
                        <b>Overall Product Positive Review Score</b>
                        <br>
                        <b>{{$product_sentimentality->positive_score ?? 'N/A'}}</b>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body shadow-lg p-2 bg-danger">
                        <b>Overall Product Negative Review Score</b>
                        <br>
                        <b>{{$product_sentimentality->negative_score ?? 'N/A'}}</b>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body shadow-lg p-2 bg-warning">
                        <b>Overall Product Neutral Review Score</b>
                        <br>
                        <b>{{$product_sentimentality->neutral_score ?? 'N/A'}}</b>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body shadow-lg p-4 bg-success">
                                <b>Positive Reviews</b>
                                <br>
                                {{$product_sentimentality->result['sentiment_class_occurrence']['positive'] ?? 0}}
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body shadow-lg p-4 bg-danger">
                                <b>Negative Reviews</b>
                                <br>
                                {{$product_sentimentality->result['sentiment_class_occurrence']['negative'] ?? 0}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body shadow-lg p-4 bg-primary">
                                <b>Neutral Reviews</b>
                                <br>
                                {{$product_sentimentality->result['sentiment_class_occurrence']['neutral'] ?? 0}}
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                @if (isset($reviews))
                @foreach ($reviews as $review)
                <div class="card">
                    <div class="card-body shadow-lg">
                        <div
                            class="ribbon ribbon-clip ribbon-{{$review->sentimentality['dominant_sentiment_color'] ?? 'primary'}}">
                            {{($review->sentimentality['dominant_decision'] ?? 'N/A') . ' - ' .
                            ($review->sentimentality['dominant_score'] ?? 'N/A')}}</div>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Reviewer</th>
                                    <th>Review Date</th>
                                    <th>Recommended ?</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$review->review_author_name ?? 'N/A'}}</td>
                                    <td>{{isset($review->review_date) ?
                                        nepaliDate(\Carbon\Carbon::create($review->review_date))
                                        : 'N/A'}}</td>
                                    <td><span
                                            class="badge badge-{{ is_bool($review->recommended) ? ($review->recommended ? "
                                            success" : "danger" ) : 'warning' }}">{{ is_bool($review->recommended) ?
                                            ($review->recommended ? "Yes" : "No") : 'N/A'
                                            }}</span></td>
                                    <td>{{$review->rating ?? 'N/A'}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <b>Review Title : </b> <span class="text-muted">{{$review->review_title ??
                                            "N/A"}}</span>
                                        <br>
                                        <b><u>Sentiment Analysis</u></b>
                                        <br>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Sentiment</th>
                                                    <th>Confidence</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$review->sentimentality['review_title']['decision'] ?? 'N/A'}}
                                                    </td>
                                                    <td>
                                                        Confidence :
                                                        {{$review->sentimentality['review_title']['score'] ??
                                                        'N/A'}}
                                                        <hr>
                                                        <ul>
                                                            <li>Positivity Confidence :
                                                                {{$review->sentimentality['review_title']['scores']['positive']
                                                                ?? 'N/A'}}</li>
                                                            <li>Negativity Confidence :
                                                                {{$review->sentimentality['review_title']['scores']['negative']
                                                                ?? 'N/A'}}</li>
                                                            <li>Nuetrality Confidence :
                                                                {{$review->sentimentality['review_title']['scores']['neutral']
                                                                ?? 'N/A'}}</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <b>Review Text : </b> <br>
                                        <span class="text-muted">{{$review->review_text ?? "N/A"}}</span>
                                        <br>
                                        <b><u>Sentiment Analysis</u></b>
                                        <br>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Sentiment</th>
                                                    <th>Confidence</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$review->sentimentality['review_text']['decision'] ?? 'N/A'}}
                                                    </td>
                                                    <td>
                                                        Confidence :
                                                        {{$review->sentimentality['review_text']['score'] ??
                                                        'N/A'}}
                                                        <hr>
                                                        <ul>
                                                            <li>Positivity Confidence :
                                                                {{$review->sentimentality['review_text']['scores']['positive']
                                                                ?? 'N/A'}}</li>
                                                            <li>Negativity Confidence :
                                                                {{$review->sentimentality['review_text']['scores']['negative']
                                                                ?? 'N/A'}}</li>
                                                            <li>Nuetrality Confidence :
                                                                {{$review->sentimentality['review_text']['scores']['neutral']
                                                                ?? 'N/A'}}</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                @endforeach
                {{ $reviews->links() }}
                @else
                <div class="card">
                    <div class="card-body shadow-lg bg-danger">
                        <span class="text-center">No Product Available !</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
        {{-- =================================================================== --}}
    </x-slot>
</x-adminetic-card>
@endsection