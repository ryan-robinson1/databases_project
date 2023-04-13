<?php

//https://cs4640.cs.virginia.edu/rpr6at/hw4/
// Register the autoloader
session_start();
spl_autoload_register(function ($classname) {
    include "classes/$classname.php";
});

// Parse the query string for command
$command = "";
if (isset($_GET["command"]))
    $command = $_GET["command"];
else {
    $command = "run";
}



// Instantiate the controller and run
$game = new Controller($command);
$game->run();
