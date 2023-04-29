<!DOCTYPE html>
<html lang="en">

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

  <div class="container mt-3">
    <div class="row">
      <div class="col-sm-12">
        <h1><?= $professor ?> </h1>
        <i><?= $email ?></i>
        <hr>
        <?php if ($has_review) : ?>
          <b>Rating:</b> <?= $avg_rating ?>/5.0<br>
          <b>Leniency: </b> <?= $avg_len ?>/5.0 <br>
        <?php endif; ?>

        <b>Classes Taught: </b> <?= $comma_separated_classes ?>
        <hr>
        <form action="?command=add_prof_review" method="post">
          <input type="hidden" name="profid" value='<?= $_profID ?>'>
          <?php if (isset($_SESSION["loggedin_username"])) : ?>
            <button type="submit" class="btn btn-success mt-3" style="margin-bottom:10px">+Add Review</button>
          <?php else : ?>
            <button type="submit" class="btn btn-success mt-3" style="margin-bottom:10px" disabled>+Add Review</button>
          <?php endif; ?>
        </form>

        <?php
        if (count($rating) > 0) {
          for ($i = 0; $i < count($rating); $i++) {
        ?>
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <h5 class="card-title"><?= $reviewTerm[$i] ?></h5>
                    <p class="card-text" style="font-size: 1.1rem;"><?= $reviewDescription[$i] ?></p>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <p class="card-text">Leniency: <small class="text-muted"><?= $leniency[$i] ?></small></p>
                        <p class="card-text">Rating: <small class="text-muted"><?= $rating[$i] ?></small></p>
                        <p class="card-text">Review Date: <small class="text-muted"><?= $reviewDate[$i] ?></small></p>
                      </div>
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
              <h5 class="card-title">No Reviews</h5>
              <p class="card-text">You can help us by writing a review!</p>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>