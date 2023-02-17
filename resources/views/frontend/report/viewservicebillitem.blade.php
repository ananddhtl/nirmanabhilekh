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
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="/servicebillitems/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/servicebillitems/list">List</a></li>

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
      <h3 class="card-title">Service Bill Items Report </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if($errors->any())
    <div class="m-2 p-2">
      <ul>
        @foreach ($errors->all() as $error)
        <div class="form-control form-control is-invalid">{{$error}}</div>
        @endforeach
      </ul>˝
    </div>
    @endif
    <form action="" method="POST">
      @csrf
      <div class="card-body">
        <div class="form-group row">
          <label for="status" class="col-sm-1 col-form-label">Date</label>
          <div class="col-sm-3">
            <input type="date" id="billDate" class="form-control" name="billDate" value="2022-09-26" />
          </div>

          <label for="status" class="col-sm-1 col-form-label">Bill No</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" value="Auto" readonly name="billNo" />
          </div>

        </div>

        <div style="border-bottom:red" class="form-group row">
          <label for="status" class="col-sm-1 col-form-label"> Name</label>
          <div class="col-sm-3">
            <input type="hidden" class="form-control" name="customer_id" id="customer_id">
            <input type="text" autocomplete="off" value="{{$data[0]->customer_name}}" class="form-control" name="searchKey" onkeyup="searchCustomer();" id="searchKey" placeholder="Customer Name">


            <div class="dropdown-content" id="customers_data">


            </div>



          </div>
          <label for="status" class="col-sm-1 col-form-label">Address</label>
          <div class="col-sm-3">

            <input type="text" autocomplete="off" class="form-control" value="{{$data[0]->customer_address}}" id="customerAddress" placeholder="Customer Address">

          </div>
          <label for="status" class="col-sm-1 col-form-label">Contact</label>
          <div class="col-sm-3"> <input type="text" autocomplete="off" class="form-control" value="{{$data[0]->customer_phonenumber}}" id="customerContact" placeholder="Customer Contact Number">
          </div>
        </div>






      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="">
            <div class="card-header">
              <div class="form-group row">


                <form>

                  <label for="status" class="col-sm-1 col-form-label">Item</label>
                  <div class="col-sm-3">
                    <input type="hidden" class="form-control" name="service_id" id="service_id">
                    <input type="text" autocomplete="off" class="form-control" name="searchKeyForService" onkeyup="searchService();" id="searchKeyForService" placeholder="Search service">


                    <div class="dropdown-content" id="services_data">

                    </div>

                  </div>
                  <label for="status" class="col-sm-1 col-form-label">Qty</label>
                  <div class="col-sm-1">

                    <input type="number" id="quantity" autocomplete="off" class="form-control" name="quantity" placeholder="Qty">


                  </div>
                  <label for="status" class="col-sm-1 col-form-label">Rate</label>
                  <div class="col-sm-2">

                    <input type="text" autocomplete="off" class="form-control" id="service_rate" placeholder="Service Rate">
                  </div>
                  <div class="col-sm">
                    <input type="button" value="Add" onclick="addItemIntoBasket();" class="btn btn-info"></button>
                  </div>
                  <form>

              </div>

              <div>
                <table class="table ">

                  <tbody id="datatable">

                  <tbody>

                </table>
              </div>
            </div>
          </div>




        </div>
      </div>
      <div class="card-body">


        <div class="form-group row">
          <label for="status" class="col-sm-1 col-form-label"> Total</label>
          <div class="col-sm-3">
            <input type="text" readonly id="total" value="{{$data[0]->totalamount}}" autocomplete="off" class="form-control">
          </div>
          <label for="status" class="col-sm-1 col-form-label">Discount</label>
          <div class="col-sm-3">
            <input type="text" id="discount" value="{{$data[0]->discount}}" onkeyup="calculate();" autocomplete="off" class="form-control">
          </div>
          <label for="status" class="col-sm-1 col-form-label">All Total</label>
          <div class="col-sm-3">
            <input type="text" autocomplete="off" id="alltotal" value="{{$data[0]->alltotalamount}}" readonly="true" class="form-control">
          </div>
        </div>
      </div>
     
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>
<script>
  const items = [];
  // const serviceId = [];
  // const sreviceQty = [];
  // const serviceRate = [];
  var total = 0;
</script>


@foreach($servicebillitems as $item)
<script type="text/javascript">
  // alert('{{$item->service_name}}');
  items.push('{{$item->service_name}}' + '{#}' + '{{$item->service_id}}' + '{#}' + '{{$item->quantity}}'  + '{#}' + '{{$item->service_rate}}');

  </script>
@endforeach

