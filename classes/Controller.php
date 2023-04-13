<?php
class Controller
{

    private $command;
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "potd5";
    private $friends;
    public function __construct($command)
    {
        $this->command = $command;
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "potd5";

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
            case "insert":
                $this->insert();
                break;
            case "run":
                $this->start();
                break;
            case "add":
                $this->add();
                break;
            case "delete":
                $this->delete();
                break;
            case "update":
                $this->update1();
                break;
            case "update_final":
                $this->update2();
                break;
            default:
                $this->insert();
                break;
        }
    }
    public function delete()
    {
        $delete_id = $_POST['delete_id'];
        $pieces = explode("|", $delete_id);
        $name = $pieces[0];
        $major = $pieces[1];
        $year = $pieces[2];


        $sql = "DELETE FROM friends WHERE Name ='$name' AND Major='$major' AND Year=$year;";

        if ($this->conn->query($sql) === TRUE) {
            echo "Row deleted successfully";
        } else {
            echo "Error deleting row: " . $this->conn->error;
        }
        $this->start();
    }
    public function update1()
    {
        $update_id = $_POST['update_id'];

        $_SESSION["update_id"] = $update_id;
        include "templates/update.php";
    }
    public function update2()
    {
        $pieces = explode("|", $_SESSION["update_id"]);
        $pieces0 = $pieces[0];
        $pieces1 = $pieces[1];
        $pieces2 = $pieces[2];
        $new_name =  $_POST["name"];
        $new_major =  $_POST["major"];
        $new_year =  $_POST["year"];
        $sql = "UPDATE friends SET Name='$new_name', Major='$new_major', Year=$new_year WHERE Name ='$pieces0' AND Major='$pieces1' AND Year=$pieces2;";

        if ($this->conn->query($sql) === TRUE) {
            echo "Row updated successfully";
        } else {
            echo "Error updating row: " . $this->conn->error;
        }
        $this->start();
    }

    public function insert()
    {
        // Create connection
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "INSERT INTO friends (name, major, year) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);

        // Step 3: Bind the values for the statement
        $name =  $_POST["name"];
        $major =  $_POST["major"];
        $year =  $_POST["year"];
        mysqli_stmt_bind_param($stmt, "ssi", $name, $major, $year);

        // Step 4: Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . mysqli_error($this->conn);
        }

        // Close the statement and connection
        mysqli_stmt_close($stmt);
        // mysqli_close($this->conn);
        $this->start();
    }

    public function start()
    {
        $result = mysqli_query($this->conn, "SELECT * FROM friends");
        $this->friends = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $this->friends[] = $row;
        }
        include "templates/view_table.php";
    }
    public function add()
    {
        include "templates/add.php";
    }
}
