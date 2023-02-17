@extends('welcome')

@section('content')
@if (session('status'))

<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-success alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Added Service Bill Items Data</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('status')}}</div>
  </div>
</div>
@endif
@if (session('message'))
<div id="ContainerTopRight" style="margin-top:110px;" class="toasts-top-right ">
  <div class="alert alert-danger alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Delete Service Bill Items Data</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('message')}}</div>
  </div>
</div>

@endif
@if (session('messages'))
<div id="ContainerTopRight" style="margin-top:110px; " class="toasts-top-right ">
  <div class="alert alert-info alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="header"><strong class="mr-auto">&nbsp;&nbsp;&nbsp;&nbsp;Update Service Bill Items Data</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">{{session('messages')}}</div>
  </div>
</div>
@endif





<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="/servicebillitems/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/servicebillitems/list">List</a></li>

        </ol>
      </div>
    </div>
  </div>

  <!-- Input addon -->

  <!-- /.card -->
  <!-- Horizontal Form -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Service billing list </h3>

    </div>

    <div class="card-body">
      <div class="col-md-12">

        <div class="row">
          <div class="col-md-6 ">
            <form action="{{url('/servicebillitemssearch')}}" method="GET" accept-charset="utf-8">
              @csrf
              <div style="margin-bottom:25px; " class="input-group">
                <input type="text" name="customer_id" autocomplete="off" class="form-control form-control-lg" placeholder="Customer name">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-lg btn-info">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <table class="table table-bordered" id="mytable">
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Total Amount</th>

              <th>Discount</th>
              <th>All Total Amount</th>
              <th>Bill Date</th>
              <th>Action</th>



            </tr>
          </thead>
          <tbody>
          <tbody>
            @foreach($serviceBillAmount as $servicebillamount)
            <tr>
              <td>{{ $servicebillamount ->customer_name }} </td>
              <td>{{ $servicebillamount ->totalamount  }}</td>

              <td>{{ $servicebillamount ->discount }}</td>
              <td>{{ $servicebillamount ->alltotalamount }} </td>
              <td>{{ $servicebillamount ->billDate }} </td>



              <td>
                <button style="width:40px;" type="button" class="btn btn-secondary" onclick="serviceItems('{{$servicebillamount->tCode}}')">
                  <i style=" color:white;" class="fa-solid fa-eye"></i>
                </button>
                <a style="width:40px" href="{{url('edit-servicebillamount/'.$servicebillamount->tCode)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                <button style="width:40px" type="button" class="btn btn-danger btn-sm" data-toggle="modal" onclick="showModal('{{$servicebillamount->id}}','{{$servicebillamount->tCode}}')" data-target="#exampleModalLong"><i class="fas fa-remove"></i>
              </td>

            </tr>
            @endforeach
          </tbody>
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
          <a href="{{route('servicebillitem.export')}}">
            <form action="" method="POST" enctype="multipart/form-data">
              @csrf
            </form>



            <button type="button" class="btn btn-block btn-info"> <i class="fa-solid fa-download"></i>&nbsp;&nbsp;&nbsp;Excel</button>

          </a>
        </div>

      </ul>
    </div>
  </div>






  <!-- /.col -->
  <div class="modal fade " id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="modal-header bg bg-danger">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete Service Bill Items </i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this item?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
          <a href="#" id="deleteItem" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div style="width:1200px;" class="modal-content">
        <div class="modal-header btn btn-info">
          <h5 class="modal-title" id="exampleModalLongTitle">Bill Items List</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>

                  <th>Service Name</th>

                  <th>Quantity</th>
                  <th>Service Rate</th>




                </tr>
              </thead>
              <tbody>
                </thead>
              <tbody id="datatable">



              </tbody>
            </table>
          </div>

        </div>

      </div>
    </div>
  </div>
  <script>
    function showModal(id,tcode) {
      //alert(tcode);
      document.getElementById("deleteItem").href = "/delete-servicebillamount/" + tcode;
      $("#exampleModalLong").modal();

    }

    function serviceItems(tCode) {

      axajUrl = "/searchServiceItems/" + tCode;
      $.ajax({
        type: "GET",
        url: axajUrl,
        async: false,
        success: function(dataResult) {
          $("#datatable").empty();

          response = dataResult;

          console.log(dataResult);
          var dataResult = JSON.parse(dataResult);

          var r = 1;
          for (var i = 0; i < dataResult.length; i++) {

            var str = '<tr><td>' + dataResult[i].service_name + '</td><td>' + dataResult[i].quantity + '</td><td>' + dataResult[i].service_rate;
            //  var str = "<a href='#' onclick='putItemIntoTextFieldFromService(" + dataResult[i].id + ",\"" + dataResult[i].service_name + "\",\"" + dataResult[i].service_rate + "\");'>" + dataResult[i].service_name + " - " + dataResult[i].service_rate + "</a>";

            $("#datatable").append(str);
            r++;
          }
        }
      });

      $("#exampleModalCenter").modal();
    };
  </script>


  @endsection