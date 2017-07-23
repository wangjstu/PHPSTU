<?php
/**
 * User: wangjstu
 * Date: 2017/7/22 16:30
 * PDO::exec() 在一个单独的函数调用中执行一条 SQL 语句，返回受此语句影响的行数。
 * 如果没有受影响的行(可能是没有符合条件的，也可能set的值和本身一致，不用修改)，则 PDO::exec() 返回 0。还可能返回false。
 * PDO::exec() 不会从一条 SELECT 语句中返回结果。对于在程序中只需要发出一次的 SELECT 语句，
 * 可以考虑使用 PDO::query()。
 * 对于需要发出多次的语句，可用 PDO::prepare() 来准备一个 PDOStatement 对象并用 PDOStatement::execute() 发出语句。
 */
try {
    $dbconn = new PDO("mysql:host=127.0.0.1;port=3306;dbname=test", "root", "");
    $execRes = $dbconn->exec("UPDATE photolist SET datasource='PHP' WHERE id=1");
    echo 'PDO::exec result:' . PHP_EOL;
    var_dump($execRes);
} catch (PDOException $e) {
    echo "PDOException: " . $e->getMessage() . PHP_EOL;
}