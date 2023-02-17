@extends('welcome')

@section('content')

<div id="ContainerTopRight" style="margin-top:110px; display:none;" class="toasts-top-right ">
    <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Data has been</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">Saved successfully!</div>
    </div>
</div>

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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/projectactivities/add">Add</a></li>

                    <li class="breadcrumb-item active"><a href="/projectactivities/list">List</a></li>

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
            <h3 class="card-title">Add Project Summary </h3>
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
        <form action="{{route('postProjectActivitiesData')}}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-3">
                        <label for="exampleInputEmail1">Date</label>
                        <input type="date" id="billDate" class="form-control" name="billDate" />
                    </div>



                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">Project</label>
                        <input type="hidden" class="form-control" name="project_id" id="project_id"
                            value="{{@$project[0]->project_name}}">
                        <input type="text" autocomplete="off" class="form-control" name="projectsearchKey"
                            onkeyup="searchProject();" id="projectsearchKey" placeholder="Search Project Name">


                        <div class="dropdown-content" id="projects_data">

                        </div>

                    </div>
                    <div class="col-sm-1">
                        <label  style="display:block;"for="exampleInputEmail1">Project</label>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal3">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                </div>



                <div class="form-group row">
                    <div class="col-sm-2">
                        <input type="hidden" class="form-control" name="id" id="id"
                            value="{{@$suppliers[0]->full_name}}">
                        <input type="text" autocomplete="off" class="form-control" name="supplierssearchKey"
                            onkeyup="searchSuppliers();" id="supplierssearchKey" placeholder="Search Suppliers Name">


                        <div class="dropdown-content" id="suppliers_data">

                        </div>

                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal2">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>


                    <div class="col-sm-2">
                        <input type="hidden" class="form-control" name="activities_id" id="activities_id"
                            value="{{@$activity[0]->activities_title}}">
                        <input type="text" autocomplete="off" class="form-control" name="searchKey"
                            onkeyup="searchActivities();" id="searchKeyForActivity" placeholder="Search Items Name">
                        <div class="dropdown-content" id="activities_data">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="col-sm-1">
                        <input type="number" class="form-control" name="quantity" onkeyup="" id="quantity"
                            placeholder=" Qty">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="debit" id="debit"
                            onkeyup="changeDebitCredit('debit');" placeholder="Enter Income">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="credit" onkeyup="changeDebitCredit('credit');"
                            id="credit" placeholder="Enter Expenses">
                    </div>
                    <div class="col-sm-1">
                        <input type="button" value="Add" onclick=showItems(); class="btn btn-info "></button>
                    </div>
                </div>
                <div>
                    <table class="table ">

                        <thead>
                            <th>Items</th>
                            <th>Suppliers</th>
                            <th>Income</th>
                            <th>Expenses</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="datatable">

                        <tbody>

                    </table>
                </div>
                <div class="form-group row">
                </div>
            </div>
            <div class="card-footer">
                <input type="button" value="Save" onclick="saveDataIntoTable();" class="btn btn-info float-sm-left">
                </button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Add Project Items</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="activites_title" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="activities_title" autocomplete="off"
                                id="activities_title" placeholder="Enter  Title" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="activites_subtitle" class="col-sm-3 col-form-label"> SubTitle </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="activities_subtitle" autocomplete="off"
                                id="activities_subtitle" placeholder="Enter SubTitle " required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Unit" class="col-sm-3 col-form-label">Unit </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="unit" id="unit" autocomplete="off" id="unit"
                                placeholder="Enter Unit" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="activity_catagories_id" class="col-sm-3 col-form-label">Catagory </label>
                        <div class="col-sm-9">
                            <select class="form-control select2 select2-danger" id="activities_cat_ID"
                                name="activities_cat_ID" data-dropdown-css-class="select2-danger" style="width: 100%;"
                                required>
                                @foreach($activitiescatagories as $item)
                                <option value="{{$item->id}}">{{$item->activity_catagories_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" value="Save " onclick="saveProjectItemsData();" class="btn btn-info float-sm-left">
                </button>
            </div>

        </div>

    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Add Suppliers</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card-body">

                    <div class="form-group row">

                        <label for="customer_name" class="col-sm-3 col-form-label"> Full Name </label>

                        <div class="col-sm-9">

                            <input type="text" class="form-control " autocomplete="off" id="fullname" name="fullname"
                                placeholder="Enter Full Name" required>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_address" class="col-sm-3 col-form-label"> Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" autocomplete="off" id="address" name="address"
                                placeholder="Enter Address" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_email" class="col-sm-3 col-form-label"> Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" autocomplete="off" id="email" name="email"
                                placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_phonenumber" class="col-sm-3 col-form-label">Contact No.</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" autocomplete="off" id="contact_number"
                                name="contact_number" placeholder="Enter Contact Number" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Save " onclick="saveSuppliersItemsData();"
                        class="btn btn-info float-sm-left">
                </div>
                <!-- /.card-footer -->




            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Add Project</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card-body">
                    <div class="form-group row">
                        <label for="project_name" class="col-sm-3 col-form-label">Project Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" autocomplete="off" name="project_name"
                                id="project_name" placeholder="Enter project title" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="project_address" class="col-sm-3 col-form-label">Project Location</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" autocomplete="off" name="project_address"
                                id="project_address" placeholder="Enter  project location" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="project_city" class="col-sm-3 col-form-label">Project City</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" autocomplete="off" name="project_city"
                                id="project_city" placeholder="Enter project city" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Customer Name</label>
                        <div class="col-sm-9">
                            <input type="hidden" class="form-control" name="customer_id" id="customer_id">
                            <input type="text" class="form-control" autocomplete="off" name="searchKey"
                                onkeyup="searchCustomer();" id="searchKey" placeholder="Search customer name" required>


                            <div class="dropdown-content" id="customers_data">

                            </div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Project Leader</label>
                        <div class="col-sm-9">

                            <input type="hidden" class="form-control" name="project_leader_id" id="project_leader_id">
                            <input type="text" class="form-control" autocomplete="off" name="projectLeaderName"
                                onkeyup="searchProjectLeader();" id="projectLeaderName"
                                placeholder="Search project leader" required>
                            <div class="dropdown-content" id="projectLeader_data">

                            </div>


                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="project_fiscal_year" class="col-sm-3 col-form-label"> Fiscal Year</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="project_fiscal_year" id="project_fiscal_year"
                                placeholder="Enter  Fiscal Year" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="project_duration" class="col-sm-3 col-form-label"> Duration</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" autocomplete="off" name="project_duration"
                                id="project_duration" placeholder="Enter  Duration" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="project_costestimation" class="col-sm-3 col-form-label"> Cost Estimation</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="project_costestimation"
                                id="project_costestimation" placeholder="Enter Cost Estimation" required>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Save " onclick="saveProjectData();" class="btn btn-info float-sm-left">
                </div>
                <!-- /.card-footer -->




            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
window.onload = function(e) {

    getDate();

}

const items = [];

var total = 0;


function changeDebitCredit(textField) {
    if (textField == 'debit') {
        $('#credit').val('');
    } else {
        $('#debit').val('');
    }

}



function showItems() {
    var isBlank = false;
    if (document.getElementById("activities_id").value == '') {

        document.getElementById("searchKeyForActivity").focus();
        isBlank = true;
    } else if (document.getElementById("debit").value == '' && document.getElementById("credit").value == '') {
        document.getElementById("debit").focus();
        isBlank = true;
    }

    if (isBlank == false) {
        if (document.getElementById('activities_id').value != '') {

            var activities_id = document.getElementById('activities_id').value;
            var activities_Name = document.getElementById('searchKeyForActivity').value;
            var debit = document.getElementById('debit').value;
            var credit = document.getElementById('credit').value;
            var quantity = document.getElementById('quantity').value;
            var vendor_id = document.getElementById('id').value;
            var vendor = document.getElementById('supplierssearchKey').value;
            items.push(activities_Name + '{#}' + activities_id + '{#}' + debit + '{#}' + credit + '{#}' + quantity +
                '{#}' + vendor_id + '{#}' + vendor);

            displayBasketItemIntoTable();
            document.getElementById('activities_id').value = "";
            document.getElementById('searchKeyForActivity').value = "";
            document.getElementById('debit').value = "";
            document.getElementById('credit').value = "";
            document.getElementById('quantity').value = "";
            document.getElementById('supplierssearchKey').value = "";
            document.getElementById('id').value = "";
        }
    }
}

function saveDataIntoTable() {
    if (document.getElementById("project_id").value == '') {
        document.getElementById("searchKey").focus();
    } else if (items.length == 0) {
        document.getElementById("searchKeyForActivity").focus();
    } else

    {

        var transactionDate = document.getElementById('billDate').value;
        var project_id = document.getElementById('project_id').value;

        var token = document.getElementsByName('_token')[0].value;

        //alert(token);
        var activities = items.toString();

        axajUrl = "/post/projectactivites";
        $.ajax({
            type: "POST",
            url: axajUrl,
            data: {
                _token: token,
                fiscal_year: transactionDate,
                project_id: project_id,

                activities: activities,
            },
            async: false,

            success: function(dataResult) {

                document.getElementById('datatable').innerHTML = "";
                items.splice(0, items.length); //[]
                document.getElementById('ContainerTopRight').style.display = "block";


            }
        });

    }




}

function removeItem(data) {

    if (items.includes(data)) {
        var index = items.indexOf(data);
        if (index !== -1) {
            items.splice(index, 1);
        }
    }
    displayBasketItemIntoTable();
}

function displayBasketItemIntoTable() {
    document.getElementById('datatable').innerHTML = "";
    for (let i = 0; i < items.length; i++) {
        //total += parseFloat(items[i].split("{#}")[2]) * parseFloat(items[i].split("{#}")[3]);

        var str = '<tr><td>' + items[i].split("{#}")[0] + '</td><td>' + items[i].split("{#}")[6] + '</td><td>' + items[
                i].split("{#}")[2] + '</td><td>' + items[i].split("{#}")[3] + '</td><td>' + items[i].split("{#}")[4] +
            '</td><td onclick="removeItem(\'' + items[i] + '\')"> <i class="fas fa-remove"></i></td></tr>';

        $('#datatable').append(str);
    }

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

    document.getElementById("billDate").value = datestring;
}
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

                    var str = "<a href='#' onclick='putItemIntoCustomerTextField(" + dataResult[i].id +
                        ",\"" +
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

                    var str = "<a href='#' onclick='putItemIntoTextFieldForProjectLeader(" + dataResult[
                            i].id + ",\"" + dataResult[i].project_leader_name + "\");'>" + dataResult[i]
                        .project_leader_name + " - " + dataResult[i].project_leader_mobilenumber +
                        "</a>";

                    $("#projectLeader_data").append(str);
                    r++;
                }
            }
        });
    } else {
        document.getElementById('projectLeader_data').style.display = 'none';
    }


}

