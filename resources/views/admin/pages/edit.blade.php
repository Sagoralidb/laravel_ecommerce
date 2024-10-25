@extends('layouts.admin')

@section('title','Edit Page')

@section('css')
    
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Page</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="POST" id="pageForm" name="pageForm" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Page Name *</label>
                                    <input type="text" value="{{$page->name}}"  name="name" id="name" class="form-control" placeholder="Name">	
                                <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug *</label>
                                    <input type="text" readonly name="slug" value="{{$page->slug}}"  id="slug" class="form-control" placeholder="Slug">	
                               <p></p>
                                </div>
                            </div>	
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" class="summernote" cols="30" rows="10">{!! $page->content !!}</textarea>
                                </div>								
                            </div>  	

                        </div>
                    </div>							
                </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
     
            </form>
            

           
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')
    <script>
       $("#pageForm").submit(function(event) {
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true); 
    $.ajax({
        url: "{{ route('pages.update',$page->id) }}",
        type: 'put',
        data: element.serializeArray(),
        datatype: 'json',
        success: function(response) {
            $("button[type=submit]").prop('disabled',false); 
            if (response["status"] == true) {       
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#slug").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                    window.location.href="{{route('pages.index')}}";
            } else {
                var errors = response['errors'];
                if (errors['name']) {
                    $("#name").addClass('is-invalid').siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                } else {
                    $("#name").removeClass('is-invalid').siblings('p')
                        .removeClass('invalid-feedback').html("");
                }

                if (errors['slug']) {
                    $("#slug").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['slug']);
                } else {
                    $("#slug").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                }
            }
        },
        error: function(jqXHR, exception) {
            console.log("something is wrong, Refresh and try again");
        }
    });
});

	
// name to auto slug 
        $("#name").change(function(){
            element = $(this);
            $("button[type=submit]").prop('disabled',true); 
            $.ajax({
                url     :   '{{ route("getSlug") }}',
                type    :   'get',
                data    :   {title: element.val()},
                datatype:   'json',
                success :   function(response){
                    $("button[type=submit]").prop('disabled',false); 
                    if(response["status"]== true ){
                        $("#slug").val(response["slug"] );
                    }

                }
            });

        } );

    </script>
@endsection