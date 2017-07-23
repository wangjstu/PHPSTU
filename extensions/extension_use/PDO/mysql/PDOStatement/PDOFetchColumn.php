<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 19:07
 * PDOStatement::fetchColumn — 从结果集中的下一行返回单独的一列。
 * 如果使用 PDOStatement::fetchColumn() 取回数据，则没有办法返回同一行的另外一列
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
$result = $sth->fetchColumn(1);
print_r($result);
print("\n");
