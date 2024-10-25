@extends('layouts.admin')

@section('title','Edit User')

@section('css')
    
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="POST" id="userForm" name="userForm" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{$user->name}}" name="name" id="name" class="form-control" placeholder="Name">	
                                <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Email</label>
                                    <input type="text" value="{{$user->email}}" name="email" id="email" class="form-control" placeholder="Email">	
                               <p></p>
                                </div>
                            </div>	
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Password</label>
                                    <input type="password"  name="password" id="password" class="form-control" placeholder="Password">	
                               <span style="color:blue">Note: Enter a value to change password or leave it blank</span>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Phone</label>
                                    <input type="text" value="{{$user->phone}}" name="phone" id="phone" class="form-control" placeholder="Phone">	
                               <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status"class="form-control">
                                        <option {{ ($user->status == 1) ? 'selected' : ''}} value="1">Active</option>
                                        <option {{ ($user->status == 0) ? 'selected': ''}} value="0">Block</option>
                                    </select>	
                                </div>
                            </div>	
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_type">User Type</label>
                                    <select name="user_type" id="user_type"class="form-control">
                                        <option {{ ($user->user_type == 'admin') ? 'selected' : ''}} value="admin">Admin</option>
                                        <option {{ ($user->user_type == 'user') ? 'selected': ''}} value="user">User</option>
                                    </select>	
                                </div>
                            </div>	
                        </div>
                        
                    </div>							
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('users.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
     
            </form>
            

           
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')
    <script>
       $("#userForm").submit(function(event) {
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true); 
    $.ajax({
        url: "{{ route('users.update',$user->id)}}",
        type: 'put',
        data: element.serializeArray(),
        datatype: 'json',
        success: function(response) {
            $("button[type=submit]").prop('disabled',false); 
            if (response["status"] == true) {
                $("#name").removeClass('is-invalid').siblings('p') .removeClass('invalid-feedback').html("");
                $("#email").removeClass('is-invalid').siblings('p') .removeClass('invalid-feedback').html("");
                $("#password").removeClass('is-invalid').siblings('p') .removeClass('invalid-feedback').html("");
                $("#phone").removeClass('is-invalid').siblings('p') .removeClass('invalid-feedback').html("");

                toastr.success(response.message);
                setTimeout(function() {
                        window.location.href = "{{ route('users.index') }}";
                    }, 3000); // 3০০০ মিলিসেকেন্ড (3 সেকেন্ড)

            } else {
                var errors = response['errors'];
                if (errors['name']) {
                    $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                } else {
                    $("#name").removeClass('is-invalid').siblings('p') .removeClass('invalid-feedback').html("");
                }
                if (errors['email']) {
                    $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
                } else {
                    $("#email").removeClass('is-invalid').siblings('p') .removeClass('invalid-feedback').html("");
                }
                if (errors['password']) {
                    $("#password").addClass('is-invalid') .siblings('p').addClass('invalid-feedback').html(errors['password']);
                } else {
                    $("#password").removeClass('is-invalid').siblings('p') .removeClass('invalid-feedback').html("");
                }
                if (errors['phone']) {
                    $("#phone").addClass('is-invalid') .siblings('p').addClass('invalid-feedback').html(errors['phone']);
                } else {
                    $("#phone").removeClass('is-invalid').siblings('p') .removeClass('invalid-feedback').html("");
                }
                toastr.error('Please fix those errors & try again.')
            }
        },
        error: function(jqXHR, exception) {
            toastr.error("something is wrong, Refresh and try again");
        }
    });
}); 
    </script>
@endsection