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
                    <li class="breadcrumb-item active"><a href="/suppliers/add">Add</a></li>
                    <li class="breadcrumb-item active"><a href="/suppliers/list">List</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="col-md-12 ">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Add Suppliers </h3>

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

        <form action="{{url('/post/suppliers')}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group row">

                    <label for="customer_name" class="col-sm-2 col-form-label"> Full Name </label>

                    <div class="col-sm-3">

                        <input type="text" class="form-control " autocomplete="off" name="fullname"  placeholder="Enter Full Name" required>

                    </div>
                    <label for="customer_address" class="col-sm-2 col-form-label"> Address</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="address"  placeholder="Enter Address" required>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="customer_email" class="col-sm-2 col-form-label"> Email</label>
                    <div class="col-sm-3">
                        <input type="email" class="form-control" autocomplete="off" name="email"  placeholder="Enter Email">
                    </div>
                    <label for="customer_phonenumber" class="col-sm-2 col-form-label">Contact No.</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" autocomplete="off" name="contact_number"  placeholder="Enter Contact Number" required>
                    </div>
                </div>
               
            </div>

            <div class="card-footer">
                <input type="submit" value="Save" class="btn btn-info float-sm-right"></button>


            </div>
            <!-- /.card-footer -->
        </form>
    </div>
</div>



@endsection