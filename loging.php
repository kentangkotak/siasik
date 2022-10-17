<?php
    function loging($data){
        $conn = $GLOBALS['conn'];
        $table = $data["table"];
        $col = $data["col"];
        $val = $data["val"];
        $userId = $_SESSION["anggaran_username"];
        $tgl = date("Y-m-d H:i:s");
        
        $sql=$conn->query("select * from {$table} where {$col}='{$val}';");
        $arr = [];
        while($rs=$sql->fetch_array()){
            $arr[] = $rs;
        }
        $content = json_encode($arr);

        $conn->query("insert into loging(
            tgl,
            content,
            userId,
            tbl
        )values(
            '{$tgl}',
            '{$content}',
            '{$userId}',
            '{$table}'
        );");
    }