function searchProject() {
    searchKey = document.getElementById('projectsearchKey').value;
    // setTimeout(function() {

    // }, 500);

    if (searchKey != '') {
        axajUrl = "/searchProjectForProjectId/" + searchKey;
        $.ajax({
            type: "GET",
            url: axajUrl,
            async: false,
            success: function(dataResult) {
                $("#projects_data").empty();
                response = dataResult;
                console.log(dataResult);
                var dataResult = JSON.parse(dataResult);
                document.getElementById('projects_data').style.display = 'block';
                var r = 1;
                for (var i = 0; i < dataResult.length; i++) {
                    var str = "<a href='#' onclick='putItemIntoTextField(" + dataResult[i].id + ",\"" +
                        dataResult[i].project_name + "\");'>" + dataResult[i].project_name + " - " +
                        dataResult[i].project_address + "</a>";
                    $("#projects_data").append(str);
                    r++;
                }
            }
        });
    } else {
        document.getElementById('projects_data').style.display = 'none';
    }
}

function searchSuppliers() {
    searchKey = document.getElementById('supplierssearchKey').value;
    // setTimeout(function() {

    // }, 500);

    if (searchKey != '') {
        axajUrl = "/searchSuppliersForSuppliersId/" + searchKey;
        $.ajax({
            type: "GET",
            url: axajUrl,
            async: false,
            success: function(dataResult) {
                $("#suppliers_data").empty();
                response = dataResult;
                console.log(dataResult);
                var dataResult = JSON.parse(dataResult);
                document.getElementById('suppliers_data').style.display = 'block';
                var r = 1;
                for (var i = 0; i < dataResult.length; i++) {

                    var str = "<a href='#' onclick='putItemIntoTextFieldSuppliers(" + dataResult[i].id +
                        ",\"" + dataResult[i].fullname + "\");'>" + dataResult[i].fullname + " - " +
                        dataResult[i].address + "</a>";

                    $("#suppliers_data").append(str);
                    r++;
                }
            }
        });
    } else {
        document.getElementById('suppliers_data').style.display = 'none';
    }
}

