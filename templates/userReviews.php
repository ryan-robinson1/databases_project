<!DOCTYPE html>
<html>

<head>
    <title>Hoo's Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- <button type="button" style="width:10%" class="btn btn-dark btn-sm">Edit</button>
        <button type="button" style="width:10%" class="btn btn-dark btn-sm">Delete</button> -->
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
                    <form action="?command=log_out" method="post"> <!-- not sure if this would need to be change based on whats below-->
                        <button class="btn" type="submit" id="userBtn">Log Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Main content area -->
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-12">
                <h1>My Reviews</h1>
                <hr>
                <!-- Navigation tabs -->
                <ul class="nav nav-tabs" id="reviewTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="class-reviews-tab" data-toggle="tab" href="#classReviews" role="tab" aria-controls="classReviews" aria-selected="true">Class Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="professor-reviews-tab" data-toggle="tab" href="#professorReviews" role="tab" aria-controls="professorReviews" aria-selected="false">Professor Reviews</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Class Reviews Tab -->
                    <div class="tab-pane fade show active" id="classReviews" role="tabpanel" aria-labelledby="class-reviews-tab">
                        <!-- Class Review Container -->
                        <?php
                        if (count($class_rating) > 0) {
                            for ($i = 0; $i < count($class_rating); $i++) {
                        ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div style="margin-bottom: 10px;">
                                                    <h5 class="card-title" style="margin-bottom: 0px;"><?= $class_name[$i] ?></h5>
                                                    <h7 class="card-subtitle text-muted" style="font-size: 0.9rem;"><?= $class_reviewTerm[$i] ?></h7>
                                                </div>
                                                <p class="card-text" style="font-size: 1.1rem; padding-top: 15px;"><?= $class_reviewDescription[$i] ?></p>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p class="card-text">Difficulty: <small class="text-muted"><?= $class_difficulty[$i] ?></small></p>
                                                        <p class="card-text">Hours Outside: <small class="text-muted"><?= $class_hoursOutside[$i] ?></small></p>
                                                        <p class="card-text">Rating: <small class="text-muted"><?= $class_rating[$i] ?></small></p>
                                                        <p class="card-text">Review Date: <small class="text-muted"><?= $class_reviewDate[$i] ?></small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 text-end">
                                                <div class="d-flex">
                                                    <form action="?command=edit_class_review" method="post" class="me-2">
                                                        <input type="hidden" name="reviewID" value="<?= $class_reviewID ?>">
                                                        <button class="btn btn-dark" style="margin-right:5px">Edit</button>
                                                    </form>
                                                    <form action="?command=delete_class_review" method="post">
                                                        <input type="hidden" name="reviewID" value="<?= $class_reviewID ?>">
                                                        <button class="btn btn-dark">Delete</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">No Class Reviews</h5>
                                    <p class="card-text">You can help us by writing reviews!</p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- Professor Reviews Tab -->
                    <div class="tab-pane fade" id="professorReviews" role="tabpanel" aria-labelledby="professor-reviews-tab">
                        <!-- Professor Review Container -->
                        <?php
                        if (count($prof_rating) > 0) {
                            for ($i = 0; $i < count($prof_rating); $i++) {
                        ?>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div style="margin-bottom: 10px;">
                                                    <h5 class="card-title" style="margin-bottom: 0px;"><?= $prof_name[$i] ?></h5>
                                                    <h7 class="card-subtitle text-muted" style="font-size: 0.9rem;"><?= $prof_reviewTerm[$i] ?></h7>
                                                </div>
                                                <p class="card-text" style="font-size: 1.1rem; padding-top: 15px;"><?= $prof_reviewDescription[$i] ?></p>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p class="card-text">Leniency: <small class="text-muted"><?= $prof_leniency[$i] ?></small></p>
                                                        <p class="card-text">Rating: <small class="text-muted"><?= $prof_rating[$i] ?></small></p>
                                                        <p class="card-text">Review Date: <small class="text-muted"><?= $prof_reviewDate[$i] ?></small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 text-end">
                                                <div class="d-flex">
                                                    <form action="?command=edit_prof_review" method="post" class="me-2">
                                                        <input type="hidden" name="reviewID" value="<?= $prof_reviewID ?>">
                                                        <button class="btn btn-dark" style="margin-right:5px">Edit</button>
                                                    </form>
                                                    <form action="?command=delete_prof_review" method="post">
                                                        <input type="hidden" name="reviewID" value="<?= $prof_reviewID ?>">
                                                        <button class="btn btn-dark">Delete</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                        } else {
                            ?>
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">No Professor Reviews</h5>
                                    <p class="card-text">You can help us by writing reviews!</p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>