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
                  <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.reports') }}">Reports</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <!--Div that will hold the pie chart-->
              <div class="card"><div id="chart_div"></div></div>
            </div>
          </div>
    </div>
</div>

@endsection
