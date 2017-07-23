<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 18:34
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
var_dump($stmt->errorCode(), $stmt->errorInfo());
