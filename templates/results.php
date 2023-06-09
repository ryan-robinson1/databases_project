<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoo's Reviews</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .light-grey-border {
            border: 5px solid #A9A9A9;
        }

        .list-group-item {
            margin-top: 10px;
            margin-bottom: 10px;
            border: 3px solid #D3D3D3 !important;
        }
    </style>
</head>

<body>

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
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">


                <h5 class="card-title text-left">Results for: "<?= strtoupper($_search) ?>"</h5>
                <div class="card light-grey-border">
                    <div class="card-body">
                        <div class="list-group">
                            <?php
                            for ($i = 0; $i < count($name); $i++) {
                            ?>
                                <form action="?command=class_reviews" method="post">
                                    <input type="hidden" name="classid" value='<?= $classID[$i] ?>'>
                                    <button type="submit" class="list-group-item list-group-item-action">
                                        <b><?= $name[$i] ?></b> - <?= $subtitle[$i] ?> <br>
                                        <i>Prof. <?= $professor[$i] ?></i>
                                    </button>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </main>
    <!-- Add Bootstrap and jQuery JavaScript -->
    <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>