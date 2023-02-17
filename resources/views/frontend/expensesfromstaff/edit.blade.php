@extends('welcome')

@section('content')

<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 300px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1
    }

    .dropdown-content {
        display: none;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/expensesstaff/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/expensesfromstaff/list">List</a></li>


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
            <h3 class="card-title">Update staff exepense </h3>
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
        <form action="{{url('update-forstaffexpenses' ,$data[0]->id)}}" method="POST">
            @csrf
            <div class="card-body">

                <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label">Transaction Date</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" autocomplete="off" value="{{$data[0]->date}}" name="date" id="startDate" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label">Full Name</label>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" name="staff_id" id="staff_id" value="{{$data[0]->staff_id}}">
                        <input type="text" class="form-control" autocomplete="off" name="StaffName" value="{{$data[0]->staff_name}}" onkeyup="searchStaff();" id="StaffName" placeholder="Enter Staff Name" required>


                        <div class="dropdown-content" id="staffs_data">

                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-3 col-form-label">Total Amount</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" autocomplete="off" name="amount" value="{{$data[0]->amount}}" id="amount" placeholder="Enter Amount" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-3 col-form-label"> Remarks</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" autocomplete="off" name="narration" value="{{$data[0]->narration}}" id="narration" placeholder="Enter Remarks" required>
                    </div>
                </div>




            </div>





            <div class="card-footer">
                <input type="submit" value="Update" class="btn btn-info float-sm-left"></button>

            </div>
            <!-- /.card-footer -->
        </form>

        <!-- /.card -->

    </div>
</div>

<script type="text/javascript">
    window.onload = function(e) {

        //  getDate();

    }




    function getDate() {
        var todaydate = new Date();
        var day = todaydate.getDate();

        var month = todaydate.getMonth() + 1;
        var year = todaydate.getFullYear();

        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }

        var datestring = year + "-" + month + "-" + day

        document.getElementById("startDate").value = datestring;

    }
    let StaffName = '';

    function searchStaff() {
        StaffName = document.getElementById('StaffName').value;
        // setTimeout(function() {

        // }, 500);

        if (StaffName != '') {
            axajUrl = "/searchstaffForstaffId/" + StaffName;
            $.ajax({
                type: "GET",
                url: axajUrl,
                async: false,
                success: function(dataResult) {
                    $("#staffs_data").empty();
                    response = dataResult;
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    document.getElementById('staffs_data').style.display = 'block';
                    var r = 1;
                    for (var i = 0; i < dataResult.length; i++) {

                        var str = "<a href='#' onclick='putItemIntoTextField(" + dataResult[i].id + ",\"" + dataResult[i].staff_name + "\");'>" + dataResult[i].staff_name + " - " + dataResult[i].staff_phonenumber + "</a>";

                        $("#staffs_data").append(str);
                        r++;
                    }
                }
            });
        } else {
            document.getElementById('staffs_data').style.display = 'none';
        }



    }


















    function putItemIntoTextField(id, StaffName) {
        $("#staff_id").val(id);
        $("#StaffName").val(StaffName);
        document.getElementById('staffs_data').style.display = 'none'
    }
</script>


@endsection