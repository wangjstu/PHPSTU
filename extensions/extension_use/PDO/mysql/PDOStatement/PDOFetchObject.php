<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 19:10
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
$result = $sth->fetchObject();
print_r($result);
print("\n");