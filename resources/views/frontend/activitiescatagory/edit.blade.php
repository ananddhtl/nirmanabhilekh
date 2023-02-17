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
          <li class="breadcrumb-item active"><a href="/activitiescatagory/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/activitiescatagory/list">List</a></li>
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
      <h3 class="card-title">Update Activity Catagory </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('updateActivitiesCatagory',$data->id)}}" method="POST">
      @csrf
      <div class="card-body">

        <div class="form-group row">
          <!-- <label for="activity_catagories_name" class="col-sm-2 col-form-label">Activities Catagory Name</label> -->
          <div class="col-sm-12">
            <input type="text" class="form-control" value="{{$data->activity_catagories_name}}" name="activity_catagories_name" id="activity_catagories_name" placeholder="Activities Catagory Name">
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