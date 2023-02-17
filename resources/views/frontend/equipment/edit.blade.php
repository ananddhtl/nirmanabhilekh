@extends('welcome')

@section('content')


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/equipment/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/viewequipment">List</a></li>




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
            <h3 class="card-title">Update Equipment </h3>

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


        <form action="{{route('updateEquipment',$data->id)}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="equipment_cat_id" class="col-sm-3 col-form-label">Catagory </label>
                    <div class="col-sm-9">
                        <select class="form-control select2 select2-danger" name="equipment_cat_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            @foreach($Catagory as $item)
                            @if(@$data->equipment_cat_id==$item->id)
                            <option value="{{$item->id}}" selected>{{$item->equipment_catagories_name}}</option>
                            @else
                            <option value="{{$item->id}}">{{$item->equipment_catagories_name}}</option>
                            @endif

                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">

                    <label for="equipment_name" class="col-sm-3 col-form-label"> Name </label>

                    <div class="col-sm-9">

                        <input type="text" class="form-control " autocomplete="off" name="equipment_name" id="equipment_name" value="{{$data->equipment_name}}" placeholder="Enter  Name">

                    </div>
                </div>

                <div class="form-group row">
                    <label for="purchase_rate" class="col-sm-3 col-form-label"> Buying Rate</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" autocomplete="off" name="purchase_rate" id="purchase_rate" value="{{$data->purchase_rate}}" placeholder="Enter Rate">
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