function searchActivities() {
    searchKey = document.getElementById('searchKeyForActivity').value;
    // setTimeout(function() {

    // }, 500);

    if (searchKey != '') {
        axajUrl = "/searchActivityForActivityId/" + searchKey;
        $.ajax({
            type: "GET",
            url: axajUrl,
            async: false,
            success: function(dataResult) {
                $("#activities_data").empty();
                response = dataResult;
                console.log(dataResult);
                var dataResult = JSON.parse(dataResult);
                document.getElementById('activities_data').style.display = 'block';
                var r = 1;
                for (var i = 0; i < dataResult.length; i++) {

                    var str = "<a href='#' onclick='putItemIntoActivityTextField(" + dataResult[i].id +
                        ",\"" + dataResult[i].activities_title + "\");'>" + dataResult[i].activities_title +
                        "</a>";

                    $("#activities_data").append(str);
                    r++;
                }
            }
        });
    } else {
        document.getElementById('activities_data').style.display = 'none';
    }




}

function putItemIntoCustomerTextField(id, customerName) {
    $("#customer_id").val(id);
    $("#searchKey").val(customerName);
    document.getElementById('customers_data').style.display = 'none';

}

function putItemIntoTextFieldForProjectLeader(id, projectLeaderName) {
    $("#project_leader_id").val(id);
    $("#projectLeaderName").val(projectLeaderName);
    document.getElementById('projectLeader_data').style.display = 'none';
}

