<?php
    include_once './db.php';

    $Title = new myDataBase('localhost', 'utf8', 'bquiz');

    if(!empty($_FILES['img']['tmp_name'])){
        move_uploaded_file($_FILES['img']['tmp_name'], './img/'.$_FILES['img']['name']);
        $_POST['img'] = $_FILES['img']['name'];
    }

    $_POST['display'] = 0;
    $Title->updateData('titles', $_POST);

    header('location:./index.php');
?>