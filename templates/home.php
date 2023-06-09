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
        <a class="navbar-brand" href="#" onclick="window.location = window.location.href + '?command=home'; return false;"><strong>Hoo's Reviews</strong></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION["loggedin_username"])) {
                    ?>
                        <form action="?command=my_reviews" method="post">
                            <button class="btn" type="submit" id="userBtn">My Reviews</button>
                        </form>
                    <?php
                    } else {
                    ?>
                        <form action="?command=log_in" method="post">
                            <button class="btn" type="submit" id="userBtn">Log In</button>
                        </form>
                    <?php
                    }
                    ?>

                </li>
            </ul>
        </div>
    </nav>

    <!-- Main content area -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="?command=search_results" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="search_bar" name="search_bar">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>