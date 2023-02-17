@extends('welcome')

@section('content')



<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>

          

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
      <h3 class="card-title">Project Activities Report</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form action="{{route('updateProjectActivity',$data->id)}}" method="POST">
      @csrf
      <div class="card-body">
        <!-- <div class="form-group row">
                    <label for="project_id" class="col-sm-2 col-form-label">Project ID</label>
                    <div class="col-sm-10">
                      <input type="proje" class="form-control" id="projectid" placeholder="Project ID">
                    </div>
                  </div> -->
        
        <div class="form-group row">
          <label for="leader_name" class="col-sm-2 col-form-label">Project Name</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" name="project_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
              @foreach($project as $item)
              @if($data->project_id==$item->id)
              <option value="{{$item->id}}" selected>{{$item->project_name}}</option>
              @else
              <option value="{{$item->id}}">{{$item->project_name}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="leader_name" class="col-sm-2 col-form-label">Activities Name</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" name="activities_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
              @foreach($activity as $item)
              @if($data->activities_id==$item->id)
              <option value="{{$item->id}}" selected>{{$item->activities_title}}</option>
              @else
              <option value="{{$item->id}}">{{$item->activities_title}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
       
        <div class="form-group row">
          <label for="debit" class="col-sm-2 col-form-label">Debit</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="debit" id="debit" value="{{$data->debit}}" placeholder="Debit">
          </div>
        </div>
        <div class="form-group row">
          <label for="credit" class="col-sm-2 col-form-label">Credit</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="credit" id="credit" value="{{$data->credit}}" placeholder="Credit">
          </div>
        </div>
        
        <div class="form-group row">
          <label for="fiscal_year" class="col-sm-2 col-form-label"> Fiscal Year</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" name="fiscal_year" id="fiscal_year" value="{{$data->fiscal_year}}" placeholder="Fiscal Year">
          </div>
        </div>
      </div>
      <!-- <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                      </div>
                    </div>
                  </div>
                </div> -->
      <!-- /.card-body -->
     
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>



@endsection