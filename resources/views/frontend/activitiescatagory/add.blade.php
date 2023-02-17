@extends('welcome')

@section('content')
@if (session('text'))
<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-warning alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Same Activity Catagory Number</strong>
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
          <li class="breadcrumb-item"><a href="/">Home</a></li>
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
      <h3 class="card-title">Add Activity Catagory</h3>
    </div>
    @if($errors->any())
    <div class="m-2 p-2">
      <ul>
        @foreach ($errors->all() as $error)
        <div class="form-control form-control is-invalid">{{$error}}</div>
        @endforeach
      </ul>
    </div>
    @endif
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('postActivitiesCatagoryData')}}" method="POST">
      @csrf
      <div class="card-body">

        <div class="form-group row">
          <!-- <label for="activity_catagories_name" class="col-sm-2 col-form-label"> Title</label> -->
          <div class="col-sm-12">
            <input type="text" class="form-control" name="activity_catagories_name" id="activity_catagories_name" placeholder="Enter activity category name" required>
          </div>
        </div>

      </div>


      <div class="card-footer">
        <input type="submit" value="Save " class="btn btn-info float-sm-left"> </button>

      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>



@endsection