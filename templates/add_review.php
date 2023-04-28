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

    <style>
        .thin-card {
            display: inline-block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .rating {
            display: inline-flex;
            direction: rtl;
        }

        .rating input[type="radio"] {
            display: none;
        }

        .rating label {
            display: inline;
            font-size: 24px;
            padding: 0 2px;
            cursor: pointer;
        }

        .rating label:hover,
        .rating label:hover~label,
        .rating input[type="radio"]:checked~label {
            color: #ffca2e;
        }
    </style>
</head>

<body>

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
        <h2 class="my-4">Write a review for <?= $class_name ?>:</h2>
        <div class="card p-4">
            <form action="?command=submit_class_review" method="post">
                <div class="form-group mt-3">
                    <input type="hidden" name="class_id" value="<?= $_classID ?>">
                    <label for="rating">Professor:</label>
                    <div class="thin-card">
                        <input type="hidden" name="professor" value="<?= htmlspecialchars($prof_name) ?>">
                        <?= htmlspecialchars($prof_name) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <select class="form-control" id="semester" name="semester">
                        <option>Spring 2023</option>
                        <option>Fall 2022</option>
                        <option>Spring 2022</option>
                        <option>Fall 2021</option>
                        <option>Spring 2021</option>
                        <!-- Add more semesters as needed -->
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="rating">Rating:</label>
                    <div class="rating">
                        <?php for ($i = 5; $i >= 1; $i--) : ?>
                            <input type="radio" name="rating" id="rating-<?= $i ?>" value="<?= $i ?>">
                            <label for="rating-<?= $i ?>">&#9733;</label>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="difficulty">Difficulty:</label>
                    <div class="rating">
                        <?php for ($i = 5; $i >= 1; $i--) : ?>
                            <input type="radio" name="difficulty" id="difficulty-<?= $i ?>" value="<?= $i ?>">
                            <label for="difficulty-<?= $i ?>">&#9733;</label>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="hours">Hours Outside of Class per Week:</label>
                    <select class="form-control" id="hours" name="hours">
                        <option>
                            <1 </option>
                        <option>1-3</option>
                        <option>3-5</option>
                        <option>5-7</option>
                        <option>7-10</option>
                        <option>10+</option>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="review">Review:</label>
                    <textarea class="form-control" name="review" id="review" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3">Submit</button>
            </form>


        </div>
    </div>

</body>

</html>