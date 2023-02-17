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
        <div class="row mb-8">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-center">

                </ol>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item active"><a href="/">Home</a></li>


                </ol>
            </div>
        </div>
    </div>









    <!-- Input addon -->

    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"></h3>
            Equipment expense report
        </div>

        <div class="card-body">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12 ">
                        <form action="{{url('/searchDateInExpenses')}}" method="GET" accept-charset="utf-8">
                            @csrf
                            <div class="form-group row">
                                <label for="date" class="col-sm-1 col-form-label">From:</label>
                                <div class="col-sm-3">
                                    <input type="date" id="startDate" class="form-control" name="From" value="2022-10-4" />
                                </div>
                                <label for="date" class="col-sm-1 col-form-label">To:</label>
                                <div class="col-sm-3">
                                    <input type="date" id="endDate" class="form-control" name="To" value="2022-10-4" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Equipment: </label>
                                <div class="col-sm-4">
                                    <input type="hidden" class="form-control" name="equipment_id" id="equipment_id">
                                    <input type="text" class="form-control" autocomplete="off" name="EquipmentName" onkeyup="searchEquipment();" id="EquipmentName" placeholder="Search equipment name" required>


                                    <div class="dropdown-content" id="equipments_data">

                                    </div>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-info " data-dismiss="modal">View</button>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>
                <table class="table table-bordered" id="mytable">

                    <thead>


                        <tr>
                            <th>S.N</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Equipment Name</th>
                            <th> Amount</th>



                        </tr>
                    </thead>

                    <tbody>
                        @if(!empty($data))
                        <?php $i = 0;
                        $amounttotal = 0;
                        ?>
                        @foreach($data as $item)
                        <?php $i++;
                        $amounttotal += $item->amount;

                        ?>
                        <tr>

                            <td>{{ $item->id }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->customer_name }}</td>
                            <td>{{ $item->equipment_name}} </td>
                            <td>{{ $item->amount}} </td>




                        </tr>

                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>

                            <td></td>
                            <th>Total</th>
                            <th>{{ $amounttotal }}</th>

                    </tbody>
                    @endif
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-left">
                <div style="font-size:20px;" class="row">


                </div>
            </ul>


            <ul class="pagination pagination-sm m-0 float-right">
                <div class="row">
                    <a href="{{url('expenses-export')}}">


                        <button type="button" class="btn btn-block btn-info"> <i class="fa-solid fa-download"></i>&nbsp;&nbsp;&nbsp;Excel</button>

                    </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="">


                        <button type="button" onclick="printData();"class="btn btn-block btn-primary"> <i class="fa-solid fa-print"></i>&nbsp;&nbsp;&nbsp;Print</button>

                    </a>
                </div>

            </ul>
        </div>

    </div><!-- /.card -->










    <!-- Modal -->

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

        function calculate() {
            document.getElementById('alltotal').value = parseFloat(document.getElementById('total').value - parseFloat(document.getElementById('discount').value));

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

        function searchEquipment() {
            var searchEquipment = document.getElementById('EquipmentName').value;
            // setTimeout(function() {

            // }, 500);

            if (searchEquipment != '') {
                axajUrl = "/searchEquipmentForEquipmentId/" + searchEquipment;
                $.ajax({
                    type: "GET",
                    url: axajUrl,
                    async: false,
                    success: function(dataResult) {
                        $("#equipments_data").empty();
                        response = dataResult;
                        console.log(dataResult);
                        var dataResult = JSON.parse(dataResult);
                        document.getElementById('equipments_data').style.display = 'block';
                        var r = 1;
                        for (var i = 0; i < dataResult.length; i++) {

                            var str = "<a href='#' onclick='putItemIntoTextFieldFromEquipment(" + dataResult[i].id + ",\"" + dataResult[i].equipment_name + "\");'>" + dataResult[i].equipment_name + " - " + dataResult[i].purchase_rate + "</a>";

                            $("#equipments_data").append(str);
                            r++;
                        }
                    }
                });
            } else {
                document.getElementById('equipments_data').style.display = 'none';
            }



        }


        function putItemIntoTextFieldFromEquipment(id, equipmentsName, purchaseRate) {
            $("#equipment_id").val(id);
            $("#EquipmentName").val(equipmentsName);
            $("#purchaseRate").val(purchaseRate);
            document.getElementById('equipments_data').style.display = 'none';
        }

        function putItemIntoTextField(id, customerName) {
            $("#customer_id").val(id);
            $("#searchKey").val(customerName);
            document.getElementById('customers_data').style.display = 'none';
        }

        function printData() {
            var divToPrint = document.getElementById("mytable");
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>

    @endsection