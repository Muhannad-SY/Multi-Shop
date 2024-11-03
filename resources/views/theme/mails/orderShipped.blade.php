@extends('layouts.mail')

@section('mail-title',
    'Your Order On The Way,
    Inshallah In Just A Couple Of Days You Will Receive The Order')

@section('imoge')
  <img src="{{$message->embed(public_path('theme/img/box.png'))}}" alt="open-box">
  <img src="{{$message->embed(public_path('theme/img/delivery-truck.png'))}}" alt="open-box">
@endsection
