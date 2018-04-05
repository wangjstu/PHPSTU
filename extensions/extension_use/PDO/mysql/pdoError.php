<?php
/**
 * User: wangjstu
 * Date: 2017/7/22 16:14
 * 1、连接发生错误只能通过try...catch捕获到，PDO::errorCode和PDO::errorInfo是捕获不到的
 * 2、PDO::errorCode — 获取跟数据库句柄(database handle)上一次操作相关的 SQLSTATE
 *   PDO::errorInfo() - Fetch extended error information associated with the last operation on the database handle(database handle)
 *   PDOStatement 代表一条预处理语句，并在该语句被执行后代表一个相关的结果集。
 *   PDOStatement::errorCode() - 获取跟上一次语句句柄操作相关的 SQLSTATE， 只取回 PDOStatement 对象执行操作中的错误码
 *   PDOStatement::errorInfo() - 获取跟上一次语句句柄操作相关的扩展错误信息， 只取回 PDOStatement 对象执行操作中的错误
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
    print "pdoError: " . $dbconn->errorCode() . PHP_EOL;
    print "pdoInfo: " . PHP_EOL;
    var_dump($dbconn->errorInfo());
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . PHP_EOL;
}