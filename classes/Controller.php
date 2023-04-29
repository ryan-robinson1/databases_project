<?php
class Controller
{

    private $command;
    private $conn;
    public function __construct($command)
    {
        $this->command = $command;
        $servername = "localhost";
        $username = "student";
        $password = "";
        //Name of database in phpmyadmin
        $dbname = "cs4750project";

        // Create connection
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function run()
    {
        switch ($this->command) {
            case "home":
                $this->home();
                break;
            case "search_results":
                $this->search_results();
                break;
            case "submit_class_review":
                $this->submit_class_review();
                break;
            case "class_reviews":
                $this->class_reviews();
                break;
            case "log_in":
                $this->log_in();
                break;
            case "log_out":
                $this->log_out();
                break;
            case "sign_up":
                $this->sign_up();
                break;
            case "my_reviews":
                $this->my_reviews();
                break;
            case "log_in_potential_user":
                $this->log_in_potential_user();
                break;
            case "sign_up_potential_user":
                $this->sign_up_potential_user();
                break;
            case "add_review":
                $this->add_review();
                break;
            case "prof_reviews":
                $this->prof_reviews();
                break;
            case "add_prof_review":
                $this->add_prof_review();
                break;
            case "submit_prof_review":
                $this->submit_prof_review();
                break;
            case "edit_prof_review":
                $this->edit_prof_review();
                break;
            case "submit_edited_prof_review":
                $this->submit_edited_prof_review();
                break;
            case "edit_class_review":
                $this->edit_class_review();
                break;
            case "submit_edited_class_review":
                $this->submit_edited_class_review();
                break;
            case "delete_class_review":
                $this->delete_class_review();
                break;
            case "delete_prof_review":
                $this->delete_class_review();
                break;
            default:
                $this->home();
                break;
        }
    }
    public function edit_class_review()
    {
        $reviewID = $_POST['reviewID'];
        $sql = "SELECT name, classID FROM classidentity NATURAL JOIN classreview WHERE reviewID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 'i', $reviewID);

        $class_name = $arr[0]['name'];
        $_classID = $arr[0]['classID'];

        $sql = "SELECT reviewdescription, rating, difficulty, hoursOutside FROM review NATURAL JOIN classreview WHERE reviewID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $reviewID);
        $review_description = $arr[0]['reviewdescription'];
        $rating = $arr[0]['rating'];
        $difficulty = $arr[0]['difficulty'];
        $hours = $arr[0]['hoursOutside'];

        $sql = "SELECT prof_name FROM taughtby NATURAL JOIN professor WHERE classID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_classID);
        $prof_name = $arr[0]['prof_name'];

        include "templates/edit_class_review.php";
    }
    public function submit_edited_class_review()
    {
        $professor = $_POST['professor'];
        $semester = $_POST['semester'];
        $rating = $_POST['rating'];
        $difficulty = $_POST['difficulty'];
        $hours = $_POST['hours'];
        $review = $_POST['review'];
        $class_id = $_POST['class_id'];
        $review_id = $_POST['review_id'];

        $sql = "UPDATE review SET rating = ?, reviewDescription = ?, reviewTerm = ? WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'issi', $rating, $review, $semester, $review_id);

        $sql = "UPDATE classreview SET difficulty = ?, hoursOutside = ?, classID = ? WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'iiii', $difficulty, $hours, $class_id, $review_id);

        $sql = "UPDATE writtenbyuser SET computingID = ? WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'si', $_SESSION["loggedin_username"], $review_id);



        $this->my_reviews();
    }
    public function delete_class_review()
    {
        $review_id = $_POST['reviewID'];
        $sql = "DELETE FROM review WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'i', $review_id);

        $sql = "DELETE FROM classreview WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'i', $review_id);

        $sql = "DELETE FROM writtenbyuser WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'i', $review_id);

        $this->my_reviews();
    }
    public function edit_prof_review()
    {

        $reviewID = $_POST['reviewID'];
        $sql = "SELECT prof_name, profID FROM professor NATURAL JOIN professorreview WHERE reviewID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 'i', $reviewID);

        $prof_name = $arr[0]['prof_name'];
        $profID = $arr[0]['profID'];

        $sql = "SELECT reviewdescription, rating, leniency FROM review NATURAL JOIN professorreview WHERE reviewID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $reviewID);
        $review_description = $arr[0]['reviewdescription'];
        $rating = $arr[0]['rating'];
        $leniency = $arr[0]['leniency'];


        include "templates/edit_prof_review.php";
    }
    public function submit_edited_prof_review()
    {
        $semester = $_POST['semester'];
        $rating = $_POST['rating'];
        $leniency = $_POST['leniency'];
        $review = $_POST['review'];
        $prof_id = $_POST['prof_id'];
        $review_id = $_POST['review_id'];

        $sql = "UPDATE review SET rating = ?, reviewDescription = ?, reviewTerm = ? WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'issi', $rating, $review, $semester, $review_id);

        $sql = "UPDATE professorreview SET leniency = ?, profID = ? WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'isi', $leniency, $prof_id, $review_id);

        $sql = "UPDATE writtenbyuser SET computingID = ? WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'si', $_SESSION["loggedin_username"], $review_id);

        $this->my_reviews();
    }
    public function delete_prof_review()
    {
        $review_id = $_POST['reviewID'];
        $sql = "DELETE FROM review WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'i', $review_id);

        $sql = "DELETE FROM professorreview WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'i', $review_id);

        $sql = "DELETE FROM writtenbyuser WHERE reviewID = ?";
        $this->runSafeSQL($this->conn, $sql, 'i', $review_id);

        $this->my_reviews();
    }
    public function submit_class_review()
    {
        $professor = $_POST['professor'];
        $semester = $_POST['semester'];
        $rating = $_POST['rating'];
        $difficulty = $_POST['difficulty'];
        $hours = $_POST['hours'];
        $review = $_POST['review'];
        $class_id = $_POST['class_id'];


        $sql = "SELECT * FROM classreview NATURAL JOIN writtenbyuser WHERE computingID=? AND classID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 'si', $_SESSION["loggedin_username"],  $class_id);

        if (count($arr) > 0) {
            $_SESSION['error'] = "<div class='alert alert-danger'>Error: Can't review the same class twice! </div>";
            $this->home();
            exit();
        }

        $sql = "INSERT INTO review (rating, reviewDescription, reviewTerm) VALUES (?, ?, ?)";
        $review_id = $this->runSafeSQL($this->conn, $sql, 'iss', $rating, $review, $semester);

        $sql = "INSERT INTO classreview (reviewID, difficulty, hoursOutside, classID) VALUES (?, ?, ?, ?)";
        $this->runSafeSQL($this->conn, $sql, 'iiii', $review_id, $difficulty, $hours, $class_id);

        $sql = "INSERT INTO writtenbyuser (reviewID, computingID) VALUES (?, ?)";
        $this->runSafeSQL($this->conn, $sql, 'is', $review_id,  $_SESSION["loggedin_username"]);

        include "templates/home.php";
    }
    public function submit_prof_review()
    {
        $semester = $_POST['semester'];
        $rating = $_POST['rating'];
        $leniency = $_POST['leniency'];
        $review = $_POST['review'];
        $prof_id = $_POST['prof_id'];

        $sql = "SELECT * FROM professorreview NATURAL JOIN writtenbyuser WHERE computingID=? AND profID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 'ss', $_SESSION["loggedin_username"],  $prof_id);

        if (count($arr) > 0) {
            $_SESSION['error'] = "<div class='alert alert-danger'>Error: Can't review the same professor twice! </div>";
            $this->home();
            exit();
        }

        $sql = "INSERT INTO review (rating, reviewDescription, reviewTerm) VALUES (?, ?, ?)";
        $review_id = $this->runSafeSQL($this->conn, $sql, 'iss', $rating, $review, $semester);

        $sql = "INSERT INTO professorreview (reviewID, leniency, profID) VALUES (?, ?, ?)";
        $this->runSafeSQL($this->conn, $sql, 'iis', $review_id, $leniency, $prof_id);

        $sql = "INSERT INTO writtenbyuser (reviewID, computingID) VALUES (?, ?)";
        $this->runSafeSQL($this->conn, $sql, 'is', $review_id,  $_SESSION["loggedin_username"]);

        include "templates/home.php";
    }
    public function log_out()
    {
        unset($_SESSION["loggedin_username"]);
        include "templates/home.php";
    }
    public function log_in_potential_user()
    {
        $_logInID = $_POST['computingID'];
        $_logInPwd = htmlspecialchars($_POST['pwd']);

        $sql = "SELECT pwd FROM theuser WHERE computingID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_logInID);

        if (count($arr) > 0) {
            $usersPwd = $arr[0]['pwd'];
        } else {
            $_SESSION['error'] = "<div class='alert alert-danger'>There are no users with this username. Please try again or sign up!</div>";
            include "templates/log_in.php";
            exit();
        }
        if (password_verify($_logInPwd, $usersPwd)) {
            $_SESSION["loggedin_username"] = $_logInID;
            include "templates/home.php";
        } else {
            $_SESSION['error'] = "<div class='alert alert-danger'>Username and password do not match our record</div>";
            include "templates/log_in.php";
            exit();
        }
    }
    public function home()
    {
        include "templates/home.php";
    }
    public function log_in()
    {
        include "templates/log_in.php";
    }
    public function sign_up()
    {
        include "templates/sign_up.php";
    }
    public function sign_up_potential_user()
    {
        $_enteredID = $_POST['computingID'];
        $_enteredName = $_POST['name'];
        $_enteredEmail = $_POST['email'];
        $enteredPwd = $_POST['pwd'];

        $sql = "SELECT * FROM theuser WHERE computingID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_enteredID);

        $sql = "SELECT * FROM theuser WHERE email=?";
        $arr2 = $this->runSafeSQL($this->conn, $sql, 's',  $_enteredEmail);

        if (count($arr) > 0) {
            $_SESSION['error'] = "<div class='alert alert-danger'>This student ID has already been registered! </div>";
            include "templates/sign_up.php";
            exit();
        } else if (count($arr2) > 0) {
            $_SESSION['error'] = "<div class='alert alert-danger'>This email has already been registered! </div>";
            include "templates/sign_up.php";
            exit();
        } else {
            $_hashedPwd = password_hash($enteredPwd, PASSWORD_BCRYPT);
            $sql = "INSERT INTO theuser VALUES (?, ?, ?, ?)";
            $this->runSafeSQL($this->conn, $sql, 'ssss', $_enteredID, $_enteredName, $_enteredEmail, $_hashedPwd);
            $_SESSION["loggedin_username"] = $_enteredID;
            include "templates/home.php";
        }
    }
    public function add_prof_review()
    {

        $_profID = $_POST['profid'];
        $sql = "SELECT prof_name FROM professor WHERE profID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_profID);
        $prof_name = $arr[0]['prof_name'];


        include "templates/add_prof_review.php";
    }
    public function prof_reviews()
    {
        $_profID = $_POST['profid'];
        $sql = "SELECT email, prof_name FROM professor WHERE profID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_profID);

        $professor = $arr[0]['prof_name'];
        $email = $arr[0]['email'];

        $has_review = false;

        $sql = "SELECT AVG(rating) as avg_rating, AVG(leniency) as avg_len
        FROM review 
        NATURAL JOIN professorreview 
        WHERE profID=? 
        GROUP BY profID";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_profID);

        $avg_rating = 0;
        $avg_len = 0;
        if (count($arr) > 0) {
            $avg_rating = round($arr[0]['avg_rating'], 1);
            $avg_len = round($arr[0]['avg_len'], 1);
            $has_review = true;
        }


        $sql = "SELECT name FROM classidentity NATURAL JOIN taughtby NATURAL JOIN professor WHERE profID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_profID);
        $classes = [];

        foreach ($arr as $row) {
            $classes[] = $row['name'];
        }
        $comma_separated_classes = implode(", ", $classes);


        $sql = "SELECT * FROM professorreview  NATURAL JOIN review WHERE profID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_profID);
        $leniency = [];
        $rating = [];
        $reviewDescription = [];
        $reviewTerm = [];
        $reviewDate = [];

        foreach ($arr as $row) {
            $leniency[] = $row['leniency'];
            $rating[] = $row['rating'];
            $reviewDescription[] = $row['reviewDescription'];
            $reviewTerm[] = $row['reviewTerm'];
            $reviewDate[] = date("F d Y", strtotime($row['reviewDate']));
        }




        include "templates/professor_reviews.php";
    }
    public function search_results()
    {
        $search_query = '%' . $_POST["search_bar"] . '%';
        $_search = $_POST["search_bar"];

        //We create the statement with prepare and bind to prevent SQL injection
        $sql = "SELECT name, section, classID, department, description, subtitle, prof_name FROM classidentity NATURAL JOIN classtype NATURAL JOIN classdescription NATURAL JOIN taughtby NATURAL JOIN professor WHERE LOWER(name) LIKE LOWER(?) ORDER BY name";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $search_query);
        $name = [];
        $section = [];
        $classID = [];
        $department = [];
        $description = [];
        $subtitle = [];
        $professor = [];

        foreach ($arr as $row) {
            $name[] = $row['name'];
            $section[] = $row['section'];
            $classID[] = $row['classID'];
            $department[] = $row['department'];
            $description[] = $row['description'];
            $subtitle[] = $row['subtitle'];
            $professor[] = $row['prof_name'];
        }


        include "templates/results.php";
    }



