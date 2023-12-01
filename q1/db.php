
<style>
    table, tr, td{
        border: 1px solid;
        border-collapse: collapse;
    }
</style>

<div class="container">

    <!-- <div class="form-box">
        <form action="./db.php">
            <label for="tableName">table name:</label>
            <select name="tableName" id="tableName">

            </select><br>

            <label for="tableName">table name:</label>
            <select name="tableName" id="tableName">

            </select>
        </form>
    </div> -->

</div>

<?php

    class myDataBase{
        private $host;
        private $charset;
        private $dbName;
        private $userName = 'root';
        private $password = '';

        function __construct($host, $charset, $dbName){
            $this->host = $host;
            $this->charset = $charset;
            $this->dbName = $dbName;
        }

        public function dbLogIn(){
            $dsn = "mysql:host={$this->host}; charset={$this->charset}; dbname={$this->dbName}";
            return new PDO($dsn, $this->userName, $this->password);
        }

        private function arrayToString($arr){
            $targetSet = [];
            foreach($arr as $key=>$target){
                $str = " `{$key}`='{$target}'";
                array_push($targetSet, $str);
            }
            return implode("&&", $targetSet);
        }

        public function switchDb($host, $charset, $dbName){
            $this->host = $host;
            $this->charset = $charset;
            $this->dbName = $dbName;
        }

        public function searchAll($tableName){
            $pdo = $this->dbLogIn();
            $sql = "select * from `{$tableName}`";

            $arr = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $arr;
        }

        public function searchByType(string $tableName, $targetType, $target){
            $pdo = $this->dbLogIn();
            $sql = "select * from `{$tableName}` where ";
    
            if(is_array($target)) $sql = $sql."`{$targetType}` in ('".implode("','", $target)."')";
            else $sql = $sql."`{$targetType}`='{$target}'";
            
            $arr = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $arr;
        }

        public function searchByTarget(string $tableName, array $targets){
            $pdo = $this->dbLogIn();
            $targetSet = $this->arrayToString($targets);

            $sql = "select * from `{$tableName}` where {$targetSet}";
            // echo $sql;
            $arr = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $arr;
        }

        public function updateData($tableName, $datas){
            $pdo = $this->dbLogIn();
            $sql = null;
            $dataSet = [];
            foreach($datas as $key=>$target){
                if($key != 'id'){
                    $str = " `{$key}`='{$target}'";
                    array_push($dataSet, $str);
                }
            }
            $dataSet = implode(",", $dataSet);
    
            if(isset($datas['id'])){
                $sql = "update `".$tableName."` set ".$dataSet.
                    " where `id`='{$datas['id']}'";
            }
            else{
                $sql = "insert into {$tableName} (`".implode("`,`", array_keys($datas))."`) 
                    values ('".implode("','", array_values($datas))."')";
            }
            // echo $sql.'<br>';
            $result = $pdo->exec($sql);
            if($result > 0) return "成功更改{$result}筆資料";
            else if($result == 0) return "未變更任何資料(輸入與原本內容相同)";
            else return "發生錯誤，以下為錯誤訊息:{$result}";
        }

        public function deleteById($tableName, $id){
            $pdo = $this->dbLogIn();
            $sql = "Delete from {$tableName} where ";
    
            if(is_array($id)) $sql = $sql."`id` in ('".implode("','", $id)."')";
            else $sql = $sql."`id`='{$id}'";
            // echo $sql.'<br>';
    
            $result = $pdo->exec($sql);
            if($result > 0) return "成功刪除{$result}筆資料";
            else if($result == 0) return "未刪除任何資料(目標不存在)";
            else return "發生錯誤，以下為錯誤訊息:{$result}";
        }

    }
    
    // $myDB = new myDataBase('localhost', 'utf8', 'school');
    
    // echo printTable( $myDB->searchByType('students', 'id', [1, 2, 3, 4, 5]) );
    // echo printTable( $myDB->searchByTarget('students', ['dept'=>'2', 'graduate_at'=>'2']) );

    // echo printTable( $myDB->searchAll('dept') );
    // echo $myDB->updateData('dept', ['id'=>21, 'code'=>114, 'name'=>'電子系']);
    // echo printTable( $myDB->searchAll('dept') );
    
    // $myDB->switchDb('localhost', 'utf8', 'member');
    // echo printTable( $myDB->searchAll('user') );
    
    // echo "<br>";
    // echo $myDB->insertData('dept', ['code'=>113, 'name'=>'織品系']);
    // echo $myDB->deleteById('dept', [12, 13, 14, 15]);
    

    function printArray($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    function printTable($arr){
        $keys = array_keys($arr[0]);
        $result = [];

        array_push($result, '<tr><td>'.join('</td><td>', $keys).'</td></tr>');

        for($i=0; $i<count($arr); $i++){
            array_push($result, '<tr>');

            foreach($arr[$i] as $key=>$value){
                array_push($result, '<td>'.$value.'</td>');
            }

            array_push($result, '</tr>');
        }

        return '<table>'.join($result).'</table>';
    }


?>