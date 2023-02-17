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
  </div>
</section>
<div class="col-md-6">



 
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Add Items </h3>
    </div>
 
    @if($errors->any())
    <div class="m-2 p-2">
      <ul>
        @foreach ($errors->all() as $error)
        <div class="form-control form-control is-invalid">{{$error}}</div>
        @endforeach
      </ul>
    </div>
    @endif
    <form action="{{route('postActivitiesData')}}" method="POST">
      @csrf
      <div class="card-body">


        <div class="form-group row">
          <label for="activites_title" class="col-sm-3 col-form-label">Title</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="activities_title" autocomplete="off"id="activities_title" placeholder="Enter  Title" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="activites_subtitle" class="col-sm-3 col-form-label"> SubTitle </label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="activities_subtitle" autocomplete="off" id="activities_subtitle" placeholder="Enter SubTitle " required>
          </div>
        </div>
        <div class="form-group row">
          <label for="Unit" class="col-sm-3 col-form-label">Unit </label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="unit" autocomplete="off" id="unit" placeholder="Enter Unit" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="activity_catagories_id" class="col-sm-3 col-form-label">Catagory </label>
          <div class="col-sm-9">
            <select class="form-control select2 select2-danger" name="activities_cat_ID"  data-dropdown-css-class="select2-danger" style="width: 100%;" required>
              @foreach($activitiescatagories as $item)
              <option value="{{$item->id}}">{{$item->activity_catagories_name}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      


      
      <div class="card-footer">
        <input type="submit" value="Save " class="btn btn-info float-sm-left"></button>

      </div>
      
    </form>
  </div>
  

 </div>



 @endsection

