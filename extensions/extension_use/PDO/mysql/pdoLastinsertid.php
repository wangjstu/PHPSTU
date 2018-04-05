<?php
/**
 * User: wangjstu
 * Date: 2017/7/22 17:13
 * PDO::lastInsertId — 返回最后插入行的ID或序列值
 * 返回最后插入行的ID，或者是一个序列对象最后的值，取决于底层的驱动。比如，PDO_PGSQL() 要求为 name 参数指定序列对象的名称。
 * 如果没有为参数 name 指定序列名称，PDO::lastInsertId() 则返回一个表示最后插入数据库那一行的行ID的字符串。
 * 如果为参数 name 指定了序列名称，PDO::lastInsertId() 则返回一个表示从指定序列对象取回最后的值的字符串。
 * 如果当前 PDO 驱动不支持此功能，则 PDO::lastInsertId() 触发一个 IM001 SQLSTATE 。
 */
try {
    //connect mysql
    $dbconn = new PDO(
        'mysql:host=127.0.0.1;port=3306;dbname=test',   //dns
        'root',     //user
        '',         //password
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')     //attribute
    );
    $sql = "INSERT INTO test (`name`) VALUES('wangjun1')";
    $dbconn->exec($sql);
    var_dump($dbconn->lastInsertId());
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . PHP_EOL;
}