function putItemIntoActivityTextField(id, activitiesTitle) {
    $("#activities_id").val(id);
    $("#searchKeyForActivity").val(activitiesTitle);
    document.getElementById('activities_data').style.display = 'none';
}

function putItemIntoTextField(id, projectName) {
    $("#project_id").val(id);
    $("#projectsearchKey").val(projectName);
    document.getElementById('projects_data').style.display = 'none';
}

function putItemIntoTextFieldSuppliers(id, fullname) {
    $("#id").val(id);
    $("#supplierssearchKey").val(fullname);
    document.getElementById('suppliers_data').style.display = 'none';
}

function saveProjectItemsData() {

    var token = document.getElementsByName('_token')[0].value;
    var activities_title = document.getElementById('activities_title').value;
    var activities_subtitle = document.getElementById('activities_subtitle').value;
    var unit = document.getElementById('unit').value;
    var activities_cat_ID = document.getElementById('activities_cat_ID').value;

    //alert(token);
    var activities = items.toString();

    axajUrl = "/post/activites";
    $.ajax({
        type: "POST",
        url: axajUrl,
        data: {
            _token: token,
            activities_title: activities_title,
            activities_subtitle: activities_subtitle,
            activities_cat_ID: activities_cat_ID,
            unit: unit,
        },
        async: false,
        success: function(dataResult) {
            var data = JSON.parse(dataResult);

            document.getElementById('activities_id').value = data.activities_id;
            document.getElementById('searchKeyForActivity').value = data.activities_name;

            document.getElementById('ContainerTopRight').style.display = "block";

            $('#exampleModal').modal('hide');


        }
    });

}

function saveSuppliersItemsData() {

    var token = document.getElementsByName('_token')[0].value;
    var fullname = document.getElementById('fullname').value;
    var address = document.getElementById('address').value;
    var email = document.getElementById('email').value;
    var contact_number = document.getElementById('contact_number').value;

    //alert(token);


    axajUrl = "/post/suppliers";
    $.ajax({
        type: "POST",
        url: axajUrl,
        data: {
            _token: token,
            fullname: fullname,
            address: address,
            email: email,
            contact_number: contact_number,
        },
        async: false,
        success: function(dataResult) {
            var data = JSON.parse(dataResult);
            document.getElementById('id').value = data.suppliers_id;
            document.getElementById('supplierssearchKey').value = data.full_name;

            document.getElementById('ContainerTopRight').style.display = "block";

            $('#exampleModal2').modal('hide');


        }
    });





}

function saveProjectData() {

    var token = document.getElementsByName('_token')[0].value;
    var project_name = document.getElementById('project_name').value;
    var project_address = document.getElementById('project_address').value;
    var project_city = document.getElementById('project_city').value;
    var customer_id = document.getElementById('customer_id').value;
    var project_leader_id = document.getElementById('project_leader_id').value;
    var project_fiscal_year = document.getElementById('project_fiscal_year').value;
    var project_duration = document.getElementById('project_duration').value;
    var project_costestimation = document.getElementById('project_costestimation').value;

    //alert(token);


    axajUrl = "/post/projectdata";
    $.ajax({
        type: "POST",
        url: axajUrl,
        data: {
            _token: token,
            project_name: project_name,
            project_address: project_address,
            project_city: project_city,
            customer_id: customer_id,
            project_leader_id: project_leader_id,
            project_fiscal_year: project_fiscal_year,
            project_duration: project_duration,
            project_costestimation: project_costestimation,

        },
        async: false,
        success: function(dataResult) {
            var data = JSON.parse(dataResult);
            document.getElementById('id').value = data.project_id;
            document.getElementById('projectsearchKey').value = data.project_name;

            document.getElementById('ContainerTopRight').style.display = "block";

            $('#exampleModal3').modal('hide');


        }
    });





}

</script>

@endsection