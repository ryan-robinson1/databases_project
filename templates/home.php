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
                    <form action="?command=log_in" method="post"> <!-- not sure if this would need to be change based on whats below-->
                        <button class="btn" type="submit" id="userBtn">Log In</button>
                        <script>
                            const userid = sessionStorage.getItem("loggedin_username");
                            if (userid) {
                                const userButton = document.querySelector('#userBtn');
                                userButton.textContent = userid;

                                userButton.addEventListener('click', () => {
                                    window.location.href = '/userReviews/' + userid; // REPLACE WITH ACTUAL USER SPECIFIC URL
                                });
                            }
                        </script>
                    </form>
                </li>
                <li class="nav-item">
                    <form action="?command=sign_in" method="post">
                        <button class="btn" type="submit">Sign Up</button>
                    </form>
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