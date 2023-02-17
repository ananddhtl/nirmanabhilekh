@extends('welcome')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">



                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="col-md-12">


    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">User Management</h3>
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
        <form action="" method="POST">
            @csrf
            <div style="border-bottom: 2px solid  #eee ;" class="card-body">

                <div class="form-group row">
                    <label for="project_name" class="col-sm-1 col-form-label"> Full Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" autocomplete="off" value="{{$users->username}}" name="full_name" id="full_name" placeholder="Enter Full Name" required>
                    </div>
                    <label for="email" class="col-sm-1 col-form-label"> Email</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" autocomplete="off" value="{{$users->email}}" name="email" id="email" placeholder="Enter Email" required>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <style>
                    /* The container */
                    .container {
                        display: block;
                        position: relative;
                        padding-left: 35px;
                        margin-bottom: 12px;
                        cursor: pointer;

                        -webkit-user-select: none;
                        -moz-user-select: none;
                        -ms-user-select: none;
                        user-select: none;
                    }

                    /* Hide the browser's default checkbox */
                    .container input {
                        position: absolute;
                        opacity: 0;
                        cursor: pointer;
                        height: 0;
                        width: 0;
                    }

                    /* Create a custom checkbox */
                    .checkmark {
                        position: absolute;
                        top: 0;
                        left: 0;
                        height: 25px;
                        width: 25px;
                        background-color: #eee;
                    }

                    /* On mouse-over, add a grey background color */
                    .container:hover input~.checkmark {
                        background-color: #ccc;
                    }

                    /* When the checkbox is checked, add a blue background */
                    .container input:checked~.checkmark {
                        background-color: #2196F3;
                    }

                    /* Create the checkmark/indicator (hidden when not checked) */
                    .checkmark:after {
                        content: "";
                        position: absolute;
                        display: none;
                    }

                    /* Show the checkmark when checked */
                    .container input:checked~.checkmark:after {
                        display: block;
                    }

                    /* Style the checkmark/indicator */
                    .container .checkmark:after {
                        left: 9px;
                        top: 5px;
                        width: 5px;
                        height: 10px;
                        border: solid white;
                        border-width: 0 3px 3px 0;
                        -webkit-transform: rotate(45deg);
                        -ms-transform: rotate(45deg);
                        transform: rotate(45deg);
                    }

                    h1 {
                        font-size: 20px;
                    }

                    .container-fluid {
                        margin-top: 30px;
                    }
                </style>

                <body>
                    <div class="container-fluid">
                        <h1>Dashboard</h1>


                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Main
                                    <input type="checkbox"  name="dashboard"value="{{$users->dashboard}}" >
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="container-fluid">
                        <h1>Financial Section</h1>


                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Income from Equip.
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Expenses from Equip.
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="container-fluid">
                        <h1>Group / Types</h1>


                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Equipment
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Service
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Activities
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="container-fluid">
                        <h1>Reports/ Service</h1>


                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Date Wise Report
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Customer Wise Report
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="container-fluid">
                        <h1>Reports/ Project</h1>


                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Project Activities Report
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>


                        </div>
                    </div>
                    <div class="container-fluid">
                        <h1>Reports/ Equipment</h1>


                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Income
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Expenses
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>



                        </div>
                    </div>
                    <div class="container-fluid">
                        <h1>Record Keeping</h1>


                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Customer
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Service
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Equipment
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="container-fluid">



                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Project
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Activities
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Project Leader
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                    </div>
            </div>
    </div>

    <div class="col-md-12">



        <!-- Input addon -->

        <!-- /.card -->
        <!-- Horizontal Form -->
        <div class="card card-info">
            <div style="background-color:white; height:100px;" class="card-header">
                <h3 class="card-title">User List</h3>

            </div>



            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Password</th>



                        </tr>
                    </thead>
                    <tbody>
                        </thead>
                    <tbody>

                        <tr>
                            @foreach($show as $item)
                        <tr>

                            <td>{{ $item->username }}</td>
                            <td>**********</td>
                            <td>{{ $item->email }} </td>





                        </tr>
                        @endforeach




                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- /.card-footer -->
        </form>
    </div>



</div>



</body>

</html>







<!-- /.card-footer -->
</form>

@endsection