````PHP
PDO {
    __construct ( string $dsn [, string $username [, string $password [, array $driver_options ]]] )
    bool beginTransaction ( void )
    bool commit ( void )
    mixed errorCode ( void )
    public array errorInfo ( void )
    int exec ( string $statement )
    mixed getAttribute ( int $attribute )
    static array getAvailableDrivers ( void )
    bool inTransaction ( void )
    string lastInsertId ([ string $name = NULL ] )
    public PDOStatement prepare ( string $statement [, array $driver_options = array() ] )
    public PDOStatement query ( string $statement )
    public string quote ( string $string [, int $parameter_type = PDO::PARAM_STR ] )
    bool rollBack ( void )
    bool setAttribute ( int $attribute , mixed $value )
}


1.PDO::beginTransaction — 启动一个事务
2.PDO::commit — 提交一个事务
3.PDO::__construct — 创建一个表示数据库连接的 PDO 实例
4.PDO::errorCode — 获取跟数据库句柄上一次操作相关的 SQLSTATE
5.PDO::errorInfo — Fetch extended error information associated with the last operation on the database handle
6.PDO::exec — 执行一条 SQL 语句，并返回受影响的行数
7.PDO::getAttribute — 取回一个数据库连接的属性
8.PDO::getAvailableDrivers — 返回一个可用驱动的数组
9.PDO::inTransaction — 检查是否在一个事务内
10.PDO::lastInsertId — 返回最后插入行的ID或序列值
11.PDO::prepare — Prepares a statement for execution and returns a statement object
12.PDO::query — Executes an SQL statement, returning a result set as a PDOStatement object
13.PDO::quote — Quotes a string for use in a query.
14.PDO::rollBack — 回滚一个事务
15.PDO::setAttribute — 设置属性
````