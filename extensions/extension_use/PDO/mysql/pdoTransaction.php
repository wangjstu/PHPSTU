<?php
/**
 * User: wangjstu
 * Date: 2017/7/22 16:44
 * PDO::beginTransaction — 启动一个事务
 * PDO::commit() - 提交一个事务
 * PDO::rollBack() - 回滚一个事务
 * PDO::inTransaction — 检查是否在一个事务内
 * 并不是所有数据库都允许使用DDL语句进行事务操作：有些会产生错误，而其他一些（包括MySQL）会在遇到第一个DDL语句后就自动提交事务。
 */
try {
    $dbconn = new PDO('mysql:host=127.0.0.1;port=3306;dbname=test', 'root', '');
} catch (PDOException $e) {
    var_dump($e);
}

try {
    $dbconn->beginTransaction();
    echo "pdo inTransaction:" . PHP_EOL;
    var_dump($dbconn->inTransaction());
    $res = $dbconn->exec("select 1;");
    echo "exec Result:" . PHP_EOL;
    var_dump($res);
    echo "pdo inTransaction:" . PHP_EOL;
    var_dump($dbconn->inTransaction());
    $dbconn->commit();
    echo "pdo inTransaction:" . PHP_EOL;
    var_dump($dbconn->inTransaction());
} catch (PDOException $e) {
    $dbconn->rollBack();
    var_dump($e);
}