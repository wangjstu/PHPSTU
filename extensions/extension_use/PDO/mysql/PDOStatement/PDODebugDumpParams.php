<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 18:31
 * PDOStatement::debugDumpParams — 打印一条 SQL 预处理命令
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
try {
    $statement = $dbconn->prepare($sql);
    $statement->bindParam(':ID', $id);
    $statement->debugDumpParams();
    $statement->execute();
    $data = $statement->fetchAll();
    var_dump($data);
} catch (PDOException $e) {
    print $e->getMessage();
}