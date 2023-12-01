<?php
    include_once '../include/db.php';
    $Que = new myDataBase('localhost', 'utf8', 'bquiz');

    $subjects = $Que->searchByType('que', 'subject_id', 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問卷管理後台</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/my-style.css">
</head>
<body>

    <header class="p-5 text-center">
        <h1>問卷管理</h1>
    </header>

    <main class="container P-3">
        <fieldset>
            <legend>新增問卷</legend>
            <form action="./api/add_que.php" method="post">
                <div class="d-flex">
                    <div class="col-3">問卷名稱</div>
                    <div class="col-6">
                        <input type="text" name="subject" id="">
                    </div>
                </div>

                <div class="bg-light p-2">
                    <div class="p-2">
                        <label for="">選項</label>
                        <input type="text" name="option[]">
                    </div>
                    <input type="button" id="option" value="增加項目" onclick="moreOption()">
                </div>

                <div>
                    <input type="submit" value="新增">
                    <input type="reset" value="重置">
                </div>
            </form>
        </fieldset>

        <fieldset>
            <legend>問卷列表</legend>

            <table class="table">
                <tr>
                    <th>編號</th>
                    <th>主題內容</th>
                    <th>操作</th>
                </tr>

                <?php
                foreach($subjects as $index=>$subject){
                ?>
                <tr>
                    <td><?=$index+1?></td>
                    <td><?=$subject['text']?></td>
                    <td>
                        <a class="btn <?=$subject['display'] == 1? 'btn-secondary':'btn-info'?>" 
                            href="./api/edit_display.php?display=<?=$subject['display']?>&id=<?=$subject['id']?>">
                            <?=$subject['display'] == 1? '隱藏':'顯示'?>
                        </a>
                        <button class="btn btn-success">編輯</button>
                        <a href="./api/del.php?id=<?=$subject['id']?>">
                            <button class="btn btn-danger">刪除</button>
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
    <script>
        const moreOption = () => {
            let option = `<div class="p-2">
                            <label for="">選項</label>
                            <input type="text" name="option[]">
                        </div>`;
            $('#option').before(option);
        };

    </script>
</body>
</html>