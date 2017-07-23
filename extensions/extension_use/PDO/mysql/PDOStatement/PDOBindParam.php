<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 18:03
 * PDOStatement::bindParam — 绑定一个参数到指定的变量名
 * 绑定一个PHP变量到用作预处理的SQL语句中的对应命名占位符或问号占位符。 不同于 PDOStatement::bindValue() ，此变量作为引用被绑定，并只在 PDOStatement::execute() 被调用的时候才取其值。
 * 大多数参数是输入参数，即，参数以只读的方式用来建立查询。一些驱动支持调用存储过程并作为输出参数返回数据，一些支持作为输入/输出参数，既发送数据又接收更新后的数据。
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
try {
    $statement = $dbconn->prepare($sql);
    $statement->bindParam(':ID', $id);
    $statement->execute();
    $data = $statement->fetchAll();
    var_dump($data);
} catch (PDOException $e) {
    print $e->getMessage();
}