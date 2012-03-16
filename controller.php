<?php
/**
 * 検索する
 */
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include 'renpoko.php';

$obj = new renpoko;

if (!empty($_POST['ISBN'])) {
    $obj->setISBN($_POST['ISBN']);
    echo $obj->getISBN();
} elseif (!empty($_POST['kikaku1']) && !empty($_POST['kikaku2'])) {
    $obj->setKikakuNumber($_POST['kikaku1'], $_POST['kikaku2'], $_POST['category']);
    echo $obj->getKikakuNumber();
} elseif (!empty($_POST['keyword'])) {
    $obj->setKeyword($_POST['keyword'], $_POST['category']);
    echo $obj->getKeyword();
} else {
    echo '<li>No object!<li>';
}

?>
