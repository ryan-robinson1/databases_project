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
    <script type="text/javascript">
        $(document).ready(function() {

            // RegEx patterns
            var lowerCaseRegEx = /[a-z]/;
            var upperCaseRegEx = /[A-Z]/;
            var numericRegEx = /[0-9]/;
            var emailRegEx = /^[\w-]+(\.[\w-]+)*@virginia\.edu$/;
            var abnormalCharRegEx = /[^a-zA-Z0-9@.]/;

            $("#pwd, #email, #computingID").on("keyup", function() {
                // Remove previous error messages
                $(".error").remove();

                var pwd = $("#pwd").val();
                var email = $("#email").val();
                var computingID = $("#computingID").val();

                // Check password strength
                if (pwd.length < 6 || !lowerCaseRegEx.test(pwd) || !upperCaseRegEx.test(pwd) || !numericRegEx.test(pwd)) {
                    $("#pwd").addClass("is-invalid").after("<div class='error text-danger'>Password must be at least 6 characters long and include an uppercase letter, a lowercase letter, and a number.</div>");
                } else {
                    $("#pwd").removeClass("is-invalid");
                }

                // Check email validity
                if (!emailRegEx.test(email)) {
                    $("#email").addClass("is-invalid").after("<div class='error text-danger'>Please enter a valid @virginia.edu email address.</div>");
                } else {
                    $("#email").removeClass("is-invalid");
                }

                // Check computing ID length
                if (computingID.length < 5) {
                    $("#computingID").addClass("is-invalid").after("<div class='error text-danger'>Your Computing ID is too short. Please use at least 5 characters.</div>");
                } else {
                    $("#computingID").removeClass("is-invalid");
                }

                // Check for abnormal characters
                if (abnormalCharRegEx.test(pwd) || abnormalCharRegEx.test(email) || abnormalCharRegEx.test(computingID)) {
                    $(this).addClass("is-invalid").after("<div class='error text-danger'>Please don't use weird or abnormal characters.</div>");
                } else {
                    $(this).removeClass("is-invalid");
                }
            });

            $("form").submit(function(e) {
                // Prevent form submission if there are any errors
                if ($(".is-invalid").length) {
                    e.preventDefault();
                }
            });
        });
    </script>



    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><strong>Hoo's Reviews</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center">Sign Up</h2>
                        <form action="?command=sign_up_potential_user" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required />
                            </div>
                            <div class="form-group">
                                <label for="computingID">Computing ID:</label>
                                <input type="text" class="form-control" id="computingID" name="computingID" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required />
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" name="pwd" required />
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>