<?php
/**
 * User: wangjstu
 * Date: 2017/7/22 17:08
 */
try {
    //connect mysql
    $dbconn = new PDO(
        'mysql:host=127.0.0.1;port=3306;dbname=test',   //dns
        'root',     //user
        '',         //password
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')     //attribute
    );
    print_r(PDO::getAvailableDrivers());
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . PHP_EOL;
}