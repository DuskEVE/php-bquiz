<?php
    include_once '../../include/db.php';

    $Que = new myDataBase('localhost', 'utf8', 'bquiz');

    $data = [];
    $data['text'] = $_POST['subject'];
    $data['subject_id'] = 0;
    $data['count'] = 0;
    $data['display'] = 1;

    $Que->updateData('que', $data);

    foreach($_POST['option'] as $option){
        $subject = $Que->searchByTarget('que', ['text'=>$_POST['subject']]);

        $data = [];
        $data['text'] = $option;
        $data['subject_id'] = $subject[0]['id'];
        $data['count'] = 0;
        $data['display'] = 1;

        $Que->updateData('que', $data);
    }

    header('location:../result.php');
?>