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
    <?php
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']); // So the message doesn't persist on page refresh
    }
    ?>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><strong>Hoo's Reviews</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center">Sign In</h2>
                        <form action="?command=log_in_potential_user" method="post">
                            <div class="form-group">
                                <label for="computingID">Computing ID:</label>
                                <input type="text" class="form-control" id="computingID" name="computingID" required />
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" name="pwd" required />
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Log In</button>
                        </form>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    No account?
                    <form action="?command=sign_up" method="post">
                        <button class="btn" type="submit">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- php include('header.html') ?> -->

    </div>
</body>

</html>