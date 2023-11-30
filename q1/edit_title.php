<?php
    include_once './db.php';

    $Title = new myDataBase('localhost', 'utf8', 'bquiz');

    printArray($_POST);
?>