<?php
/**
* php extension in php7
*/

$br = (php_sapi_name() == "cli")? "":"<br>";

if(!extension_loaded('say')) {
	dl('say.' . PHP_SHLIB_SUFFIX);
}
$module = 'say';
$functions = get_extension_funcs($module);
echo "Functions available in the test extension:$br\n";
foreach($functions as $func) {
    echo $func."$br\n";
}
echo "$br\n";
$function = 'confirm_' . $module . '_compiled';
if (extension_loaded($module)) {
	$str = $function($module);
} else {
	$str = "Module $module is not compiled into PHP";
}
echo "$str\n";



echo '============================default_value'.PHP_EOL;
//default_value
var_dump(default_value("int"));
var_dump(default_value("int", 1));
var_dump(default_value("bool"));
var_dump(default_value("bool", true));
var_dump(default_value("str"));
var_dump(default_value("str", "a"));
var_dump(default_value("array"));


echo '============================get_size'.PHP_EOL;
//get_size
var_dump(get_size('abc'));
var_dump(get_size(['a', 'b', 'c', 'd']));



echo '============================str_concat'.PHP_EOL;
//str_concat
echo str_concat("hello", "word");
echo"\n";
echo str_concat("hello", "hello bo56.com");
echo"\n";

echo '============================array_concat'.PHP_EOL;
//array_concat
$arr = array(
        0 => '0',
        1 => '123',
        'a' => 'abc',
    );  
$prefix = array(
        1 => '456_',
        'a' => 'def_',
    );  
var_dump($arr);
var_dump($prefix);
var_dump(array_concat($arr, $prefix));

echo '============================define'.PHP_EOL;
//define
var_dump(__ARR__);
var_dump(__site__);
var_dump(say\__SITE__);


echo '============================define_var'.PHP_EOL;
//define_var
class demo {}

define_var();

var_dump($str);
var_dump($arr);
var_dump($obj);



echo '============================show_ini'.PHP_EOL;
//show_ini
$ini = show_ini();
var_dump($ini);




echo '============================call_function'.PHP_EOL;
//call_function
class democall {
    public function get_site_name ($prefix) {
        return $prefix."信海龙的博客\n";
    }
}
function get_site_url ($prefix) {
    return $prefix."www.bo56.com\n";
}

/*//扩展实现
function call_function ($obj, $fun, $param) {
    if ($obj == null) {
        $result = $fun($param);
    } else {
        $result = $obj->$fun($param);
    }
    return $result;
}*/
$demo = new democall();
echo call_function($demo, "get_site_name", "site name:");
echo call_function(null, "get_site_url", "site url:");
?>
