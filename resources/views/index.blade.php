
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>24 Seconds</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('/css/styles.css') }}" rel="stylesheet" type="text/css" >
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#"><img src="{{ URL::asset('/images/24_seconds.png') }}" id="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">

      {{-- {!! $MyNavBar->asUl(['class' => 'navbar-nav mr-auto']) !!} --}}
      <ul class="navbar-nav mr-auto">
      @include(config('laravel-menu.views.bootstrap-items'), ['items' => $NavBar->roots()])
      </ul>

        {{-- <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Teams</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Standings</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Games
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#">Round 1</a>
                <ul class="dropdown-menu">
                  <a class="dropdown-item" href="#">Buducnost - Partizan</a>
                  <a class="dropdown-item" href="#">Zadar - Mornar</a>
                </ul>
              </li>
              <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#">Round 2</a>
                <ul class="dropdown-menu">
                  <a class="dropdown-item" href="#">Buducnost - Partizan</a>
                  <a class="dropdown-item" href="#">Zadar - Mornar</a>
                </ul>
              </li>
              <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#">Round 3</a>
                <ul class="dropdown-menu">
                  <a class="dropdown-item" href="#">Buducnost - Partizan</a>
                  <a class="dropdown-item" href="#">Zadar - Mornar</a>
                </ul>
              </li>
            </ul>
          </li>
        </ul> --}}

        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0 search-button" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <main role="main" class="container-fluid" style="max-width: 1450px">

      <div class="row">
        <div class="col-md-2 border border-right-0">
          @include ('layouts.aside')
        </div>

        <div class="col-md-10 border">
          @yield ('content')
        </div>    

      </div>

    </main><!-- /.container -->

    <footer class="blog-footer">
      <p>Copyright © 2018, <a href="mailto:vasicd80@gmail.com" target="_top">Darko Vasić</a></p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">

      
  
      $(document).ready(function() {
        $(document).on('change', '#team_id', function() {
          // console.log("It's changed");

          var team_id = $(this).val();
          var div = $(this).parent().parent();
          var opt = "";
          // console.log(team_id);
          console.log(div);

          $.ajax({
            type: 'get',
            url: '{!! URL::to('findPlayerName') !!}',
            data: {'id': team_id},
            success: function(data) {
              console.log("data retreived");
              console.log(data);
              // console.log(data.length);
              opt += '<option value="0" disabled="true" selected="true">-Select Player-</option>';
              for (var i=0; i<data.length; i++) {
                opt += '<option value="'+data[i].player_id+'">'+data[i].first_name+' '+data[i].last_name+'</option>';
              }
              console.log(opt);
              div.find('#player_id').html("");
              div.find('#player_id').append(opt);
            },
            error: function() {

            }
          });
        });
      });

    </script>

  </body>
</html>
