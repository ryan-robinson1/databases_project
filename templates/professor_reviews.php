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

  <!-- Page content -->
  <div class="container mt-3">
    <div class="row">
      <div class="col-sm-12">
        <h1><?= $name ?>: <?= $subtitle ?></h1>
        <i><?= $description ?></i>
        <hr>
        <b>Department:</b> <?= $department ?> <br>
        <b>Credits: </b> <?= $credits ?> <br>
        <b>Taught By:</b> <?= $professor ?> <br>
        <b>Professor Email:</b> <?= $email ?> <br>
        <?php if (isset($requirement)) : ?>
          <b>Prerequisite: </b><?= $requirement ?>
        <?php endif; ?>
        <hr>
        <form action="?command=add_review" method="post">
          <input type="hidden" name="classid" value='<?= $_classID ?>'>
          <button type="submit" class="btn btn-success mt-3" style="margin-bottom:10px">+Add Review</button>
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
                        <p class="card-text">Difficulty: <small class="text-muted"><?= $difficulty[$i] ?></small></p>
                        <p class="card-text">Hours Outside: <small class="text-muted"><?= $hoursOutside[$i] ?></small></p>
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