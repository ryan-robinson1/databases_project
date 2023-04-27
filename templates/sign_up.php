<!DOCTYPE html>
<html>

<head>
    <title>Hoo's Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><strong>Hoo's Reviews</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Sign In</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2 class="my-4">Sign Up</h2>

        <form action="?command=sign_up" method="post">
            <button class="btn" type="submit">Insert</button>
        </form>
        <div class="card p-2">
            <form action="?command=sign_up" method="post">
                <div class="form-group">
                    Name: <input type="text" name="name" required /> <br />
                </div>
                <div class="form-group">
                    Computing ID: <input type="text" name="computingID" required /> <br />
                </div>
                <div class="form-group">
                    Email: <input type="text" name="email" required /> <br />
                </div>
                <div class="form-group">
                    Password: <input type="password" name="pwd" required /> <br />
                </div>
                <input type="submit" name="actionBtn" value="Submit" class="btn btn-success mt-3" />
            </form>
        </div>
    </div>
    <!-- php include('header.html') ?> -->
    </div>
</body>

</html>