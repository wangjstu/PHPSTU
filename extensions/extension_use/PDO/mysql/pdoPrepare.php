<?php
/**
 * User: wangjstu
 * Date: 2017/7/22 17:40
 * PDO::prepare — Prepares a statement for execution and returns a statement object
 * Prepares an SQL statement to be executed by the PDOStatement::execute() method
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
$statement = $dbconn->prepare("select * from test where id=:ID", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$statement->execute(array(':ID'=>1)); //返回true或者false
$dataOf1 = $statement->fetchAll();
var_dump($dataOf1);

