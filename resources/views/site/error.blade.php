@extends('layouts.site')

@section('content')

<div class="container">
	<div class="row medium-padding120 bg-border-color">
		<div class="container">

            <div class="row">
                <h4 class="text-danger text-center ">Payment processed Failed.</h4>
                <a class="text-center text-decoration-none text-danger "  href="{{route('site.home')}}">Go Back</a>
            </div>
		
		</div>
	</div>
</div>

    
@endsection