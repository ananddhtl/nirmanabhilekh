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
          <li class="breadcrumb-item active"><a href="/projectleader/add">Add</a></li>
         
          <li class="breadcrumb-item active"><a href="/projectleader/list">List</a></li>

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
      <h3 class="card-title">Update Project Leader </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form action="{{route('updateProjectLeader',$data->id)}}" method="POST">
      @csrf
      <div class="card-body">

        <div class="form-group row">
          <label for="project_leader_name" class="col-sm-2 col-form-label"> Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="project_leader_name" id="project_leader_name" value="{{$data->project_leader_name}}" placeholder="Project Leader Name">
          </div>
        </div>
        <div class="form-group row">
          <label for="project_leader_mobilenumber" class="col-sm-2 col-form-label"> Contact </label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="project_leader_mobilenumber" id="project_leader_mobilenumber" value="{{$data->project_leader_mobilenumber}}" placeholder="Contact number ">
          </div>
        </div>
        <div class="form-group row">
          <label for="project_leader_address" class="col-sm-2 col-form-label"> Address</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="project_leader_address" id="project_leader_address" value="{{$data->project_leader_address}}" placeholder="Project Leader Address">
          </div>
        </div>
        <div class="form-group row">
          <label for="project_leader_profession" class="col-sm-2 col-form-label"> Profession</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="project_leader_profession" id="project_leader_profession" value="{{$data->project_leader_profession}}" placeholder="Project Leader Profession">
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