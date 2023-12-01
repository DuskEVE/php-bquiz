<?php
    include_once './db.php';
    $Title = new myDataBase('localhost', 'utf8', 'bquiz');

    foreach($_POST['id'] as $key=>$id){
        printArray($_POST);

        if(isset($_POST['del']) && in_array($id,$_POST['del']['id'])){
            $Title->deleteById('titles', $id);
        }
        else{
            $row = $Title->searchByTarget('titles', ['id'=>$id]);
            $row[0]['text'] = $_POST['text'][$key];
            $Title->updateData('titles', $row[0]);
        }
    }

    header('location:./index.php');
?>