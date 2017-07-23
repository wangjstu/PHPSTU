<?php
/**
 * User: wangjstu
 * Date: 2017/7/23 17:33
 * PDO::quote() places quotes around the input string (if required) and escapes special characters
 * within the input string, using a quoting style appropriate to the underlying driver.
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

/* Dangerous string */
$string  =  'Naughty \' string' ;
print  "Unquoted string:  $string \n" ;
print  "Quoted string:"  .  $dbconn->quote($string) . "\n" ;
