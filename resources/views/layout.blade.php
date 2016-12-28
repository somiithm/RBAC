<!DOCTYPE html>
<html>
<head>
    <title>RBAC-demo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js" ></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <p class="navbar-brand">Locus.sh Interview</p>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                @if($user)
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                       {{$user->name}}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/logout" >logout</a></li>
                </ul>

                @else
                    <a href="/loginPage"  role="button" aria-haspopup="true" aria-expanded="false">
                        Login
                    </a>
                @endif

            </li>
        </ul>
    </div>
</nav>

@yield('page-content')

</body>
</html>