<?php
    include_once './db.php';

    $Title = new myDataBase('localhost', 'utf8', 'bquiz');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q1</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/my-style.css">
</head>
<body>
    <div id="cover" style="display:none; ">
        <div id="coverr">
            <a style="position:absolute; right:3px; top:4px; cursor:pointer; z-index:9999;" onclick="cl('#cover')">X</a>
            <div id="cvr" style="position:absolute; width:99%; height:100%; margin:auto; z-index:9898;"></div>
        </div>
    </div>

    <header class="container">
        <img src="" alt="">
    </header>

    <main class="container">
        <h3 class="text-center">網站標題管理</h3><hr>

        <form action="./edit_title.php" method="post">

            <table class="table table-bordered text-center">
                <tr>
                    <td>網站標題管理</td>
                    <td>替代文字</td>
                    <td>顯示</td>
                    <td>刪除</td>
                    <td></td>
                </tr>

                <?php
                    $rows = $Title->searchAll('titles');
                    foreach($rows as $row){
                ?>

                <tr>
                    <td><img src="./img/<?=$row['img']?>" style="width:300px; height:30px;"></td>
                    <td><input type="text" name="text[]" id="" value="<?=$row['text']?>" style="width:90%; text-align:center;"></td>
                    <td><input type="radio" name="" id=""></td>
                    <td><input type="checkbox" name="del[]" id="" value="<?=$row['id']?>"></td>
                    <td><input type="button" class="btn btn-primary" value="更新圖片"></td>
                    <input type="text" name="id[]" value="<?=$row['id']?>" hidden>
                </tr>

                <?php
                    }
                ?>

            </table>

            <div class="d-flex justify-content-between">
                <div><input type="button" value="新增網站標題圖片" onclick="op('#cover','#cvr','view.php?do=title')"></div>
                <div class="d-flex">
                    <div><input type="submit" value="修改確定"></div>
                    <div><input type="reset" value="重置"></div>
                </div>
                <div></div>
            </div>

        </form>

    </main>

    <footer class="container">

    </footer>

    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/js.js"></script>
    <script src="../js/bootstrap.js"></script>
</body>
</html>

<!-- onclick="op('#cover','#cvr','view.php?do=title')" -->