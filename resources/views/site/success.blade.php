@extends('layouts.site')

@section('content')

<div class="container">
	<div class="row medium-padding120 bg-border-color">
		<div class="container">

            <div class="row">
                <h5 class="text-success text-center ">Payment processed Successfully.</h5>
                <a class="text-center text-decoration-none text-info "  href="{{route('site.home')}}">Go Back</a>
            </div>
		
		</div>
	</div>
</div>

    
@endsection