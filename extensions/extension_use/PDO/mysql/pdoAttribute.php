<?php
/**
 * User: wangjstu
 * Date: 2017/7/22 17:03
 * 此函数（方法）返回一个数据库连接的属性值。 取回 PDOStatement 属性，请参阅 PDOStatement::getAttribute()。
 * PDO::ATTR_AUTOCOMMIT
 * PDO::ATTR_CASE
 * PDO::ATTR_CLIENT_VERSION
 * PDO::ATTR_CONNECTION_STATUS
 * PDO::ATTR_DRIVER_NAME
 * PDO::ATTR_ERRMODE
 * PDO::ATTR_ORACLE_NULLS
 * PDO::ATTR_PERSISTENT
 * PDO::ATTR_PREFETCH
 * PDO::ATTR_SERVER_INFO
 * PDO::ATTR_SERVER_VERSION
 * PDO::ATTR_TIMEOUT
 * ------------------
 * 1.PDO::ATTR_CASE：强制列名为指定的大小写。
 ** 1.PDO::CASE_LOWER：强制列名小写。
 ** 2.PDO::CASE_NATURAL：保留数据库驱动返回的列名。
 ** 3.PDO::CASE_UPPER：强制列名大写。
 * 2.PDO::ATTR_ERRMODE：错误报告。
 ** 1.PDO::ERRMODE_SILENT： 仅设置错误代码。
 ** 2.PDO::ERRMODE_WARNING: 引发 E_WARNING 错误
 ** 3.PDO::ERRMODE_EXCEPTION: 抛出 exceptions 异常。
 * 3.PDO::ATTR_ORACLE_NULLS （在所有驱动中都可用，不仅限于Oracle）： 转换 NULL 和空字符串。
 ** 1.PDO::NULL_NATURAL: 不转换。
 ** 2.PDO::NULL_EMPTY_STRING： 将空字符串转换成 NULL 。
 ** 3.PDO::NULL_TO_STRING: 将 NULL 转换成空字符串。
 * 4.PDO::ATTR_STRINGIFY_FETCHES: 提取的时候将数值转换为字符串。 Requires bool .
 * 5.PDO::ATTR_STATEMENT_CLASS： 设置从PDOStatement派生的用户提供的语句类。 不能用于持久的PDO实例。 需要 array(string 类名, array(mixed 构造函数的参数))。
 * 6.PDO::ATTR_TIMEOUT： 指定超时的秒数。并非所有驱动都支持此选项，这意味着驱动和驱动之间可能会有差异。比如，SQLite等待的时间达到此值后就放弃获取可写锁，但其他驱动可能会将此值解释为一个连接或读取超时的间隔。 需要 int 类型。
 * 7.PDO::ATTR_AUTOCOMMIT （在OCI，Firebird 以及 MySQL中可用）： 是否自动提交每个单独的语句。
 * 8.PDO::ATTR_EMULATE_PREPARES 启用或禁用预处理语句的模拟。 有些驱动不支持或有限度地支持本地预处理。使用此设置强制PDO总是模拟预处理语句（如果为 TRUE ），或试着使用本地预处理语句（如果为 FALSE ）。如果驱动不能成功预处理当前查询，它将总是回到模拟预处理语句上。 需要 bool 类型。
 * 9.PDO::MYSQL_ATTR_USE_BUFFERED_QUERY （在MySQL中可用）： 使用缓冲查询。
 * 10.PDO::ATTR_DEFAULT_FETCH_MODE： 设置默认的提取模式。关于模式的说明可以在 PDOStatement::fetch() 文档找到。
 * ------------------
 * PDO::setAttribute() - 设置属性
 * PDOStatement::getAttribute() - 检索一个语句属性
 * PDOStatement::setAttribute() - 设置一个语句属性
 */

try {
    $dbconn = new PDO('mysql:host=127.0.0.1;port=3306;dbname=test', 'root', '');

    $attributes = array(
        "AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
        "ORACLE_NULLS", "PERSISTENT", "PREFETCH", "SERVER_INFO", "SERVER_VERSION",
        "TIMEOUT"
    );

    foreach ($attributes as $val) {
        echo "PDO::ATTR_$val: ";
        echo $dbconn->getAttribute(constant("PDO::ATTR_$val")) . "\n";
    }

} catch (PDOException $e) {
    var_dump($e);
}