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
          <li class="breadcrumb-item active"><a href="/servicecatagory/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/servicecatagory/list">List</a></li>
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
      <h3 class="card-title"> Update Service Catagory </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if($errors->any())
    <div class="m-2 p-2">
      <ul>
        @foreach ($errors->all() as $error)
        <li class="text-red-400">{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <form action="{{route('updateServiceCatagory' , $data->id)}}" method="POST">
      @csrf
      <div class="card-body">
        <div class="form-group row">
          <!-- <label for="service_catagory_name" class="col-sm-2 col-form-label"> Name</label> -->
          <div class="col-sm-12">
            <input type="text" required name="service_catagory_name" class="form-control" value="{{$data->service_catagory_name}}" id="service_catagory_name" placeholder="Enter Service Category">
          </div>
        </div>
      </div>
        
      <!-- <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                      </div>
                    </div>
                  </div>
                </div> -->
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