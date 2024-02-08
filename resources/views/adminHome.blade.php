@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card text-center mb-3">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('adminHome')}}">statistics</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('adminHome.users') }}">Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('adminHome.reports') }}">Reports</a>
                </li>
              </ul>
            </div>
            <div class="card-body">

              

  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
  <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
  <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  

  <div class="grey-bg container-fluid">
    <section id="minimal-statistics">
      
     
    
      <div class="row">
      <br>
       
      </div>
    
      <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-left">
                    <h3 class="primary">{{$data['publicationsCount']}}</h3>
                    <span>New Posts</span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-book-open primary font-large-2 float-right"></i>
                  </div>
                </div>
                <div class="progress mt-1 mb-0" style="height: 7px;">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-left">
                    <h3 class="warning">{{$data['commentsCount']}}</h3>
                    <span>New Comments</span>
                  </div>
                  <div class="align-self-center">
                    <i class="icon-bubbles warning font-large-2 float-right"></i>
                  </div>
                </div>
                <div class="progress mt-1 mb-0" style="height: 7px;">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
    
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-left">
                    <h3 class="success">{{$data['likesCount']}}</h3>
                    <span>New likes</span>
                  </div>
                  <div class="align-self-center">
                    <i class="fa fa-heart-o success" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="progress mt-1 mb-0" style="height: 7px;">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="media d-flex">
                  <div class="media-body text-left">
                    <h3 class="danger">{{$data['users']->count()}}</h3>
                    <span>Users</span>
                  </div>
                  <div class="align-self-center">
                    <i class="fa fa-user-o danger" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="progress mt-1 mb-0" style="height: 7px;">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section id="stats-subtitle">
    <div class="row">
      <br>
      <br>
    </div>
  
    <div class="row">
      <div class="col-xl-6 col-md-12">
        <div class="card overflow-hidden">
          <div class="card-content">
            <div class="card-body cleartfix">
              <div class="media align-items-stretch">
                <div class="align-self-center">
                  <i class="icon-pencil primary font-large-2 mr-2"></i>
                </div>
                <div class="media-body">
                  <h4>Total Posts</h4>
                  <span>Monthly blog posts</span>
                </div>
                <div class="align-self-center">
                  <h1>{{$data['publicationsTotal']}}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="col-xl-6 col-md-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body cleartfix">
              <div class="media align-items-stretch">
                <div class="align-self-center">
                  <i class="icon-speech warning font-large-2 mr-2"></i>
                </div>
                <div class="media-body">
                  <h4>Total Comments</h4>
                  <span>Monthly blog comments</span>
                </div>
                <div class="align-self-center"> 
                  <h1>{{$data['commentsTotal']}}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="row">
      <br>
    </div>
  </section>
  </div>
<br>
             
              <!--Div that will hold the pie chart-->
              <div id="piechart" style="width: 400px; height: 350px;"></div>
            </div>
          </div>
    </div>
</div>
<!--charts-->
        
        <!-- Load the AJAX API -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
   
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['comments',  {{$data['commentsTotal']}}],
          ['reports',    {{$data['reportsTotal']}}],
          ['posts',   {{$data['publicationsTotal']}}],
          ['Likes',   {{$data['likesTotal']}}],

        ]);

        var options = {
          title: 'Users Interactions'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
 

@endsection
