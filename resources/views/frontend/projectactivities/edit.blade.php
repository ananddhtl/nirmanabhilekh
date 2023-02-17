@extends('welcome')

@section('content')
<div id="ContainerTopRight" style="margin-top:110px; display:none;" class="toasts-top-right ">
  <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Project Activities</strong>
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
          <li class="breadcrumb-item"><a href="/">Home</a></li>
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
      <h3 class="card-title">Update project summary </h3>
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
    <form action="{{route('updateProjectActivitiesData')}}" method="POST">
      @csrf
      <div class="card-body">
        <input type="hidden" value="{{@$data[0]->tCode}}" name="tcode" id="tcode">
        <div class="form-group row">
          <label for="status" class="col-sm-1 col-form-label">Date</label>
          <div class="col-sm-2">
            <input type="date" id="billDate" value="{{@$data[0]->fiscal_year}}" class="form-control" name="billDate" />
          </div>


          <label for="status" class="col-sm-1 col-form-label">Project</label>
          <div class="col-sm-4">
            <input type="hidden" class="form-control" name="project_id" id="project_id" value="{{@$data[0]->project_id }}">
            <input type="text" autocomplete="off" class="form-control" name="searchKey" value="{{@$data[0]->project_name }}" onkeyup="searchProject();" id="searchKey" placeholder="Enter Project Name">


            <div class="dropdown-content" id="projects_data">

            </div>

          </div>
        </div>



        <div class="form-group row">


          <label for="status" class="col-sm-1 col-form-label">Items </label>
          <div class="col-sm-2">
            <input type="hidden" class="form-control" name="activities_id" id="activities_id">
            <input type="text" autocomplete="off" class="form-control" name="searchKey" onkeyup="searchActivities();" id="searchKeyForActivity" placeholder="Enter Activities Name">


            <div class="dropdown-content" id="activities_data">

            </div>

          </div>
          <label for="status" class="col-sm-1 col-form-label">Vendor</label>
          <div class="col-sm-1">
            <input type="hidden" class="form-control" name="id" id="id">
            <input type="text" autocomplete="off" class="form-control" name="supplierssearchKey" onkeyup="searchSuppliers();" id="supplierssearchKey" placeholder="Enter Vendor Name">


            <div class="dropdown-content" id="suppliers_data">

            </div>

          </div>

          <label for="debit" class="col-sm-1 col-form-label">Income</label>
          <div class="col-sm-1">
            <input type="number" class="form-control" name="debit" id="debit" onkeyup="changeDebitCredit('debit');" placeholder="Enter Debit">
          </div>


          <label for="credit" class="col-sm-1 col-form-label">Expenses</label>
          <div class="col-sm-1">
            <input type="number" class="form-control" name="credit" onkeyup="changeDebitCredit('credit');" id="credit" placeholder="Enter Credit">
          </div>
          <label for="quantity" class="col-sm-1 col-form-label">Qty</label>
          <div class="col-sm-1">
            <input type="number" class="form-control" name="quantity" onkeyup="" id="quantity" placeholder=" Qty">
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
        <input type="button" value="Save" onclick="saveDataIntoTable();" class="btn btn-info float-sm-left"> </button>

      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>
<script>
  const items = [];

  var total = 0;
</script>

@foreach($data as $item)
<script type="text/javascript">
      //  items.push(activities_Name + '{#}' + activities_id + '{#}' + debit + '{#}' + credit + '{#}' + quantity + '{#}' + vendor_id );
  items.push('{{$item->activities_title}}' + '{#}' + '{{$item->activities_id}}' +  '{#}'  + '{{$item->debit}}' + '{#}' + '{{$item->credit}}' + '{#}' + '{{$item->qty}}'+ '{#}' + '{{$item->fullname}}');
  // items.push(activities_Name + '{#}' + activities_id + '{#}' + debit + '{#}' + credit);
</script>
@endforeach

<script type="text/javascript">
  window.onload = function(e) {

    // getDate();
    displayBasketItemIntoTable();
  }




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
        var vendor_id = document.getElementById('id').value;
        var quantity = document.getElementById('quantity').value;
        var vendor = document.getElementById('supplierssearchKey').value;
        items.push(activities_Name + '{#}' + activities_id + '{#}' + debit + '{#}' + credit + '{#}' + quantity + '{#}' + vendor_id + '{#}' + vendor);

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
      var tcode = document.getElementById('tcode').value;

      //alert(token);
      var activities = items.toString();

      axajUrl = "/update/projectactivites";
      $.ajax({
        type: "POST",
        url: axajUrl,
        data: {
          _token: token,
          fiscal_year: transactionDate,
          project_id: project_id,
          activities: activities,
          tcode: tcode,
        },
        async: false,
        success: function(dataResult) {
          document.getElementById('datatable').innerHTML = "";
          items.splice(0, items.length); //[]
          document.getElementById('ContainerTopRight').style.display = "block";
alert(dataResult);

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

      var str = '<tr><td>' + items[i].split("{#}")[0] + '</td><td>' + items[i].split("{#}")[5] +  '</td><td>' + items[i].split("{#}")[2] + '</td><td>' + items[i].split("{#}")[3] + '</td><td>' + items[i].split("{#}")[4] + '</td><td onclick="removeItem(\'' + items[i] + '\')"> <i class="fas fa-remove"></i></td></tr>';


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

            var str = '<tr><td>' + items[i].split("{#}")[0] + '</td><td>' + items[i].split("{#}")[4] + '</td><td>' + items[i].split("{#}")[2] + '</td><td>' + items[i].split("{#}")[3] + '</td><td>' + items[i].split("{#}")[5] + '</td><td onclick="removeItem(\'' + items[i] + '\')"> <i class="fas fa-remove"></i></td></tr>';

            $("#projects_data").append(str);
            r++;
          }
        }
      });
    } else {
      document.getElementById('projects_data').style.display = 'none';
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

            var str = "<a href='#' onclick='putItemIntoActivityTextField(" + dataResult[i].id + ",\"" + dataResult[i].activities_title + "\");'>" + dataResult[i].activities_title + "</a>";

            $("#activities_data").append(str);
            r++;
          }
        }
      });
    } else {
      document.getElementById('activities_data').style.display = 'none';
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
  function putItemIntoTextFieldSuppliers(id, fullname) {
    $("#id").val(id);
    $("#supplierssearchKey").val(fullname);
    document.getElementById('suppliers_data').style.display = 'none';
  }

  function putItemIntoActivityTextField(id, activitiesTitle) {
    $("#activities_id").val(id);
    $("#searchKeyForActivity").val(activitiesTitle);
    document.getElementById('activities_data').style.display = 'none';
  }

  function putItemIntoTextField(id, projectName) {
    $("#project_id").val(id);
    $("#searchKey").val(projectName);
    document.getElementById('projects_data').style.display = 'none';
  }
</script>

@endsection