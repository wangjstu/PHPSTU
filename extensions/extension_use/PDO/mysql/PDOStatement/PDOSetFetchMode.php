<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 19:30
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
try {
    $stmt = $dbconn->query($sql);
    $result = $stmt->setFetchMode(PDO :: FETCH_NUM);
    while ($row = $stmt->fetch()) {
        print  $row [0] . "\t" . $row [1] . "\n";
    }
} catch (PDOException $e) {
    print  $e->getMessage();
}
