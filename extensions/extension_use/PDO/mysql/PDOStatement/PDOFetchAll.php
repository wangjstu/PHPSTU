<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 19:00
 * array PDOStatement::fetchAll ([ int $fetch_style [, mixed $fetch_argument [, array $ctor_args = array() ]]] )
 * PDOStatement::fetchAll — 返回一个包含结果集中所有行的数组
 * PDOStatement::fetchAll() 返回一个包含结果集中所有剩余行的数组。此数组的每一行要么是一个列值的数组，要么是属性对应每个列名的一个对象。
 * 使用此方法获取大结果集将导致系统负担加重且可能占用大量网络资源。与其取回所有数据后用PHP来操作，倒不如考虑使用数据库服务来处理结果集。例如，在取回数据并通过PHP处理前，在 SQL 中使用 WHERE 和 ORDER BY 子句来限定结果。
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
$result = $sth->fetchAll(PDO :: FETCH_BOTH);
print_r($result);
print("\n");


$sth->execute();
print("PDO::FETCH_LAZY: ");
//PDOStatement::fetchAll(): SQLSTATE[HY000]: General error: PDO::FETCH_LAZY can't be used with PDOStatement::fetchAll()
print("Return next row as an anonymous object with column names as properties\n");
$result = $sth->fetchAll(PDO :: FETCH_LAZY);
print_r($result);
print("\n");


$sth->execute();
print("PDO::FETCH_OBJ: ");
print("Return next row as an anonymous object with column names as properties\n");
$result = $sth->fetchAll(PDO :: FETCH_OBJ);
var_dump($result);
print("\n");


/*fetch_style
    控制返回数组的内容如同 PDOStatement::fetch() 文档中记载的一样。默认为 PDO::ATTR_DEFAULT_FETCH_MODE 的值（ 其缺省值为 PDO::FETCH_BOTH ）

    想要返回一个包含结果集中单独一列所有值的数组，需要指定 PDO::FETCH_COLUMN 。通过指定 column-index 参数获取想要的列。

    想要获取结果集中单独一列的唯一值，需要将 PDO::FETCH_COLUMN 和 PDO::FETCH_UNIQUE 按位或。

    想要返回一个根据指定列把值分组后的关联数组，需要将 PDO::FETCH_COLUMN 和 PDO::FETCH_GROUP 按位或。

fetch_argument
    根据 fetch_style 参数的值，此参数有不同的意义：

        1.PDO::FETCH_COLUMN ：返回指定以0开始索引的列。

        2.PDO::FETCH_CLASS ：返回指定类的实例，映射每行的列到类中对应的属性名。

        3.PDO::FETCH_FUNC ：将每行的列作为参数传递给指定的函数，并返回调用函数后的结果。


ctor_args
    当 fetch_style 参数为 PDO::FETCH_CLASS 时，自定义类的构造函数的参数。
 */

