@extends('welcome')

@section('content')
@if (session('status'))

<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;New Company Details  Data</strong>
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
            <h3 class="card-title">Add Company</h3>

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

        <form action="{{url('/addcompany')}}" method="POST">
            @csrf
            <div class="card-body">


                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control " autocomplete="off" name="company_name" id="company_name" placeholder="Enter Company Name" required>

                    </div>

                    <label for="status" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control " autocomplete="off" name="company_address" id="company_address" placeholder="Enter Company Address" required>

                    </div>

                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control " autocomplete="off" name="company_email" id="company_email" placeholder="Enter Company Email" required>

                    </div>

                    <label for="status" class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control " autocomplete="off" name="company_contactnumber" id="company_contactnumber" placeholder="Enter Company Contact Number" required>

                    </div>


                </div>

                <div class="form-group row">


                    <label for="status" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-8">
                        <input type="submit" value="Save" class="btn btn-info float-sm-right"></button>

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
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Contact</th>


                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    </thead>
                <tbody>
                    @foreach($company as $item)

                    <tr>

                        <td>{{ $item->company_name }}</td>
                        <td>{{ $item->company_address }}</td>
                        <td>{{ $item->company_email }} </td>
                        <td>{{ $item->company_contactnumber }}</td>
                        <td>
                            <a style="width:40px" href="{{url('edit-company/'.$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;


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



<script>
    function showModal(id) {
        document.getElementById("deleteItem").href = "/delete-user/" + id;
        $("#exampleModalLong").modal();

    }
</script>

@endsection