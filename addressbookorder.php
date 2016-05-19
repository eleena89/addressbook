<?php
include 'lib/func.php';
d($_POST);
@ $db =  mysql_pconnect('localhost', 'root', 'Lo00Mqz7');
if (!$db) {
    echo 'Error: Could not connect to database. Please try again later.';
    exit;
}
//d($_GET);
mysql_select_db('addressbook');

function updateRow($array, $id) {
    $pairA = array();
    foreach ($array as $key => $value){
        $pairA[] = '`' . $key . '` = "' . str_replace('"', '\"', $value) . '"';
    }
    $pairS = implode(", ", $pairA);
    $query = 'UPDATE `addressbook` SET ' . $pairS . ' WHERE `id` = ' . $id;
    if ($result = mysql_query($query)) return $result; else {
        d($query);
        d("Invalid query: " . mysql_error());
        die();
    }
}

function insertRow($array) {
    $pairA = array();
    foreach ($array as $key => $value){
        $pairA[] = '`' . $key . '` = "' . str_replace('"', '\"', $value) . '"';
    }
    $pairS = implode(", ", $pairA);
    $query = 'INSERT INTO `addressbook` SET ' . $pairS;
    if ($result = mysql_query($query)) return $result; else {
        d($query);
        d("Invalid query: " . mysql_error());
        die();
    }

}
if($_GET['id']){
    $update = updateRow($_POST, $_GET['id']);
}else{
    $insert = insertRow($_POST);
}


$data = viewTableData('addressbook');
d($data);



header('Location: addressbook.php');