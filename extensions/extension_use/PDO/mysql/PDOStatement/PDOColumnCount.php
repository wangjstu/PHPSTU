<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 18:28
 * 使用 PDOStatement::columnCount() 返回由 PDOStatement 对象代表的结果集中的列数。
 * 如果是由 PDO::query() 返回的 PDOStatement 对象，则列数计算立即可用。
 * 如果是由 PDO::prepare() 返回的 PDOStatement 对象，则在调用 PDOStatement::execute() 之前都不能准确地计算出列数。
 */


try {
    //connect mysql
    $dbconn = new PDO(
        'mysql:host=127.0.0.1;port=3306;dbname=test',   //dns
        'root',     //user
        '',         //password
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')     //attribute
    );
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . PHP_EOL;
}

/* 创建一个 PDOStatement 对象 */
$stmt = $dbconn->prepare("select * from test where id>1");
$cc = $stmt->columnCount();
var_dump($cc);
$stmt->execute();
$cc = $stmt->columnCount();
var_dump($cc);