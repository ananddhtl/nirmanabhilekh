@extends('welcome')
@section('content')
@if (session('text'))
<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
    <div class="alert alert-warning alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Same Contact Number</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">{{session('text')}}</div>
    </div>
</div>

@endif

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>





                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="col-md-12">



    <!-- Input addon -->

    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add User</h3>

        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if($errors->any())
        <div class="m-2 p-2">
            <ul>
                @foreach ($errors->all() as $error)
                <div class="form-control form-control is-invalid">{{$error}}</div>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{route('update',$users->id)}}" method="POST">
            @csrf
            <div class="card-body">


                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control " autocomplete="off" name="username" value="{{$users->username}}"id="username" placeholder="Enter User Name">

                    </div> 

                    <label for="status" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control " autocomplete="off" name="password" value="{{$users->password}}"id="password" placeholder="Enter Password">

                    </div>

                </div>

                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-3">
                        <input type="email" class="form-control " autocomplete="off" name="email"value="{{$users->email}}" id="email" placeholder="Enter Email">

                    </div>
                    <label for="status" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-3">
                        <input type="submit" value="Clear" class="btn btn-info float-sm-right"></button>

                        <div class="">
                            <input type="submit" value="Save" class="btn btn-info "></button>
                        </div>

                    </div>
                </div>
            </div>
    </div>

    <!-- /.card-footer -->
    </form>
</div>
@endsection