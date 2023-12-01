<?php
    include_once '../../include/db.php';

    $Que = new myDataBase('localhost', 'utf8', 'bquiz');

    $data = [];

    $data['id'] = $_GET['id'];
    if($_GET['display'] == 1) $data['display'] = 0;
    else $data['display'] = 1;

    $Que->updateData('que', $data);

    header('location:../admin.php');
?>