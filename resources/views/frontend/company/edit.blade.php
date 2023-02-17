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
          <li class="breadcrumb-item"><a href="/customer/add">Add</a></li>
          <li class="breadcrumb-item"><a href="/customer/edit">Edit</a></li>
          <li class="breadcrumb-item"><a href="/customer/list">List</a></li>

        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="col-md-8">



  <!-- Input addon -->

  <!-- /.card -->
  <!-- Horizontal Form -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"> Update Customer</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->


    <form action="{{url('update-company',$data->id)}}" method="POST">

      @csrf

      <div class="card-body">

        <div class="form-group row">
          <label for="company_name" class="col-sm-2 col-form-label"> Name </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" autocomplete="off" name="company_name" value="{{$data->company_name}}" id="company_name" placeholder="Customer Name">
          </div>
        </div>
        <div class="form-group row">
          <label for="company_address" class="col-sm-2 col-form-label"> Address</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" autocomplete="off" name="company_address" value="{{$data->company_address}}" id="company_address" placeholder="Customer Address">
          </div>
        </div>
        <div class="form-group row">
          <label for="company_email" class="col-sm-2 col-form-label"> Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" autocomplete="off" name="company_email" id="company_email" value="{{$data->company_email}}" placeholder="Customer Email">
          </div>
        </div>
        <div class="form-group row">
          <label for="company_contactnumber" class="col-sm-2 col-form-label"> Phone Number</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="company_contactnumber" id="company_contactnumber" value="{{$data->company_contactnumber}}" placeholder="Customer Phone Number">
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
        <input type="submit" value="Update " class="btn btn-info"></button>


      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>

@endsection