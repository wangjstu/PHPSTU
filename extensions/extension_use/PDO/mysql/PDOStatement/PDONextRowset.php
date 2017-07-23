<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 19:24
 * PDOStatement::nextRowset — 在一个多行集语句句柄中推进到下一个行集
 * 一些数据库服务支持返回一个以上行集（也被称为结果集）的存储过程。 PDOStatement::nextRowset() 使你能够结合一个 PDOStatement 对象访问第二个以及后续的行集。上述的每个行集可以有不同的列集合。
 */

/*下面例子展示了怎样调用一个存储过程，返回三个行集的 MULTIPLE_ROWSETS 。用一个 do / while 循环来循环调用 PDOStatement::nextRowset() 方法， 当不再有行集返回时返回 false 并结束循环。

<?php
$sql  =  'CALL multiple_rowsets()' ;
$stmt  =  $conn -> query ( $sql );
$i  =  1 ;
do {
    $rowset  =  $stmt -> fetchAll ( PDO :: FETCH_NUM );
    if ( $rowset ) {
        printResultSet ( $rowset ,  $i );
    }
    $i ++;
} while ( $stmt -> nextRowset ());

function  printResultSet (& $rowset ,  $i ) {
    print  "Result set  $i :\n" ;
    foreach ( $rowset  as  $row ) {
        foreach ( $row  as  $col ) {
            print  $col  .  "\t" ;
        }
        print  "\n" ;
    }
    print  "\n" ;
}
*/?><!--
以上例程会输出：

Result set 1:
apple    red
banana   yellowResult set 2:
orange   orange    150
banana   yellow    175Result set 3:
lime     green
apple    red
banana   yellow
-->