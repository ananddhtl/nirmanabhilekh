@extends('welcome')

@section('content')



<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="/activities/add">Add</a></li>

          <li class="breadcrumb-item active"><a href="/activities/list">List</a></li>

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
      <h3 class="card-title">Update Activity</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <form action="{{route('updateActivities', $data->id)}}" method="POST">
      @csrf
      <div class="card-body">


        <div class="form-group row">
          <label for="activites_title" class="col-sm-2 col-form-label"> Title</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="activities_title" value="{{$data->activities_title}}" id="activities_title" placeholder="Activities Title">
          </div>
        </div>
        <div class="form-group row">
          <label for="activites_subtitle" class="col-sm-2 col-form-label"> Sub Title </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="activities_subtitle" value="{{$data->activities_subtitle}}" id="activities_subtitle" placeholder="Activities SubTitle Title">
          </div>
        </div>
        <div class="form-group row">
          <label for="activity_catagories_id" class="col-sm-2 col-form-label">Catagory</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" name="activities_cat_ID" data-dropdown-css-class="select2-danger" style="width: 100%;">


              @foreach($activitiescatagories as $item)
              @if($data->activities_cat_ID==$item->id)
              <option value="{{$item->id}}" selected>{{$item->activity_catagories_name}}</option>
              @else
              <option value="{{$item->id}}">{{$item->activity_catagories_name}}</option>
              @endif

              @endforeach
            </select>
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
      <div class="card-footer">
        <input type="submit" value="Update " class="btn btn-info"></button>

      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

</div>



@endsection