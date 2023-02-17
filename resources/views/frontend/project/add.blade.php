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
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/project/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/project/list">List</a></li>


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
            <h3 class="card-title">Add Project </h3>
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
        <form action="{{route('postProjectData')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="project_name" class="col-sm-2 col-form-label">Project Title</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="project_name" id="project_name"
                            placeholder="Enter project title" required>
                    </div>
                    <label for="project_address" class="col-sm-2 col-form-label">Project Location</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="project_address"
                            id="project_address" placeholder="Enter  project location" required>
                    </div>
                </div>



                <div class="form-group row">
                    <label for="project_city" class="col-sm-2 col-form-label">Project City</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="project_city" id="project_city"
                            placeholder="Enter project city" required>
                    </div>
                    <label for="status" class="col-sm-2 col-form-label">Customer Name</label>
                    <div class="col-sm-3">
                        <input type="hidden" class="form-control" name="customer_id" id="customer_id">
                        <input type="text" class="form-control" autocomplete="off" name="searchKey"
                            onkeyup="searchCustomer();" id="searchKey" placeholder="Search customer name" required>


                        <div class="dropdown-content" id="customers_data">

                        </div>

                    </div>
                </div>


                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Project Leader</label>
                    <div class="col-sm-3">

                        <input type="hidden" class="form-control" name="project_leader_id" id="project_leader_id">
                        <input type="text" class="form-control" autocomplete="off" name="projectLeaderName"
                            onkeyup="searchProjectLeader();" id="projectLeaderName" placeholder="Search project leader"
                            required>
                        <div class="dropdown-content" id="projectLeader_data">

                        </div>


                    </div>
                    <label for="project_fiscal_year" class="col-sm-2 col-form-label"> Fiscal Year</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="project_fiscal_year" id="project_fiscal_year"
                            placeholder="Enter  Fiscal Year" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="project_duration" class="col-sm-2 col-form-label"> Duration</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" autocomplete="off" name="project_duration"
                            id="project_duration" placeholder="Enter  Duration" required>
                    </div>
                    <label for="project_duration" class="col-sm-2 col-form-label">Cost Estimation</label>
                    <input type="checkbox" id="myCheck" onclick="myFunction()">
                    <div class="col-sm-3">
                        <input type="number" id="text" class="form-control" name="project_costestimation"
                            style="display:none" placeholder="Enter Cost Estimation"></input>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <input type="submit" value="Save " class="btn btn-info float-sm-left"></button>

            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->

</div>

<script type="text/javascript">
let searchKey = '';

function searchCustomer() {
    searchKey = document.getElementById('searchKey').value;
    // setTimeout(function() {

    // }, 500);

    if (searchKey != '') {
        axajUrl = "/searchCustomerForCustomerId/" + searchKey;
        $.ajax({
            type: "GET",
            url: axajUrl,
            async: false,
            success: function(dataResult) {
                $("#customers_data").empty();
                response = dataResult;
                console.log(dataResult);
                var dataResult = JSON.parse(dataResult);
                document.getElementById('customers_data').style.display = 'block';
                var r = 1;
                for (var i = 0; i < dataResult.length; i++) {

                    var str = "<a href='#' onclick='putItemIntoTextField(" + dataResult[i].id + ",\"" +
                        dataResult[i].customer_name + "\");'>" + dataResult[i].customer_name + " - " +
                        dataResult[i].customer_phonenumber + "</a>";

                    $("#customers_data").append(str);
                    r++;
                }
            }
        });
    } else {
        document.getElementById('customers_data').style.display = 'none';
    }



}


function searchProjectLeader() {
    var searchProjectLeader = document.getElementById('projectLeaderName').value;
    // setTimeout(function() {

    // }, 500);

    if (searchProjectLeader != '') {
        axajUrl = "/searchProjectLeaderForLeaderId/" + searchProjectLeader;
        $.ajax({
            type: "GET",
            url: axajUrl,
            async: false,
            success: function(dataResult) {
                $("#projectLeader_data").empty();
                response = dataResult;
                console.log(dataResult);
                var dataResult = JSON.parse(dataResult);
                document.getElementById('projectLeader_data').style.display = 'block';
                var r = 1;
                for (var i = 0; i < dataResult.length; i++) {

                    var str = "<a href='#' onclick='putItemIntoTextFieldForProjectLeader(" + dataResult[i]
                        .id + ",\"" + dataResult[i].project_leader_name + "\");'>" + dataResult[i]
                        .project_leader_name + " - " + dataResult[i].project_leader_mobilenumber + "</a>";

                    $("#projectLeader_data").append(str);
                    r++;
                }
            }
        });
    } else {
        document.getElementById('projectLeader_data').style.display = 'none';
    }


}


function putItemIntoTextField(id, customerName) {
    $("#customer_id").val(id);
    $("#searchKey").val(customerName);
    document.getElementById('customers_data').style.display = 'none';
}

function putItemIntoTextFieldForProjectLeader(id, customerName) {
    $("#project_leader_id").val(id);
    $("#projectLeaderName").val(customerName);
    document.getElementById('projectLeader_data').style.display = 'none';
}

function myFunction() {
    // Get the checkbox
    var checkBox = document.getElementById("myCheck");
    // Get the output text
    var text = document.getElementById("text");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}
</script>


@endsection