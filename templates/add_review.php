<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoo's Reviews</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

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
        <h2 class="my-4">Write a review for CS 4750:</h2>
        <div class="card p-4">
            <form>
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <select class="form-control" id="semester">
                        <option>Spring 2022</option>
                        <option>Fall 2022</option>
                        <!-- Add more semesters as needed -->
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="professor">Professor:</label>
                    <select class="form-control" id="professor">
                        <option>Professor 1</option>
                        <option>Professor 2</option>
                        <!-- Add more professors as needed -->
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="rating">Rating (out of 5):</label>
                    <select class="form-control" id="rating">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="review">Review:</label>
                    <textarea class="form-control" id="review" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>
        </div>
    </div>

</body>

</html>