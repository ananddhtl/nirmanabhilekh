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
                    <h3 class="card-title"> Service Billing Report </h3>

                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <form action="{{url('/searchBillDateWithCustomer')}}" method="GET" accept-charset="utf-8">
                                @csrf
                                <div class="form-group row">
                                    <label for="date" class="col-sm-1 col-form-label">From:</label>
                                    <div class="col-sm-3">
                                        <input type="date" id="startDate" class="form-control" name="from" value="2022-09-26" />
                                    </div>

                                    <label for="date" class="col-sm-1 col-form-label">To:</label>
                                    <div class="col-sm-3">
                                        <input type="date" id="endDate" class="form-control" name="to" value="2022-09-26" />
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-sm-1 col-form-label">Customer: </label>
                                    <div class="col-sm-3">
                                        <input type="hidden" class="form-control" name="customer_id" id="customer_id">
                                        <input type="text" class="form-control" autocomplete="off" name="customer_name" onkeyup="searchCustomer();" id="searchKey" placeholder="Search customer">


                                        <div class="dropdown-content" id="customers_data">

                                        </div>

                                    </div>


                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-info " data-dismiss="modal">View</button>
                                    </div>
                                </div>

                </div>
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Total Amount</th>

                        <th>Discount</th>
                        <th>All Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($serviceBillAmount))
                    <?php $i = 0;
                    $amounttotal = 0;
                    $totaldiscount = 0;
                    $alltotalamount = 0;
                    ?>
                    @foreach($serviceBillAmount as $item)
                    <?php $i++;
                    $amounttotal += $item->totalamount;
                    $totaldiscount += $item->discount;
                    $alltotalamount += $item->alltotalamount;
                    ?>
                    <tr>
                        <td>{{ $item ->id }} </td>
                        <td>{{ $item ->billDate }} </td>
                        <td>{{ $item ->customer_name }} </td>
                        <td>{{ $item ->totalamount  }}</td>

                        <td>{{ $item ->discount }}</td>
                        <td>{{ $item ->alltotalamount }} </td>
                        <td><a style="width:40px" href="{{url('edit-servicebilling/'.$item->tCode)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <th>Total</th>
                        <th>{{ $amounttotal }}</th>
                        <th>{{ $totaldiscount }} </th>
                        <th>{{ $alltotalamount }} </th>
                    </tr>
                    @endif
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

                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                        </form>
                        <div class="row">
                            <a href="{{route('servicebillitem.export')}}">


                                <button type="button" class="btn btn-block btn-primary"> <i class="fa-solid fa-download"></i>&nbsp;&nbsp;&nbsp;Excel</button>

                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{{route('forServiceInvoiceData')}}">

                                <button type="button" class="btn btn-block btn-info"> <i class="fa-solid fa-print"></i>&nbsp;&nbsp;&nbsp;Print</button>

                            </a>
                        </div>

                        </a>
                    </div>
                </ul>
            </div>
        </div>
    </div>

    </div>



    <script type="text/javascript">
        window.onload = function(e) {

            getDate();

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

                            var str = "<a href='#' onclick='putItemIntoTextField(" + dataResult[i].id + ",\"" + dataResult[i].customer_name + "\");'>" + dataResult[i].customer_name + " - " + dataResult[i].customer_phonenumber + "</a>";

                            $("#customers_data").append(str);
                            r++;
                        }
                    }
                });
            } else {
                document.getElementById('customers_data').style.display = 'none';
            }



        }

        function putItemIntoTextField(id, customerName) {
            $("#customer_id").val(id);
            $("#searchKey").val(customerName);
            document.getElementById('customers_data').style.display = 'none';
        }
    </script>



    @endsection