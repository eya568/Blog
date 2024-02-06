<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf8mb4">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

    @vite(['resources/sass/app.scss','resources/js/app.js'])

    <!--jquery-->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- Modal -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote CSS LINK -->

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
    <!-- icons -->
    
    <link href="https://bootswatch.com/5/zephyr/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
        <!--icons fa fa awesome-->
    
        <script src="https://kit.fontawesome.com/3b0ad92508.js" crossorigin="anonymous"></script>
    
        <!--charts-->
    
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
        
            function drawChart() {
                $(document).ready(function() {
                    $.ajax({
                        url: "{{ route('admin.chartData') }}", 
                        method: "GET",
                        success: function(response) {
                            var commentsCount = response.commentsCount;
                            var likesCount = response.likesCount;
                            var postsCount = response.postsCount;
                            var reportCount = response.reportsCount;
        
                            // Create the data table.
                            var data = new google.visualization.DataTable();
                            data.addColumn('string', 'Topping');
                            data.addColumn('number', 'Slices');
                            data.addRows([
                                ['Likes', likesCount],
                                ['Reports', reportCount],
                                ['Posts', postsCount],
                                ['Comments', commentsCount]
                            ]);
        
                            // Set chart options
                            var options = {
                                'title': 'User Interaction with the Blog',
                                'width': 400,
                                'height': 300
                            };
        
                            // Instantiate and draw the chart
                            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                            chart.draw(data, options);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            }
        </script>
        
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="h-25 w-25" src="{{ asset('images\icon.png') }}"  alt="img">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @if(Auth::user()->role =='admin')
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('adminHome')}}">dashboard</a>
                            </li>
                        </ul>
                            @else
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home')}}">profile</a>
                            </li>
                        </ul>
                        @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<!--summernote-->
<script>
    $(document).ready(function() {
        $("#summernote").summernote({
            height: 150,
        });
        $('.dropdown-toggle').dropdown();
    });
</script>
<!--refresh issue-->

<script>
   /*
* Maintain / Keep scroll position after post-back / postback / refresh. Just include plugin (no need for cookies)
*
* Author: Evalds Urtans
* Website: http://www.evalds.lv
*/
(function($){
window.onbeforeunload = function(e){    
window.name += ' [' + $(window).scrollTop().toString() + '[' + $(window).scrollLeft().toString();
};
$.maintainscroll = function() {
if(window.name.indexOf('[') > 0)
{
var parts = window.name.split('['); 
window.name = $.trim(parts[0]);
window.scrollTo(parseInt(parts[parts.length - 1]), parseInt(parts[parts.length - 2]));
}   
};  
$.maintainscroll();
})(jQuery);
</script>
<script>
    $('#modal').on('show.bs.modal', function () {
       $(this).find('.modal-body').css({
              width:'auto', //probably not needed
              height:'auto', //probably not needed 
              'max-height':'100%'
       });
});
</script>
<script>
    
</script>
</body>
</html>
