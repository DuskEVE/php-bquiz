
<div class="container">

    <h3 class="text-center">新增標題區圖片</h3><hr>

    <form action="./update_title.php" method="post" enctype="multipart/form-data">

        <table class="col-8 m-auto">
            <tr>
                <td>標題區圖片:</td>
                <td><input type="file" name="img" id=""></td>
                <input type="text" name="id" value="<?=$_GET['id']?>" hidden>
            </tr>
        </table>

        <div class="text-center">
            <input type="submit" value="送出">
            <input type="reset" value="重置">
        </div>
        <div></div>

    </form>
</div>