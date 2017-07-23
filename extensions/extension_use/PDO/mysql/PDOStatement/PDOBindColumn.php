<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 17:55
 * PDOStatement::bindColumn — 绑定一列到一个 PHP 变量
 * 安排一个特定的变量绑定到一个查询结果集中给定的列。每次调用 PDOStatement::fetch() 或 PDOStatement::fetchAll() 都将更新所有绑定到列的变量。
 * 在语句执行前 PDO 有关列的信息并非总是可用，可移植的应用应在 PDOStatement::execute() 之后 调用此函数（方法）。
 * 但是，当使用 PgSQL 驱动 时，要想能绑定一个 LOB 列作为流，应用程序必须在调用 PDOStatement::execute() 之前 调用此方法，否则大对象 OID 作为一个整数返回。
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
    $statement = $dbconn->prepare($sql);
    $statement->execute();

    /*通过列号绑定*/
    $statement->bindColumn(1, $id);
    $statement->bindColumn(2, $name);

    /*通过列明绑定*/
    $statement->bindColumn('name', $name);

    while ($row = $statement->fetch(PDO::FETCH_BOUND)) {
        print $id . "--" . $name . PHP_EOL;
    }
} catch (PDOException $e) {
    print $e->getMessage();
}

