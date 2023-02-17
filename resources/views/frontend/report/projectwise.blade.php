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
            <h3 class="card-title"> Project Wise </h3>

        </div>

        <!-- /.card-header -->
        <div class="card-body">

            <table class="table">
                <thead>
                    <tr>

                        <th>S.N.</th>

                        <th>Project Name</th>


                    </tr>
                </thead>
                <tbody>
                    </thead>
                <tbody>

                    @foreach($data as $project)
                    <tr>

                        <td>{{ $project ->id }}</td>
                        <td > <a style="color:black;" href="{{url('/singleprojectdetails/' .$project->id.'/'.$project->project_name )}}">{{ $project ->project_name }}</td>


                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

</div>




@endsection