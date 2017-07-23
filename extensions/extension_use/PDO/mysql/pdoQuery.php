<?php
/**
 * User: wangjstu
 * Date: 2017/7/22 17:30
 * PDO::query — Executes an SQL statement, returning a result set as a PDOStatement object
 * PDO::query() returns a PDOStatement object, or FALSE on failure.
 * public PDOStatement PDO::query ( string $statement )
 * public PDOStatement PDO::query ( string $statement , int $PDO::FETCH_COLUMN , int $colno )
 * public PDOStatement PDO::query ( string $statement , int $PDO::FETCH_CLASS , string $classname , array $ctorargs )
 *public PDOStatement PDO::query ( string $statement , int $PDO::FETCH_INTO , object $object )
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

$sql = "select * from test where id=1";
$res = $dbconn->query($sql, PDO::FETCH_ASSOC);
var_dump($res);

//$data = $res->fetchAll(); //pdostatement can fetch all data by fetchall

foreach ($res as $val) {
    var_dump($val);
}