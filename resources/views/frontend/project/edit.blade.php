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
          <li class="breadcrumb-item active"><a href="/project/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/project/list">List</a></li>

        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="col-md-8">



  <!-- Input addon -->

  <!-- /.card -->
  <!-- Horizontal Form -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"> Update Project</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->




    <form action="{{route('updateProject',$data[0]->id)}}" method="POST">
      @csrf
      <div class="card-body">

        <div class="form-group row">
          <label for="project_name" class="col-sm-2 col-form-label">Project Title</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="project_name" id="project_name" value="{{$data[0]->project_name}}" placeholder="Project title">
          </div>
        </div>
        <div class="form-group row">
          <label for="project_address" class="col-sm-2 col-form-label">Project Location</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="project_address" id="project_address" value="{{$data[0]->project_address}}" placeholder="Project location">
          </div>
        </div>
        <div class="form-group row">
          <label for="project_city" class="col-sm-2 col-form-label"> Project City</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="project_city" id="project_city" value="{{$data[0]->project_city}}" placeholder="Project city">
          </div>
        </div>

        <div class="form-group row">
          <label for="project_name" class="col-sm-2 col-form-label">Customer Name</label>
          <div class="col-sm-10">
            <input type="hidden" class="form-control" name="customer_id" id="customer_id">
            <input type="text" class="form-control" autocomplete="off" name="searchKey" value="{{$data[0]->customer_name}}" onkeyup="searchCustomer();" id="searchKey" placeholder="Search customer">
            <div class="dropdown-content" id="customers_data">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="status" class="col-sm-2 col-form-label">Project Leader</label>
          <div class="col-sm-10">

            <input type="hidden" class="form-control" value="{{@$data[0]->project_leader_id}}" name="project_leader_id" id="project_leader_id">
            <input type="text" class="form-control" value="{{@$data[0]->project_leader_name}}" autocomplete="off" name="projectLeaderName" onkeyup="searchProjectLeader();" id="projectLeaderName" placeholder="Search project leader" required>
            <div class="dropdown-content" id="projectLeader_data">

            </div>


          </div>
        </div>
        <div class="form-group row">
          <label for="project_fiscal_year" class="col-sm-2 col-form-label"> Fiscal Year</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="project_fiscal_year" id="project_fiscal_year" value="{{$data[0]->project_fiscal_year}}" placeholder="Project fiscal Year">
          </div>
        </div>
        <div class="form-group row">
          <label for="project_duration" class="col-sm-2 col-form-label"> Duration</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="project_duration" id="project_duration" value="{{$data[0]->project_duration}}" placeholder="Project duration">
          </div>
        </div>
        <div class="form-group row">
          <label for="project_costestimation" class="col-sm-2 col-form-label"> Cost Estimation</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="project_costestimation" id="project_costestimation" value="{{$data[0]->project_costestimation}}" placeholder="Project Cost Estimation">
          </div>
        </div>


      </div>





      <div class="card-footer">
        <input type="submit" value="Update " class="btn btn-info"> </button>

      </div>
      <!-- /.card-footer -->
    </form>
  </div>
</div>
<!-- /.card -->
@endsection
<script type="text/javascript">
  let searchKey = '';

  function searchProjectLeader() {
    var searchProjectLeader = document.getElementById('projectLeaderName').value;
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

            var str = "<a href='#' onclick='putItemIntoTextFieldForProjectLeader(" + dataResult[i].id + ",\"" + dataResult[i].project_leader_name + "\");'>" + dataResult[i].project_leader_name + " - " + dataResult[i].project_leader_mobilenumber + "</a>";

            $("#projectLeader_data").append(str);
            r++;
          }
        }
      });
    } else {
      document.getElementById('projectLeader_data').style.display = 'none';
    }


  }



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
  function putItemIntoTextFieldForProjectLeader(id, customerName) {
    $("#project_leader_id").val(id);
    $("#projectLeaderName").val(customerName);
    document.getElementById('projectLeader_data').style.display = 'none';
  }
  function putItemIntoTextField(id, customerName) {
    $("#customer_id").val(id);
    $("#searchKey").val(customerName);
    document.getElementById('customers_data').style.display = 'none';
  }
</script>