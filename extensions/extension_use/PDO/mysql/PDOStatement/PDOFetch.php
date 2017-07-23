<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 18:44
 * PDOStatement::fetch — 从结果集中获取下一行
 * 控制下一行如何返回给调用者。此值必须是 PDO::FETCH_* 系列常量中的一个，缺省为 PDO::ATTR_DEFAULT_FETCH_MODE 的值 （默认为 PDO::FETCH_BOTH ）。
 * 1.PDO::FETCH_ASSOC：返回一个索引为结果集列名的数组
 * 2.PDO::FETCH_BOTH（默认）：返回一个索引为结果集列名和以0开始的列号的数组
 * 3.PDO::FETCH_BOUND：返回 TRUE ，并分配结果集中的列值给 PDOStatement::bindColumn() 方法绑定的 PHP 变量。
 * 4.PDO::FETCH_CLASS：返回一个请求类的新实例，映射结果集中的列名到类中对应的属性名。如果 fetch_style 包含 PDO::FETCH_CLASSTYPE（例如：PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE），则类名由第一列的值决定
 * 5.PDO::FETCH_INTO：更新一个被请求类已存在的实例，映射结果集中的列到类中命名的属性
 * 6.PDO::FETCH_LAZY：结合使用 PDO::FETCH_BOTH 和 PDO::FETCH_OBJ，创建供用来访问的对象变量名
 * 7.PDO::FETCH_NUM：返回一个索引为以0开始的结果集列号的数组
 * 8.PDO::FETCH_OBJ：返回一个属性名对应结果集列名的匿名对象
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

/* 运用 PDOStatement::fetch 风格 */
$sth->execute();
print("PDO::FETCH_ASSOC: ");
print("Return next row as an array indexed by column name\n");
$result = $sth->fetch(PDO :: FETCH_ASSOC);
print_r($result);
print("\n");


$sth->execute();
print("PDO::FETCH_BOTH: ");
print("Return next row as an array indexed by both column name and number\n");
$result = $sth->fetch(PDO :: FETCH_BOTH);
print_r($result);
print("\n");


$sth->execute();
print("PDO::FETCH_LAZY: ");
print("Return next row as an anonymous object with column names as properties\n");
$result = $sth->fetch(PDO :: FETCH_LAZY);
print_r($result);
print("\n");


$sth->execute();
print("PDO::FETCH_OBJ: ");
print("Return next row as an anonymous object with column names as properties\n");
$result = $sth->fetch(PDO :: FETCH_OBJ);
var_dump($result);
print("\n");



