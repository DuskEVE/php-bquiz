<?php
    include_once '../../include/db.php';
    $Que = new myDataBase('localhost', 'utf8', 'bquiz');

    if(isset($_GET['id'])){
        $options = $Que->searchByType('que', 'subject_id', $_GET['id']);
        $Que->deleteById('que', $_GET['id']);
        foreach($options as $option){
            $Que->deleteById('que', $option['id']);
        }
    }

    header('location:../admin.php');
?>