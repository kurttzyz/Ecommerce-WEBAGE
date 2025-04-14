@extends('seller.layouts.layout')
@section('title_seller')
Payments - Seller Panel
@endsection
@section('seller_layout')
<center><h1 class="text-white">Your Revenue</h1></center>
<hr class="my-4 border-green-500 animate-fade-in-up">
<h2 class="text-white">Total Revenue: ₱{{ number_format($revenue, 2) }}</h2>

@endsection



