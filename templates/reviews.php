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
        <h1>All Reviews for CS 4750</h1>
        <hr>
        <button type="submit" class="btn btn-success mt-3" style="margin-bottom:10px">+Add Review</button>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Class/Professor Name</h5>
            <p class="card-text">Review content goes here.</p>
            <p class="card-text">Submitted by: <a href="#">Username</a></p>
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Class/Professor Name</h5>
            <p class="card-text">Review content goes here.</p>
            <p class="card-text">Submitted by: <a href="#">Username</a></p>
          </div>
        </div>
        <!-- more reviews go here -->
      </div>
    </div>
  </div>



</body>

</html>