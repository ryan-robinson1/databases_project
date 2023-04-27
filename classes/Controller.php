<?php
class Controller
{

    private $command;
    private $conn;
    public function __construct($command)
    {
        $this->command = $command;
        $servername = "localhost";
        $username = "root";
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
            case "class_reviews":
                $this->class_reviews();
                break;
            case "sign_in":
                $this->sign_in();
                break;
            case "sign_up":
                $this->sign_up();
                break;
            case "my_reviews":
                $this->my_reviews();
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
            default:
                $this->home();
                break;
        }
    }
    public function home()
    {
        include "templates/home.php";
    }
    public function sign_in()
    {
        include "templates/sign_up.php";
    }
    public function sign_up()
    {
        $_enteredID = $_POST['computingID'];
        $_enteredName = $_POST['name'];
        $_enteredEmail = $_POST['email'];
        $enteredPwd = $_POST['pwd'];
        $_hashedPwd = password_hash($enteredPwd, PASSWORD_BCRYPT);
        $sql = "INSERT INTO theuser VALUES (?, ?, ?, ?)";
        $this->runSafeSQL($this->conn, $sql, 'ssss', $_enteredID, $_enteredName, $_enteredEmail, $_hashedPwd);
        include "templates/home.php";
    }
    public function add_prof_review()
    {
        $_profID = $_POST['profid'];


        include "templates/add_prof_review.php";
    }
    public function prof_reviews()
    {
        $_profID = $_POST['profid'];
        $sql = "SELECT email, prof_name FROM professor WHERE profID=?";
        $arr = $this->runSafeSQL($this->conn, $sql, 's', $_profID);

        $professor = $arr[0]['prof_name'];
        $email = $arr[0]['email'];


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
            // For non-select queries, we just close the statement and return true
            mysqli_stmt_close($stmt);
            return true;
        }
    }

    // public function delete()
    // {
    //     $delete_id = $_POST['delete_id'];
    //     $pieces = explode("|", $delete_id);
    //     $name = $pieces[0];
    //     $major = $pieces[1];
    //     $year = $pieces[2];


    //     $sql = "DELETE FROM friends WHERE Name ='$name' AND Major='$major' AND Year=$year;";

    //     if ($this->conn->query($sql) === TRUE) {
    //         echo "Row deleted successfully";
    //     } else {
    //         echo "Error deleting row: " . $this->conn->error;
    //     }
    //     $this->start();
    // }
    // public function update1()
    // {
    //     $update_id = $_POST['update_id'];

    //     $_SESSION["update_id"] = $update_id;
    //     include "templates/update.php";
    // }
    // public function update2()
    // {
    //     $pieces = explode("|", $_SESSION["update_id"]);
    //     $pieces0 = $pieces[0];
    //     $pieces1 = $pieces[1];
    //     $pieces2 = $pieces[2];
    //     $new_name =  $_POST["name"];
    //     $new_major =  $_POST["major"];
    //     $new_year =  $_POST["year"];
    //     $sql = "UPDATE friends SET Name='$new_name', Major='$new_major', Year=$new_year WHERE Name ='$pieces0' AND Major='$pieces1' AND Year=$pieces2;";

    //     if ($this->conn->query($sql) === TRUE) {
    //         echo "Row updated successfully";
    //     } else {
    //         echo "Error updating row: " . $this->conn->error;
    //     }
    //     $this->start();
    // }

    // public function insert()
    // {
    //     // Create connection
    //     $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

    //     // Check connection
    //     if (!$this->conn) {
    //         die("Connection failed: " . mysqli_connect_error());
    //     }
    //     $sql = "INSERT INTO friends (name, major, year) VALUES (?, ?, ?)";
    //     $stmt = mysqli_prepare($this->conn, $sql);

    //     // Step 3: Bind the values for the statement
    //     $name =  $_POST["name"];
    //     $major =  $_POST["major"];
    //     $year =  $_POST["year"];
    //     mysqli_stmt_bind_param($stmt, "ssi", $name, $major, $year);

    //     // Step 4: Execute the statement
    //     if (mysqli_stmt_execute($stmt)) {
    //         echo "New record created successfully";
    //     } else {
    //         echo "Error: " . mysqli_error($this->conn);
    //     }

    //     // Close the statement and connection
    //     mysqli_stmt_close($stmt);
    //     // mysqli_close($this->conn);
    //     $this->start();
    // }

    // public function start()
    // {
    //     $result = mysqli_query($this->conn, "SELECT * FROM friends");
    //     $this->friends = array();

    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $this->friends[] = $row;
    //     }
    //     include "templates/view_table.php";
    // }
    // public function add()
    // {
    //     include "templates/add.php";
    // }
}
