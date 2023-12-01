<?php
    include_once '../include/db.php';
    $Que = new myDataBase('localhost', 'utf8', 'bquiz');

    $title = $Que->searchByType('que', 'id', $_GET['id']);
    $subjects = $Que->searchByType('que', 'subject_id', $_GET['id']);
    $total = 0;
    foreach($subjects as $subject){
        $total += $subject['count'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投票結果</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/my-style.css">
</head>
<body>

    <header class="p-5 text-center">
        <h1>投票結果</h1>
    </header>

    <main class="container P-3">

        <fieldset>
            <legend>目前位置:首頁>投票結果</legend>

            <h1 class="text-center"><?=$title[0]['text']?></h1>
            <table class="table">
                <tr>
                    <th>編號</th>
                    <th>項目</th>
                    <th>票數</th>
                </tr>

                <?php
                foreach($subjects as $index=>$subject){
                    $per = 0;
                    if($subject['count'] > 0){
                        $per = round($subject['count']/$total*100, 1);
                    }
                ?>
                <tr>
                    <td><?=$index+1?></td>
                    <td><?=$subject['text']?></td>
                    <td class="d-flex align-items-center">
                        <div class="result-bar me-2" style="width:<?=$per?>%;"></div>
                        <span><?=$subject['count']?>票(<?=$per?>%)</span>
                    </td>
                </tr>
                <?php
                }
                ?>

            </table>

        </fieldset>

    </main>
    
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</body>
</html>