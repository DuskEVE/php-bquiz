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
            if(isset($_POST['display']) && $_POST['display'] == $id){
                $row[0]['display'] = 1;
            }
            $row[0]['text'] = $_POST['text'][$key];
            $Title->updateData('titles', $row[0]);
        }
    }

    // header('location:./index.php');
?>