    public function class_reviews()
    {
        $_classID = $_POST['classid'];

        $sql = "SELECT * FROM classdescription NATURAL JOIN classtype NATURAL JOIN classidentity NATURAL JOIN taughtby NATURAL JOIN professor LEFT JOIN classrequirement ON classrequirement.classID=classidentity.classID WHERE classidentity.classID=?";
        //First arg is the connection, second arg is the sql, third arg is the datatype, 4th arg is all the variables
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_classID);

        $classID = $arr[0]['classID'];
        $name = $arr[0]['name'];
        $section = $arr[0]['section'];
        $description = $arr[0]['description'];
        $credits = $arr[0]['credits'];
        $subtitle = $arr[0]['subtitle'];
        $department = $arr[0]['department'];
        $professor = $arr[0]['prof_name'];
        $profID = $arr[0]['profID'];
        $requirement = $arr[0]['requirement'];
        $email = $arr[0]['email'];

        $has_review = false;
        $sql = "SELECT AVG(rating) as avg_rating, AVG(difficulty) as avg_diff, AVG(hoursOutside) as avg_hours
        FROM review 
        NATURAL JOIN classreview 
        WHERE classID=? 
        GROUP BY classID";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_classID);

        if (count($arr) > 0) {
            $avg_rating = round($arr[0]['avg_rating'], 1);
            $avg_difficulty = round($arr[0]['avg_diff'], 1);
            $avg_hours = round($arr[0]['avg_hours'], 1);
            $has_review = true;
        }



