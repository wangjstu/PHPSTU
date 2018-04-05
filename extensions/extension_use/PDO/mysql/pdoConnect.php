<?php
/**
 * User: wangjstu
 * Date: 2017/7/22 13:39
 * PDO::__construct()
 */
try {
    //connect mysql
    $dbconn = new PDO(
        'mysql:host=127.0.0.1;port=3306;dbname=test',   //dns
        'root',     //user
        '',         //password
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')     //attribute
    );
    //连接mysql后sleep将会占用mysql一个连接,通过show processlist可以查看到。
    //当从mysql里面kill掉进程后，php感知不到
    sleep(10);
    echo 'ok' . PHP_EOL;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . PHP_EOL;
}