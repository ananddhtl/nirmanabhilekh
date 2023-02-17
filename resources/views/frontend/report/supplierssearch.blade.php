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
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> Project Summary Report </h3>

                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <form action="{{url('/searchDateWithSuppliers')}}" method="GET" accept-charset="utf-8">
                                @csrf



                                <div class="form-group row">
                                    <label for="status" class="col-sm-1 col-form-label">Suppliers:</label>
                                    <div class="col-sm-3">
                                        <input type="hidden" class="form-control" name="suppliers_id" id="suppliers_id">
                                        <input type="text" class="form-control" autocomplete="off" name="fullname" onkeyup="searchSuppliers();" id="supplierssearchKey" placeholder="Search Suppliers" required>
                                        <div class="dropdown-content" id="suppliers_data">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info " data-dismiss="modal">View</button>

                        </div>

                        </form>
                    </div>

                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project </th>
                                <th>Suppliers Name</th>
                                <th>Quantity</th>
                                <th>Debit</th>
                                <th>Credit</th>

                                <th>Balance</th>


                                <!-- <th> Action </th> -->
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $totalDebit = 0;
                            $totalCredit = 0;
                            ?>
                            @foreach($data as $projectactivity)
                            <tr>
                                <?php
                                $totalDebit += $projectactivity->debit;
                                $totalCredit += $projectactivity->credit;
                                ?>
                                <td>{{ $projectactivity->fiscal_year }}</td>
                                <td>{{ $projectactivity->project_name }}</td>
                                <td>{{ $projectactivity->fullname }}</td>
                                <td>{{ $projectactivity->qty }} </td>
                                <td>{{ $projectactivity->debit }} </td>
                                <td>{{ $projectactivity->credit }} </td>

                                <th>{{$projectactivity->debit-$projectactivity->credit}}</th>
                            </tr>
                            @endforeach
                            <tr>
                                <th></th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th>{{$totalDebit}}</th>
                                <th>{{$totalCredit}}</th>
                                <th>{{$totalDebit-$totalCredit}}</th>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-left">
                        <div style="font-size:20px;" class="row">
                        </div>
                    </ul>
                    <ul class="pagination pagination-sm m-0 float-right">
                        <div class="row">


                            </form>
                            <a href="{{route('projectactivities.export')}}">


                                <button type="button" class="btn btn-block btn-primary"> <i class="fa-solid fa-download"></i>&nbsp;&nbsp;&nbsp;Excel</button>

                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{{route('forProjectActivitiesData')}}">

                                <button type="button" class="btn btn-block btn-info"> <i class="fa-solid fa-print"></i>&nbsp;&nbsp;&nbsp;Print</button>

                            </a>
                        </div>

                        </a>
                </div>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /.card-body -->
<script type="text/javascript">
    window.onload = function(e) {

        getDate();

    }
    let searchKey = '';

    function searchProject() {
        searchKey = document.getElementById('searchKey').value;
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

                        var str = "<a href='#' onclick='putItemIntoTextField(" + dataResult[i].id + ",\"" + dataResult[i].project_name + "\");'>" + dataResult[i].project_name + " - " + dataResult[i].project_address + "</a>";

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

                        var str = "<a href='#' onclick='putItemIntoTextFieldSuppliers(" + dataResult[i].id + ",\"" + dataResult[i].fullname + "\");'>" + dataResult[i].fullname + " - " + dataResult[i].address + "</a>";

                        $("#suppliers_data").append(str);
                        r++;
                    }
                }
            });
        } else {
            document.getElementById('suppliers_data').style.display = 'none';
        }
    }




    function putItemIntoTextField(id, projectName) {
        $("#project_id").val(id);
        $("#searchKey").val(projectName);
        document.getElementById('projects_data').style.display = 'none';
    }

    function putItemIntoTextFieldSuppliers(id, fullname) {
        $("#suppliers_id").val(id);
        $("#supplierssearchKey").val(fullname);
        document.getElementById('suppliers_data').style.display = 'none';
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
        document.getElementById("endDate").value = datestring;
    }

    function calculate() {
        document.getElementById('alltotal').value = parseFloat(document.getElementById('total').value - parseFloat(document.getElementById('discount').value));

    }
</script>


@endsection