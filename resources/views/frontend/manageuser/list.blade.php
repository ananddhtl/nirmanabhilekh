@extends('welcome')
@section('content')
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
<?php

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

$userPrivilage = \DB::select("SELECT  options  FROM `management_users` where UserId='" . @$users[0]->id . "'");

$data = explode(",", @$userPrivilage[0]->options);

?>


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

        <div style="border-bottom: 2px solid  #eee ;" class="card-body">

            <div class="form-group row">
                <label for="project_name" class="col-sm-1 col-form-label"> Full Name</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" autocomplete="off" name="UserId" value="{{@$users[0]->username}}" id="full_name" placeholder="Enter Full Name" required>
                </div>
                <label for="email" class="col-sm-1 col-form-label"> Email</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" autocomplete="off" name="email" value="{{@$users[0]->email}}" id="email" placeholder="Enter Email">
                </div>

            </div>
        </div>
        <div class="card-body">


            <div>
                <form action="{{url('/manageuser')}}" method="POST">
                    @csrf


                    <input type="text" name="userId" value="{{@$users[0]->id}}" hidden>
                    <div class="container-fluid">
                        <h1>Dashboard</h1>


                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Main
                                    <input type="checkbox" value="0" <?php if (@$data[0] == '0') {
                                                                            echo "checked";
                                                                        } ?> name="dashboard">
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
                                    <input type="checkbox" value="1" <?php if (@$data[1] == '1') {
                                                                            echo "checked";
                                                                        } ?> name="incomefromequipment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Expenses from Equip.
                                    <input type="checkbox" value="2" <?php if (@$data[2] == '2') {
                                                                            echo "checked";
                                                                        } ?> name="expensesfromequipment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="container-fluid">
                        <h1>Billing Departments</h1>


                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Service Bill Items.
                                    <input type="checkbox" value="3" <?php if (@$data[3] == '3') {
                                                                            echo "checked";
                                                                        } ?> name="servicebillitems">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Project Activities.
                                    <input type="checkbox" value="4" <?php if (@$data[4] == '4') {
                                                                            echo "checked";
                                                                        } ?> name="projectactivitiesitems">
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
                                    <input type="checkbox" value="5" <?php if (@$data[5] == '5') {
                                                                            echo "checked";
                                                                        } ?> name="equipmentTypes">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Service 
                                    <input type="checkbox" value="6" <?php if (@$data[6] == '6') {
                                                                            echo "checked";
                                                                        } ?> name="serviceTypes">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Activities 
                                    <input type="checkbox" value="7"<?php if (@$data[7] == '7') {
                                                                            echo "checked";
                                                                        } ?> name="activitiesTypes">
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
                                    <input type="checkbox" value="8" <?php if (@$data[8] == '8') {
                                                                            echo "checked";
                                                                        } ?> name="datewise">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Customer Wise Report
                                    <input type="checkbox" value="9" <?php if (@$data[9] == '9') {
                                                                            echo "checked";
                                                                        } ?> name="customerwise">
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
                                    <input type="checkbox" value="10" <?php if (@$data[10] == '10') {
                                                                            echo "checked";
                                                                        } ?> name="projectactivities">
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
                                    <input type="checkbox" value="11" <?php if (@$data[11] == '11') {
                                                                            echo "checked";
                                                                        } ?> name="incomereport">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Expenses
                                    <input type="checkbox" value="12" <?php if (@$data[12] == '12') {
                                                                            echo "checked";
                                                                        } ?> name="expensesreport">
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
                                    <input type="checkbox" value="13"<?php if (@$data[13] == '13') {
                                                                            echo "checked";
                                                                        } ?> name="customer">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Service
                                    <input type="checkbox" value="14" <?php if (@$data[14] == '14') {
                                                                            echo "checked";
                                                                        } ?> name="service">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Equipment
                                    <input type="checkbox" value="15" <?php if (@$data[15] == '15') {
                                                                            echo "checked";
                                                                        } ?> name="equipment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="container-fluid">



                        <div class="row">
                            <div class="col-sm-4">
                                <label class="container">Project
                                    <input type="checkbox" value="16" <?php if (@$data[16] == '16') {
                                                                            echo "checked";
                                                                        } ?> name="project">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Activities
                                    <input type="checkbox" value="17" <?php if (@$data[17] == '17') {
                                                                            echo "checked";
                                                                        } ?> name="activities">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="container">Project Leader
                                    <input type="checkbox" value="18" <?php if (@$data[18] == '18') {
                                                                            echo "checked";
                                                                        } ?> name="projectleader">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                    </div>
                    
                    <input type="submit" value="Save " class="btn btn-info float-sm-right"></button>
                    </from>

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


                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            </thead>
                        <tbody>

                            <tr>
                                @foreach($adduser as $item)
                            <tr>

                                <td>{{ $item->username }}</td>
                                <td>**********</td>
                                <td>{{ $item->email }} </td>

                                <td>

                                    <a style="width:40px" href="{{url('manageuser/'.$item->id)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;

                                    </button>



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
</div>


</body>

</html>







<!-- /.card-footer -->
</form>

@endsection