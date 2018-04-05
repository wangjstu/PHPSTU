<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 18:23
 * PDOStatement::closeCursor() 释放到数据库服务的连接，以便发出其他 SQL 语句，但使语句处于一个可以被再次执行的状态。
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

/* 创建第二个 PDOStatement 对象 */
$otherStmt = $dbconn->prepare("select * from test where id>1");

/* 执行第一条语句 */
$stmt->execute();

/*  从结果集中只取出第一行 */
$oneRes = $stmt->fetch();
var_dump($oneRes);

/* The following call to closeCursor() may be required by some drivers */
$stmt->closeCursor();

/*  现在可以执行第二条语句了 */
$otherStmt->execute();

/*  从结果集中只取出第一行 */
$oneRes = $otherStmt->fetch();
var_dump($oneRes);