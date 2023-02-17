@extends('welcome')

@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/equipmentcatagory/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/showequipmentCatagory">List</a></li>





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
            <h3 class="card-title">Update Equipment Catagory</h3>

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
        <form action="{{url('update-equipmentcatagory' ,$data->id)}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group row">

                    <!-- <label for="equipment_name" class="col-sm-2 col-form-label"> Name </label> -->

                    <div class="col-sm-12">

                        <input type="text" class="form-control " autocomplete="off" value="{{$data->equipment_catagories_name}}" name="equipment_catagories_name" id="equipment_catagories_name" placeholder="Enter  Name" required>

                    </div>
                </div>


            </div>

            <div class="card-footer">
                <input type="submit" value="Update" class="btn btn-info float-sm-left"></button>


            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</div><!-- /.card -->



@endsection