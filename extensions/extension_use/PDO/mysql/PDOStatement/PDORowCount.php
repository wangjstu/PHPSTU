<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 19:25
 * PDOStatement::rowCount — 返回受上一个 SQL 语句影响的行数
 * PDOStatement::rowCount() 返回上一个由对应的 PDOStatement 对象执行DELETE、 INSERT、或 UPDATE 语句受影响的行数。
 * 如果上一条由相关 PDOStatement 执行的 SQL 语句是一条 SELECT 语句，有些数据可能返回由此语句返回的行数。但这种方式不能保证对所有数据有效，且对于可移植的应用不应依赖于此方式。
 * 对于大多数数据库， PDOStatement::rowCount() 不能返回受一条 SELECT 语句影响的行数。替代的方法是，使用 PDO::query() 来发出一条和原打算中的SELECT语句有相同条件表达式的 SELECT COUNT(*) 语句，然后用 PDOStatement::fetchColumn() 来取得返回的行数。这样应用程序才能正确执行。
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

$sql = "select * from test where id=:ID";
$id = 1;
$sth = $dbconn->prepare($sql);
$sth->bindParam(':ID', $id);
$sth->execute();
var_dump($sth->rowCount());