        $sql = "SELECT * FROM classreview NATURAL JOIN review WHERE classID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_classID);




        $difficulty = [];
        $hoursOutside = [];
        $rating = [];
        $reviewDescription = [];
        $reviewTerm = [];
        $reviewDate = [];

        foreach ($arr as $row) {
            $difficulty[] = $row['difficulty'];
            $hoursOutside[] = $row['hoursOutside'];
            $rating[] = $row['rating'];
            $reviewDescription[] = $row['reviewDescription'];
            $reviewTerm[] = $row['reviewTerm'];
            $reviewDate[] = date("F d Y", strtotime($row['reviewDate']));
        }

        include "templates/reviews.php";
    }
    public function my_reviews()
    {
        $sql = "SELECT * FROM classreview NATURAL JOIN review NATURAL JOIN writtenbyuser NATURAL JOIN classidentity WHERE computingID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's',  $_SESSION["loggedin_username"]);

        $class_difficulty = [];
        $class_hoursOutside = [];
        $class_rating = [];
        $class_reviewDescription = [];
        $class_reviewTerm = [];
        $class_reviewDate = [];
        $class_name = [];
        $class_reviewID = [];
        foreach ($arr as $row) {
            $class_difficulty[] = $row['difficulty'];
            $class_hoursOutside[] = $row['hoursOutside'];
            $class_rating[] = $row['rating'];
            $class_reviewDescription[] = $row['reviewDescription'];
            $class_reviewTerm[] = $row['reviewTerm'];
            $class_reviewDate[] = date("F d Y", strtotime($row['reviewDate']));
            $class_name[] = $row['name'];
            $class_reviewID = $row['reviewID'];
        }

        $sql = "SELECT * FROM professorreview NATURAL JOIN review NATURAL JOIN writtenbyuser NATURAL JOIN professor WHERE computingID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's',  $_SESSION["loggedin_username"]);
        $prof_leniency = [];
        $prof_rating = [];
        $prof_reviewDescription = [];
        $prof_reviewTerm = [];
        $prof_reviewDate = [];
        $prof_name = [];
        $prof_reviewID = [];

        foreach ($arr as $row) {
            $prof_leniency[] = $row['leniency'];
            $prof_rating[] = $row['rating'];
            $prof_reviewDescription[] = $row['reviewDescription'];
            $prof_reviewTerm[] = $row['reviewTerm'];
            $prof_reviewDate[] = date("F d Y", strtotime($row['reviewDate']));
            $prof_name[] = $row['prof_name'];
            $prof_reviewID = $row['reviewID'];
        }


        include "templates/userReviews.php";
    }
    public function add_review()
    {
        $_classID = $_POST['classid'];
        $sql = "SELECT name FROM classidentity where classID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_classID);
        $class_name = $arr[0]['name'];

        $sql = "SELECT prof_name FROM professor NATURAL JOIN taughtby where classID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_classID);

        $prof_name = $arr[0]['prof_name'];

        include "templates/add_review.php";
    }
    function runSafeSQL($conn, $sql, $paramTypes, ...$params)
    {
        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            die("Error preparing the statement: " . mysqli_error($conn));
        }

        // Bind the parameters
        if ($paramTypes != '') {
            mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
        }

        // Execute the statement
        if (!mysqli_stmt_execute($stmt)) {
            die("Error executing the statement: " . mysqli_stmt_error($stmt));
        }

        // If the query is a select statement, bind the result variables
        if (strtoupper(substr($sql, 0, 6)) === 'SELECT') {
            $result = mysqli_stmt_result_metadata($stmt);
            if ($result) {
                $fields = array();
                $out = array();
                $fields[0] = $stmt;
                $count = 1;

                while ($field = mysqli_fetch_field($result)) {
                    $fields[$count] = &$out[$field->name];
                    $count++;
                }
                call_user_func_array('mysqli_stmt_bind_result', $fields);

                // Fetch the results into an array
                $results = array();
                while (mysqli_stmt_fetch($stmt)) {
                    $results[] = array_map(function ($value) {
                        return $value;
                    }, $out);
                }

                // Close the statement and return the results
                mysqli_stmt_close($stmt);
                return $results;
            } else {
                die("Error binding result variables: " . mysqli_stmt_error($stmt));
            }
        } else {
            // For non-select queries, if it is an INSERT query, return the last inserted id
            if (strtoupper(substr($sql, 0, 6)) === 'INSERT') {
                $last_id = mysqli_insert_id($conn);
                mysqli_stmt_close($stmt);
                return $last_id;
            } else {
                // For other types of queries, we just close the statement and return true
                mysqli_stmt_close($stmt);
                return true;
            }
        }
    }
}
