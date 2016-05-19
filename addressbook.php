

<?php
include 'lib/func.php';
error_reporting(E_ALL ^ E_NOTICE);
@ $db =  mysql_pconnect('localhost', 'root', 'Lo00Mqz7');
if (!$db) {
    echo 'Error: Could not connect to database. Please try again later.';
    exit;
}
mysql_select_db('addressbook');

function deleteRow($tablename, $id) {
    $query = 'DELETE  FROM ' . $tablename . ' WHERE `id` = ' . $id;
    if ($result = mysql_query($query)) {
        return $result;
    } else {
        d($query);
        d("Invalid query: " . mysql_error());
        die();
    }
}

if($_GET['action'] == 'delete' && $_GET['id']){
    $result = deleteRow('addressbook', $_GET['id']);
    header('Location: addressbook.php');
}


$tableName = 'addressbook';
$data = viewTableData($tableName);
//d($data);
?>
<style>
    table, td {
        border: 1px solid lightgray;
    }
    input {
        border: none;
    }
    tr{
        text-transform: uppercase;
    }
</style>
<table border="1" cellspacing="0">
<tr style="color: black;background: #dcdcdc">
    <?foreach($data[0] as $key => $dataA){?>
        <td><?= $key?></td>
    <?}?>
    <td colspan="2" align="center">ACTIONS</td>
</tr>
    <?for($i = 0; $i < count($data); $i++){?>
    <tr>
        <form action="addressbookorder.php?id=<?=$data[$i]['id']?>" method="post">
        <?foreach($data[$i] as $key => $dataI){?>
                <? if($key == 'id') { ?>
                <td><?=$dataI?></td>
            <?}else {?>
                <td><input type="text" name="<?=$key?>"  value="<?=htmlentities($dataI)?>" required size="20" maxlength="20"></td>
            <?}?>
        <?}?>
        <td>
            <input type="submit" value="SAVE">
        </td>
        <td>
            <input type="button" onclick="window.location='?action=delete&id=<?= $data[$i]['id'] ?>'" value="DELETE">
        </td>
        </form>
    </tr>
    <?}?>
    <tr>
        <form action="addressbookorder.php" method="post" >
        <?foreach($data[0] as $key => $dataI){?>
        <? if($key == 'id') { ?>
            <td></td>
            <?}else {?>
            <td><input type="text" name="<?=$key?>"  value=""  size="20" maxlength="20"></td>
            <?}?>
        <?}?>
        <td><input type="submit" value="SAVE">
        </td>
        <td></td>
        </form>
    </tr>
</table>
<br>

<?

