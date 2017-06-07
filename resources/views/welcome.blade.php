<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SenderReceiver Application</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<!-- The #page-top ID is part of the scrolling feature - the data-spy and data-target are part of the built-in Bootstrap scrollspy function -->

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">Sender Receiver</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#history">History</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Section -->
    <section id="intro" class="intro-section">
        <div class="container">



            <div class="row col-sm-offset-2">



                @if (count($errors) > 0)
                <div class="alert alert-danger col-sm-10">
                    <strong>Whoops!</strong> Following errors were encountered<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li >{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.content') !!}
                    </div>
                @endif


                <form class="form-horizontal col-sm-10" method="POST" action="/save" enctype="multipart/form-data">

                    
                
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Username">Username:</label>
                    <div class="col-sm-10">
                      <input type="text" name="username" class="form-control" id="Username" placeholder="Enter Username" value="{{old('username')}}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Password:</label>
                    <div class="col-sm-10"> 
                      <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="file">File:</label>
                    <div class="col-sm-10"> 
                      <input type="file" class="form-control" id="file" name="file" placeholder="Select a zip file">
                    </div>
                  </div>
                  <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Send</button>
                      <a href="#history" class="btn btn-default page-scroll">See History</a>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="history" class="about-section">
        <div class="container">

            <div class="row">
            <h1>History(Recent 10)</h1>
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Username</th>
                  <th>File</th>
                  <th>Time</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($files))
                @foreach($files as $file)
                <tr>
                  <td><pre>{{array_get($file,'username','')}}</pre></td>
                  <td><pre>{{array_get($file,'file','')}}</pre></td>
                  <td><pre>{{array_get($file,'created_at','')}}</pre></td>
                </tr>
                @endforeach
                @endif
                </tbody>
              </table>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

</body>

</html>
