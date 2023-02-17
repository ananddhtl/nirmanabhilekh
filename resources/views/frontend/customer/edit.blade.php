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


    <form action="{{route('updateCustomer',$data->id)}}" method="POST">

      @csrf

      <div class="card-body">

        <div class="form-group row">
          <label for="customer_name" class="col-sm-2 col-form-label"> Name </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" autocomplete="off" name="customer_name" value="{{$data->customer_name}}" id="customer_name" placeholder="Customer Name">
          </div>
        </div>
        <div class="form-group row">
          <label for="customer_address" class="col-sm-2 col-form-label"> Address</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" autocomplete="off" name="customer_address" value="{{$data->customer_address}}" id="customer_address" placeholder="Customer Address">
          </div>
        </div>
        <div class="form-group row">
          <label for="customer_email" class="col-sm-2 col-form-label"> Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" autocomplete="off" name="customer_email" id="customer_email" value="{{$data->customer_email}}" placeholder="Customer Email">
          </div>
        </div>
        <div class="form-group row">
          <label for="customer_phonenumber" class="col-sm-2 col-form-label"> Phone Number</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="customer_phonenumber" id="customer_phonenumber" value="{{$data->customer_phonenumber}}" placeholder="Customer Phone Number">
          </div>
        </div>
        <div class="form-group row">
          <label for="dob" class="col-sm-2 col-form-label">Date Of Birth</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="dob" id="dob" value="{{$data->dob}}" placeholder="Date Of Birth">
          </div>
        </div>
        <div class="form-group row">
          <label for="customer_profession" class="col-sm-2 col-form-label"> Profession</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" autocomplete="off" name="customer_profession" id="customer_profession" value="{{$data->customer_profession}}" placeholder="Customer Profession">
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