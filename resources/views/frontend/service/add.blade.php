@extends('welcome')

@section('content')
@if (session('text'))
<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
    <div class="alert alert-warning alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Same Service Name</strong>
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
                    <li class="breadcrumb-item active"><a href="/service/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/service/list">List</a></li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="col-md-6">



    <!-- Input addon -->

    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"> Add Service </h3>
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
        <form action="{{route('postServiceData')}}" method="POST">
            @csrf

            <div class="card-body">

                <div class="form-group row">

                    <div class="col-sm-9">
                        <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Title</label>
                        <input type="text" class="form-control" autocomplete="off" name="service_name" id="service_name"
                            placeholder="Enter Name" required>
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-9">

                        <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Catagory</label>
                        <select class="form-control select2 select2-danger" name="service_category_id" id="catagory_id"
                            data-dropdown-css-class="select2-danger" style="width: 100%;">
                            @foreach($data as $item)
                            <option value="{{$item->id}}">{{$item->service_catagory_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-9">
                        <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Rate</label>
                        <input type="number" class="form-control" name="service_rate" id="service_rate"
                            placeholder="Enter  Rate" required>
                    </div>
                </div>




            </div>


            <div class="card-footer">
                <input type="submit" value="Save" class="btn btn-info float-sm-left"> </button>

            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->

</div>



@endsection