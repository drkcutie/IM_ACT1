<?php
    $connection = new mysqli('localhost', 'root', '', 'dbBinangbangF3');

    if($connection->connect_error)
    {
        die("Connection Failed: " . $connection->connect_error);
    }


?>


