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
      <h3 class="card-title">Update equipment expenses </h3>
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
    <form action="{{url('update-fromexpensesequipment' ,$data[0]->id)}}" method="POST">
      @csrf
      <div class="card-body">
        <div class="form-group row">
          <label for="date" class="col-sm-3 col-form-label">Transaction Date</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" value="{{$data[0]->date}}" autocomplete="off" name="date" id="startDate" placeholder="" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="status" class="col-sm-3 col-form-label">Equipment </label>
          <div class="col-sm-9">
            <input type="hidden" class="form-control" name="equipment_id" id="equipment_id" value="{{$data[0]->equipment_id}}">
            <input type="text" class="form-control" autocomplete="off" name="EquipmentName" value="{{$data[0]->equipment_name}}" onkeypress="searchEquipment();" id="EquipmentName" placeholder="Enter Equipment Name" required>
            <div class="dropdown-content" id="equipments_data">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="status" class="col-sm-3 col-form-label">Customer </label>
          <div class="col-sm-9">
            <input type="hidden" class="form-control" name="customer_id" id="customer_id" value="{{$data[0]->customer_id}}">
            <input type="text" class="form-control" autocomplete="off" name="searchKey" value="{{$data[0]->customer_name}}" onkeypress="searchCustomer();" id="searchKey" placeholder="Enter Customer Name" required>


            <div class="dropdown-content" id="customers_data">

            </div>

          </div>
        </div>
        <div class="form-group row">
          <label for="amount" class="col-sm-3 col-form-label"> Amount</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" autocomplete="off" name="amount" value="{{$data[0]->amount}}" id="amount" placeholder="Enter Amount">
          </div>
        </div>
      </div>

      <div class="card-footer">
        <input type="submit" value="Update" class="btn btn-info float-sm-left"></button>

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
    searchKey = document.getElementById('searchKey').value;


    if (searchKeyEquipment != '') {
      axajUrl = "/searchEquipmentName/" + searchKey;
      $.ajax({
        type: "GET",
        url: axajUrl,
        async: false,
        success: function(dataResult) {
          $("#equipment_data").empty();
          response = dataResult;
          console.log(dataResult);
          var dataResult = JSON.parse(dataResult);
          document.getElementById('equipment_data').style.display = 'block';
          var r = 1;
          for (var i = 0; i < dataResult.length; i++) {

            var str = "<a href='#' onclick='putItemIntoTextFieldForEquipment(" + dataResult[i].id + ",\"" + dataResult[i].equipment_name + "\");'>" + dataResult[i].equipment_name + " - " + dataResult[i].purchase_rate + "</a>";

            $("#equipment_data").append(str);
            r++;
          }
        }
      });
    } else {
      document.getElementById('equipment_data').style.display = 'none';
    }



  }





  function putItemIntoTextField(id, customerName) {
    $("#customer_id").val(id);
    $("#searchKey").val(customerName);
    document.getElementById('customers_data').style.display = 'none';
  }

  function putItemIntoTextFieldForEquipment(id, equipmentName) {
    $("#equipment_id").val(id);
    $("#searchKeyEquipment").val(equipmentName);
    document.getElementById('equipment_data').style.display = 'none';
  }
</script>


@endsection