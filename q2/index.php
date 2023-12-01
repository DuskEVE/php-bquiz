<?php
    include_once '../include/db.php';
    $Que = new myDataBase('localhost', 'utf8', 'bquiz');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問卷調查</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/my-style.css">
</head>
<body>

    <header class="p-5 text-center">
        <h1>問卷調查</h1>
    </header>

    <main class="container">

        <fieldset>
            <legend>目前位置:首頁>問卷調查</legend>

            <table class="table">
                <tr>
                    <th>編號</th>
                    <th>問卷題目</th>
                    <th>投票總數</th>
                    <th>結果</th>
                    <th>狀態</th>
                </tr>
                <?php
                $ques = $Que->searchByTarget('que', ['subject_id'=>0, 'display'=>1]);
                foreach($ques as $index=>$que){
                ?>
                <tr>
                    <td><?=$index+1?></td>
                    <td><?=$que['text']?></td>
                    <td><?=$que['count']?></td>
                    <td>
                        <a class="btn btn-info" href="result.php?id=<?=$que['id']?>">
                            投票結果
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-warning" href="vote.php?id=<?=$que['id']?>">
                            我要投票
                        </a>
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