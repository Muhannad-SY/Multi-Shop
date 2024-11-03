@extends('layouts.mail')

@section('mail-title' , 'We Accepted Your Order And It Is Going To Be Complate.')
    
@section('imoge')
<img  src="{{ $message->embed(public_path('theme/img/open-box.png'))}}" alt="open-box">
@endsection
             
            
       