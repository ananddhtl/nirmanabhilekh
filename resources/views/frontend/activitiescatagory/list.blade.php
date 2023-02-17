@extends('welcome')

@section('content')
@if (session('status'))

<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Added Activities Catagory Data</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('status')}}</div>
  </div>
</div>
@endif
@if (session('message'))
<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-danger alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Deleted Activities Catagory Data</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('message')}}</div>
  </div>
</div>

@endif
@if (session('messages'))
<div id="ContainerTopRight" style="margin-top:110px; " class="toasts-top-right ">
  <div class="alert alert-info alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Updated Activities Catagory Data</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('messages')}}</div>
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
          <li class="breadcrumb-item active"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="/activitiescatagory/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/activitiescatagory/list">List</a></li>

        </ol>
      </div>
    </div>
  </div>





  <div class="row">
    <div class="col-md-12">
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title"> Activities categories list </h3>

        </div>

        <!-- /.card-header -->
        <div class="card-body">
          <div class="col-md-12">

            <div class="row">
              <div class="col-md-6 ">
                <form action="{{url('/activtiescatagorysearch')}}" method="GET" accept-charset="utf-8">
                  @csrf
                  <div style="margin-bottom:25px; " class="input-group">
                    <input type="text" name="activity_catagories_name" required autocomplete="off"class="form-control form-control-lg" placeholder="Please enter activity catagory name">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-lg btn-info">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>

                  <th>Activity Category</th>

                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                </thead>
              <tbody>
                @foreach($activitiescatagories as $activitycatagory)
                <tr>

                  <td>{{ $activitycatagory ->activity_catagories_name }}</td>

                  <td>

                    <a style="width:40px" href="{{url('edit-activitycatagory/'.$activitycatagory->id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;
                    <button style="width:40px" type="button" class="btn btn-danger btn-sm" onclick="showModal({{$activitycatagory->id}})" data-toggle="modal" data-target="#exampleModalLong"><i class="fas fa-remove"></i>

                </tr>


                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-left">
            <div style="font-size:20px;" class="row">
              {{ $activitiescatagories->links() }}

            </div>
          </ul>


          <ul class="pagination pagination-sm m-0 float-right">
            <div class="row">

              <form action="" method="POST" enctype="multipart/form-data">
                @csrf
              </form>
              <a href="{{route('activitycatagory.export')}}">


                <button type="button" class="btn btn-block btn-info"> <i class="fa-solid fa-download"></i>&nbsp;&nbsp;&nbsp;Excel</button>

              </a>
            </div>

          </ul>
        </div>
      </div>
      <!-- /.card -->


      <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
  </div>



  <div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header bg bg-danger">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Actvities Catagory</i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this item?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="#" id="deleteItem" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>
  <script>
    function showModal(id) {
      document.getElementById("deleteItem").href = "/delete-activitycatagory/" + id;
      $("#exampleModalLong").modal();

    }
  </script>

  @endsection