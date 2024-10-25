{{-- Project 2 --}}
@extends('project2_front.layouts.app')

@section('title','User Dashboad')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                <li class="breadcrumb-item">Settings</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="row">
            <div class="col-md-3">
                @include('project2_front.account.common.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">Personal Information{{ $user->user_type ? '('.$user->user_type.')':''}}</h2>
                    </div>
                    <form action="" name="profileForm" id="profileForm">
                        @csrf
                       <div class="card-body p-4">
                        <div class="row">
                            <div class="mb-3">               
                                <label for="name">Name</label>
                                <input type="text" value="{{$user->name ? $user->name :''}}" name="name" id="name" placeholder="Enter Your Name" class="form-control">
                            <p></p>
                            </div>
                            <div class="mb-3">            
                                <label for="email">Email</label>
                                <input type="text" value="{{ $user->email ? $user->email:''}}" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                            <p></p>
                            </div>
                            <div class="mb-3">                                    
                                <label for="phone">Phone</label>
                                {{-- <input type="text" value="{{ $user->phone ? $user->phone:''}}" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control"> --}}
                                <input type="text" value="{{ $user->phone ? $user->phone:''}}" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control" pattern="^\d{10,15}$" title="Please enter a valid phone number (10-15 digits)">
                                <p></p>
                            </div>

                            {{-- <div class="mb-3">                                    
                                <label for="phone">Address</label>
                                <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Enter Your Address">{{Auth::user()->address ? Auth::user()->address:''}}</textarea>
                            </div> --}}

                            <div class="d-flex">
                                <button class="btn btn-dark">Update</button>
                            </div>
                        </div>
                    </div> 
                    </form>
                    
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">My Address</h2>
                    </div>

                    <form action="" name="addressForm" id="addressForm">
                        @csrf
                       <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">               
                                <label for="name">First Name</label>
                                <input type="text" value="{{ ( !empty($address)) ? $address->first_name:'' }}" name="first_name" id="first_name" placeholder="Enter Your First Name" class="form-control">
                            <p></p>
                            </div>
                            <div class="col-md-6 mb-3">               
                                <label for="name">Last Name</label>
                                <input type="text" value="{{ ( !empty($address)) ? $address->last_name:'' }}" name="last_name" id="last_name" placeholder="Enter Your Last Name" class="form-control">
                            <p></p>
                            </div>
                            <div class="col-md-6 mb-3">            
                                <label for="email">Email</label>
                                <input type="text" value="{{ ( !empty($address)) ? $address->email:'' }}" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                            <p></p>
                            </div>
                            <div class="col-md-6 mb-3">                                    
                                <label for="phone">Mobile</label>
                                <input type="text" value="{{ ( !empty($address)) ? $address->mobile:'' }}" name="mobile" id="mobile" placeholder="Enter Your Mobile" class="form-control" pattern="^\d{10,15}$" title="Please enter a valid mobile number (10-15 digits)">
                                <p></p>
                            </div>
                            <div class="mb-3">                                    
                                <label for="country">Coruntry Location</label>
                                <select  name="country_id" id="country_id" class="form-control">
                                    <option value="">Select a Country Location</option>
                                     @if ($countries->isNotEmpty())
                                        @foreach ($countries as $country )
                                        <option {{ (!empty($address) &&  $address->country_id == $country->id) ? 'selected': '' }} value="{{ $country->id }}"> 
                                            {{ $country->name ? $country->name : '' }} </option>
                                        @endforeach  
                                     @endif
                                </select>
                                <p></p>
                            </div>

                            <div class="mb-3">                                    
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Enter Your Address">{{ ( !empty($address)) ? $address->address:'' }}</textarea>
                                <p></p>
                            </div>
                            <div class="col-md-6 mb-3">                                    
                                <label for="apartment">Apartment</label>
                                <input type="text" value="{{ ( !empty($address)) ? $address->apartment:'' }}" name="apartment" id="apartment" placeholder="Apartment" class="form-control">
                                <p></p>
                            </div>
                            <div class="col-md-6 mb-3">                                    
                                <label for="city">City</label>
                                <input type="text" value="{{ ( !empty($address)) ? $address->city:'' }}" name="city" id="city" placeholder="city" class="form-control">
                                <p></p>
                            </div>
                            <div class="col-md-6 mb-3">                                    
                                <label for="city">State</label>
                                <input type="text" value="{{ ( !empty($address)) ? $address->state:'' }}" name="state" id="state" placeholder="state" class="form-control">
                                <p></p>
                            </div>
                            <div class="col-md-6 mb-3">                                    
                                <label for="city">Zip</label>
                                <input type="text" value="{{ ( !empty($address)) ? $address->zip:'' }}" name="zip" id="zip" placeholder="zip" class="form-control">
                           <p></p>
                            </div>
                            

                            <div class="d-flex">
                                <button class="btn btn-dark">Update Address</button>
                            </div>
                        </div>
                    </div> 
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')@section('script')
<script>
   $("#profileForm").submit(function(event){
        event.preventDefault();

        var phonePattern = /^\d{10,15}$/;
        var phone = $("#profileForm #phone").val();

        if (!phonePattern.test(phone)) {
            toastr.error('Please enter a valid phone number (10-15 digits).');
            $("#profileForm #phone").addClass('is-invalid').siblings('p').html('Please enter a valid phone number (10-15 digits).').addClass('invalid-feedback');
            return;
        }

        $.ajax({
            url:'{{route('account.updateProfile')}}',
            type:'post',
            data:$(this).serializeArray(),
            dataType:'json',
            success:function(response){
                if(response.status == true) {
                    toastr.success(response.message);

                    $("#profileForm #name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#profileForm #email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#profileForm #phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                } else {
                    toastr.error('Please correct the errors and try again.');

                    var errors = response.errors;

                    if (errors.name) {
                        $("#profileForm #name").addClass('is-invalid').siblings('p').html(errors.name).addClass('invalid-feedback');
                    } else {
                        $("#profileForm #name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    if (errors.email) {
                        $("#profileForm #email").addClass('is-invalid').siblings('p').html(errors.email).addClass('invalid-feedback');
                    } else {
                        $("#profileForm #email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    if (errors.phone) {
                        $("#profileForm #phone").addClass('is-invalid').siblings('p').html(errors.phone).addClass('invalid-feedback');
                    } else {
                        $("#profileForm #phone").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred while updating the profile.');
            }
        });
   });
   //addressForm 
   
   $("#addressForm").submit(function(event){
        event.preventDefault();

        var phonePattern = /^\d{10,15}$/;
        var mobile = $("#addressForm #mobile").val();

        if (!phonePattern.test(mobile)) {
            toastr.error('Please enter a valid mobile number (10-15 digits).');
            $("#addressForm #mobile").addClass('is-invalid').siblings('p').html('Please enter a valid mobile number (10-15 digits).').addClass('invalid-feedback');
            return;
        }

        $.ajax({
            url:'{{route('account.updateAddress')}}',
            type:'post',
            data:$(this).serializeArray(),
            dataType:'json',
            success:function(response){
                if(response.status == true) {
                    toastr.success(response.message);
                    $("#first_name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#last_name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#addressForm #email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#mobile").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#country_id").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#address").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    // $("#apartment").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#city").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#state").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    $("#zip").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                } else {
                    toastr.error('Please correct the errors and try again.');

                    var errors = response.errors;

                    if (errors.first_name) {
                        $("#first_name").addClass('is-invalid').siblings('p').html(errors.first_name).addClass('invalid-feedback');
                    } else {
                        $("#first_name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    if (errors.last_name) {
                        $("#last_name").addClass('is-invalid').siblings('p').html(errors.last_name).addClass('invalid-feedback');
                    } else {
                        $("#last_name").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    if (errors.email) {
                        $("#addressForm #email").addClass('is-invalid').siblings('p').html(errors.email).addClass('invalid-feedback');
                    } else {
                        $("#addressForm #email").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    if (errors.mobile) {
                        $("#mobile").addClass('is-invalid').siblings('p').html(errors.mobile).addClass('invalid-feedback');
                    } else {
                        $("#mobile").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    if (errors.country_id) {
                        $("#country_id").addClass('is-invalid').siblings('p').html(errors.country_id).addClass('invalid-feedback');
                    } else {
                        $("#country_id").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    if (errors.address) {
                        $("#address").addClass('is-invalid').siblings('p').html(errors.address).addClass('invalid-feedback');
                    } else {
                        $("#address").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    // if (errors.apartment) {
                    //     $("#apartment").addClass('is-invalid').siblings('p').html(errors.apartment).addClass('invalid-feedback');
                    // } else {
                    //     $("#apartment").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    // }
                    if (errors.city) {
                        $("#city").addClass('is-invalid').siblings('p').html(errors.city).addClass('invalid-feedback');
                    } else {
                        $("#city").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    if (errors.state) {
                        $("#state").addClass('is-invalid').siblings('p').html(errors.state).addClass('invalid-feedback');
                    } else {
                        $("#state").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                    if (errors.zip) {
                        $("#zip").addClass('is-invalid').siblings('p').html(errors.zip).addClass('invalid-feedback');
                    } else {
                        $("#zip").removeClass('is-invalid').siblings('p').html('').removeClass('invalid-feedback');
                    }
                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred while updating the profile.');
            }
        });
   });
</script>

@endsection
