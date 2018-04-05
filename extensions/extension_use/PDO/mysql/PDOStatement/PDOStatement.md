````PHP
PDOStatement implements Traversable {
    /* 属性 */
    readonly string $queryString ;
    /* 方法 */
    bool bindColumn ( mixed $column , mixed &$param [, int $type [, int $maxlen [, mixed $driverdata ]]] )
    bool bindParam ( mixed $parameter , mixed &$variable [, int $data_type = PDO::PARAM_STR [, int $length [, mixed $driver_options ]]] )
    bool bindValue ( mixed $parameter , mixed $value [, int $data_type = PDO::PARAM_STR ] )
    bool closeCursor ( void )
    int columnCount ( void )
    bool debugDumpParams ( void )
    string errorCode ( void )
    array errorInfo ( void )
    bool execute ([ array $input_parameters ] )
    mixed fetch ([ int $fetch_style [, int $cursor_orientation = PDO::FETCH_ORI_NEXT [, int $cursor_offset = 0 ]]] )
    array fetchAll ([ int $fetch_style [, mixed $fetch_argument [, array $ctor_args = array() ]]] )
    string fetchColumn ([ int $column_number = 0 ] )
    mixed fetchObject ([ string $class_name = "stdClass" [, array $ctor_args ]] )
    mixed getAttribute ( int $attribute )
    array getColumnMeta ( int $column )
    bool nextRowset ( void )
    int rowCount ( void )
    bool setAttribute ( int $attribute , mixed $value )
    bool setFetchMode ( int $mode )
}


属性
queryString
所用的查询字符串

Table of Contents
1.PDOStatement::bindColumn — 绑定一列到一个 PHP 变量
2.PDOStatement::bindParam — 绑定一个参数到指定的变量名
3.PDOStatement::bindValue — 把一个值绑定到一个参数
4.PDOStatement::closeCursor — 关闭游标，使语句能再次被执行。
5.PDOStatement::columnCount — 返回结果集中的列数
6.PDOStatement::debugDumpParams — 打印一条 SQL 预处理命令
7.PDOStatement::errorCode — 获取跟上一次语句句柄操作相关的 SQLSTATE
8.PDOStatement::errorInfo — 获取跟上一次语句句柄操作相关的扩展错误信息
9.PDOStatement::execute — 执行一条预处理语句
10.PDOStatement::fetch — 从结果集中获取下一行
11.PDOStatement::fetchAll — 返回一个包含结果集中所有行的数组
12.PDOStatement::fetchColumn — 从结果集中的下一行返回单独的一列。
13.PDOStatement::fetchObject — 获取下一行并作为一个对象返回。
14.PDOStatement::getAttribute — 检索一个语句属性
15.PDOStatement::getColumnMeta — 返回结果集中一列的元数据
16.PDOStatement::nextRowset — 在一个多行集语句句柄中推进到下一个行集
17.PDOStatement::rowCount — 返回受上一个 SQL 语句影响的行数
18.PDOStatement::setAttribute — 设置一个语句属性
19.PDOStatement::setFetchMode — 为语句设置默认的获取模式。
````