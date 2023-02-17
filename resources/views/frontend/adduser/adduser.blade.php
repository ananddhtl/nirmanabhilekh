@extends('welcome')

@section('content')
@if (session('status'))

<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;User has been added</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('status')}}</div>
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

        <form action="{{route('store')}}" method="POST">
            @csrf
            <div class="card-body">


                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control " autocomplete="off" name="username" id="username" placeholder="Enter User Name" required>

                    </div>

                    <label for="status" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control " autocomplete="off" name="password" id="password" placeholder="Enter Password" required>

                    </div>

                </div>

                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-3">
                        <input type="email" class="form-control " autocomplete="off" name="email" id="email" placeholder="Enter Email" required>

                    </div>
                    <label for="status" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-1">
                        <input type="submit" value="Save" class="btn btn-info float-sm-left"></button>

                    </div>
                </div>
            </div>
    </div>

    <!-- /.card-footer -->
    </form>
    
</div>
<!-- /.card -->

<div class="col-md-12">



    <!-- Input addon -->

    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">User List</h3>

        </div>



        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Password</th>
                        <th>Email</th>


                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    </thead>
                <tbody>
                    
                    @foreach($users as $item)
                    <tr>

                        <td>{{ $item->username }}</td>
                        <td>**********</td>
                        <td>{{ $item->email }} </td>

                        <td>
                            <a style="width:40px" href="{{url('edit-user/'.$users->first()->id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                            

                            </button>



                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- /.card-footer -->
    </form>
</div>
<div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header bg bg-secondary">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Customer</i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this item?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
          <a href="#" id="deleteItem" class="btn btn-secondary">Delete</a>
        </div>
      </div>
    </div>
  </div>


  <script>
    function showModal(id) {
      document.getElementById("deleteItem").href = "/delete-user/" + id;
      $("#exampleModalLong").modal();

    }
  </script>

@endsection