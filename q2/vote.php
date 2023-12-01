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
    <title>參與投票</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/my-style.css">
</head>
<body>

    <header class="p-5 text-center">
        <h1>參與投票</h1>
    </header>

    <main class="container P-3">

        <form action="../add_vote.php">
            <fieldset>
                <legend>目前位置:首頁>參與投票<?=$title[0]['text']?></legend>
                <h3 class="text-center"><?=$title[0]['text']?></h3>

                <ul class="list-group">
                    <?php
                    foreach($subjects as $subject){
                    ?>
                    <li class="list-group-item">
                        <input type="radio" name="option" value="<?=$subject['id']?>">
                        <?=$subject['text']?>
                    </li>
                    <?php
                    }
                    ?>
                </ul>

                <input class="btn btn-info" type="submit" value="投票">
                <input class="btn btn-warning" type="reset" value="重置">

            </fieldset>
        </form>

    </main>
    
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</body>
</html>