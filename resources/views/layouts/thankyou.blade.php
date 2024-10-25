{{-- Project 2 --}}
@extends('project2_front.layouts.app')
@section('title','Thank you')

@section('content')
    <div class="container">
        <div class="col-md-12 text-center py-5">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            
            <h1>Thank you</h1>
            <p>Your order id is : {{ $id}}</p>
        </div>
    </div>
@endsection