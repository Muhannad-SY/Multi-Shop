@extends('layouts.theme')

@section('page-title' , 'Leave Review')
    
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<style>
    .rating {
        direction: rtl;
        display: inline-block;
    }
    .rating input {
        display: none;
    }
    .rating label {
        color: lightgray;
        font-size: 2rem;
        padding: 0;
        cursor: pointer;
    }
    .rating input:checked ~ label {
        color: gold;
    }
    .rating label:hover,
    .rating label:hover ~ label {
        color: gold;
    }
</style>
@endsection
@section('content')
    
<div class="container mt-5">
    <h2>Leave a Review</h2>
    <form method="POST" action="{{route('review.store' , $product_id)}}">
        @csrf
        <div class="form-group">
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5" title="5 stars">&#9733;</label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4" title="4 stars">&#9733;</label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3" title="3 stars">&#9733;</label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2" title="2 stars">&#9733;</label>
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1" title="1 star">&#9733;</label>
            </div>
        </div>
        <div class="form-group">
            <label for="reviewText">Your Review</label>
            <textarea class="form-control" name="body" id="reviewText" rows="4" placeholder="Write your review here..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

@endsection