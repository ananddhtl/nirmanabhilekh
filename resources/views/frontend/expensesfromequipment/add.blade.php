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
          <li class="breadcrumb-item active"><a href="/expensesequipment/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/showexpensesequipment">List</a></li>


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
      <h3 class="card-title">Add equipment expense </h3>
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
    <form action="{{route('addexpensesequipment')}}" method="POST">
      @csrf
      <div class="card-body">

        <div class="form-group row">
          <label for="date" class="col-sm-3 col-form-label">Transaction Date</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" autocomplete="off" name="date" id="startDate" placeholder="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="status" class="col-sm-3 col-form-label">Equipment </label>
          <div class="col-sm-9">
            <input type="hidden" class="form-control" name="equipment_id" id="equipment_id">
            <input type="text" class="form-control" autocomplete="off" name="EquipmentName" onkeypress="searchEquipment();" id="EquipmentName" placeholder="Enter Equipment Name" required>
            <div class="dropdown-content" id="equipments_data">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="status" class="col-sm-3 col-form-label">Customer </label>
          <div class="col-sm-9">
            <input type="hidden" class="form-control" name="customer_id" id="customer_id">
            <input type="text" class="form-control" autocomplete="off" name="searchKey" onkeypress="searchCustomer();" id="searchKey" placeholder="Enter Customer Name" required>
            <div class="dropdown-content" id="customers_data">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="amount" class="col-sm-3 col-form-label"> Total Amount</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" autocomplete="off" name="amount" id="amount" placeholder="Enter Amount" required>
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
    document.getElementById('customers_data').style.display = 'none'
  }
</script>


@endsection