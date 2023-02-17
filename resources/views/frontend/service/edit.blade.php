@extends('welcome')

@section('content')



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
      <h3 class="card-title"> Update Service </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form action="{{route('updateService',$data->id)}}" method="POST">

      @csrf


      <div class="card-body">
        <div class="form-group row">
          <label for="service_name" class="col-sm-2 col-form-label"> Title</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$data->service_name}}" name="service_name" id="service_name" placeholder="Service Name">
          </div>
        </div>
        <div class="form-group row">
          <label for="status" class="col-sm-2 col-form-label">Catagory </label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" name="service_category_id" id="catagory_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
              @foreach($servicescatagories as $item)
              @if($data->service_category_id==$item->id)
              <option value="{{$item->id}}" selected>{{$item->service_catagory_name}}</option>
              @else
              <option value="{{$item->id}}">{{$item->service_catagory_name}}</option>
              @endif

              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="service_rate" class="col-sm-2 col-form-label"> Rate</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" value="{{$data->service_rate}}" name="service_rate" id="service_rate" placeholder="Service Rate">
          </div>
        </div>

      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <input type="submit" value="Update " class="btn btn-info"> </button>

      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>



@endsection