<script type="text/javascript">
  window.onload = function(e) {

    getDate();



    displayBasketItemIntoTable();

  }
  

  function addItemIntoBasket() {
    var isBlank = false;

    if (document.getElementById("searchKeyForService").value == '') {
      // document.getElementById("warning").style.display = 'block';
      // document.getElementById("msg").value="Service field is .";
      document.getElementById("searchKeyForService").focus();
      isBlank = true;
    } else if (document.getElementById("quantity").value == '') {
      document.getElementById("quantity").focus();
      isBlank = true;
    } else if (document.getElementById("service_rate").value == '') {
      document.getElementById("service_rate").focus();
      isBlank = true;
    }

    if (isBlank == false) {
      if (document.getElementById('service_id').value != '') {
        var service = document.getElementById('searchKeyForService').value;
        var service_id = document.getElementById('service_id').value;
        var qty = document.getElementById('quantity').value;
        var rate = document.getElementById('service_rate').value;
        items.push(service + '{#}' + service_id + '{#}' + qty + '{#}' + rate);


        displayBasketItemIntoTable();
        document.getElementById('searchKeyForService').value = "";
        document.getElementById('service_id').value = "";
        document.getElementById('quantity').value = "";
        document.getElementById('service_rate').value = "";
      }
    }


  }

  function calculate() {
    document.getElementById('alltotal').value = parseFloat(document.getElementById('total').value - parseFloat(document.getElementById('discount').value));

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

  function saveDataIntoTable() {
    if (document.getElementById("customer_id").value == '') {
      document.getElementById("searchKey").focus();
    } else if (items.length == 0) {
      document.getElementById("searchKeyForService").focus();
    } else {
      var transactionDate = document.getElementById('billDate').value;
      var customer_id = document.getElementById('customer_id').value;
      var token = document.getElementsByName('_token')[0].value;
      var discount = document.getElementById('discount').value;
      var totalamount = document.getElementById('total').value;
      var alltotalamount = document.getElementById('alltotal').value;

      var services = items.toString();

      axajUrl = "/post/servicebillitems";
      $.ajax({
        type: "POST",
        url: axajUrl,
        data: {
          _token: token,
          billDate: transactionDate,
          customer_id: customer_id,
          services: services,
          discount: discount,
          totalamount: totalamount,
          alltotalamount: alltotalamount,
        },
        async: false,
        success: function(dataResult) {
          // alert(dataResult);
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
      total += parseFloat(items[i].split("{#}")[2]) * parseFloat(items[i].split("{#}")[3]);

      var str = '<tr><td>' + items[i].split("{#}")[0] + '</td><td>' + items[i].split("{#}")[2] + '</td><td>' + items[i].split("{#}")[3] + '</td><td onclick="removeItem(\'' + items[i] + '\')"> <i class="fas fa-remove"></i></td></tr>';

      $('#datatable').append(str);
    }
    document.getElementById('total').value = total;
    document.getElementById('alltotal').value = total;
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

            var str = "<a href='#' onclick='putItemIntoTextField(" + dataResult[i].id + ",\"" + dataResult[i].customer_name + "\",\"" + dataResult[i].customer_address + "\",\"" + dataResult[i].customer_phonenumber + "\");'>" + dataResult[i].customer_name + " - " + dataResult[i].customer_phonenumber + "</a>";

            $("#customers_data").append(str);
            r++;
          }
        }
      });
    } else {
      document.getElementById('customers_data').style.display = 'none';
    }



  }


  function searchService() {
    searchKey = document.getElementById('searchKeyForService').value;
    // setTimeout(function() {

    // }, 500);

    if (searchKey != '') {
      axajUrl = "/searchServiceForServiceId/" + searchKey;
      $.ajax({
        type: "GET",
        url: axajUrl,
        async: false,
        success: function(dataResult) {
          $("#services_data").empty();
          response = dataResult;
          console.log(dataResult);
          var dataResult = JSON.parse(dataResult);
          document.getElementById('services_data').style.display = 'block';
          var r = 1;
          for (var i = 0; i < dataResult.length; i++) {

            var str = "<a href='#' onclick='putItemIntoTextFieldFromService(" + dataResult[i].id + ",\"" + dataResult[i].service_name + "\",\"" + dataResult[i].service_rate + "\");'>" + dataResult[i].service_name + " - " + dataResult[i].service_rate + "</a>";

            $("#services_data").append(str);
            r++;
          }
        }
      });
    } else {
      document.getElementById('services_data').style.display = 'none';
    }



  }

  function putItemIntoTextField(id, customerName, customerAddress, customerContact) {
    document.getElementById('customers_data').style.display = 'none';
    $("#customer_id").val(id);
    $("#searchKey").val(customerName);
    $("#customerAddress").val(customerAddress);
    $("#customerContact").val(customerContact);

    document.getElementById('customers_data').style.display = 'none';
  }





  function putItemIntoTextFieldFromService(id, serviceName, serviceRate) {
    $("#service_id").val(id);
    $("#searchKeyForService").val(serviceName);
    $("#service_rate").val(serviceRate);
    document.getElementById('services_data').style.display = 'none';
  }
</script>



@endsection