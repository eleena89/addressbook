<!--<table border="1">
    <?for($i = 0; $i < 5; $i++){?>
    <tr>
        <?for($j = 0; $j < 10; $j++){?>
        <td>1</td>
        <?}?>
    </tr>
    <?}?>
</table>  -->

<?php
include 'lib/func.php';
error_reporting(E_ALL ^ E_NOTICE);
@ $db =  mysql_pconnect('localhost', 'root', 'Lo00Mqz7');
if (!$db) {
    echo 'Error: Could not connect to database. Please try again later.';
    exit;
}
mysql_select_db('addressbook');
d($_GET);
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

?>

<table border="1">
<tr style="color: black;background: #dcdcdc">
    <?foreach($data[0] as $key => $dataA){?>
        <td><?= $key ?></td>
    <?}?>
    <td>1</td><td>1</td>
</tr>
    <?for($i = 0; $i < count($data); $i++){?>
<tr>
    <?foreach($data[$i] as $dataI){?>
    <td><?= $dataI?></td>
    <?}?>
    <td><a href="?action=edit&id=<?= $data[$i]['id'] ?>">edit</a></td><td><a href="?action=delete&id=<?= $data[$i]['id'] ?>">delete</a></td>

</tr>
<?}?>
</table>
<br>

<?
include 'addressbookform.php';
