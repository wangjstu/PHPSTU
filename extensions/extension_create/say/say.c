/*
  +----------------------------------------------------------------------+
  | PHP Version 7                                                        |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2016 The PHP Group                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Author:                                                              |
  +----------------------------------------------------------------------+
*/

/* $Id$ */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "php_ini.h"
#include "ext/standard/info.h"
#include "php_say.h"
#include "ext/standard/php_filestat.h"

/* If you declare any globals in php_say.h uncomment this:
ZEND_DECLARE_MODULE_GLOBALS(say)
*/

//声明一个全局变量
//ZEND_DECLARE_MODULE_GLOBALS()是使用上面定义的类型，声明一个全局变量。展开后如下：
//zend_say_globals say_globals;
ZEND_DECLARE_MODULE_GLOBALS(say)

/* True global resources - no need for thread safety here */
static int le_say;

/* {{{ PHP_INI
 */
/* Remove comments and fill if you need to have entries in php.ini
STD_PHP_INI_ENTRY()用于设置每个配置项的参数。这个宏方法有这么几个参数：
 第一个参数：配置项在配置文件ini中的名称 
 第二个参数：默认值。当ini文件中不存在这个配置项时，使用这个默认值 
 第三个参数：修改范围。就是设置都在那些场景下可以修改。详细的可以查 PHP_INI_ALL 
 第四个参数：当赋值给全局变量前，会调用的函数。PHP内核已经给出了常用的几个函数。如OnUpdateLong。 
 第五个参数：全局变量的成员名。对应zend_say_globals结构体中的成员。表明读取的值会赋值给这个成员。
 第六个参数：全局变量的类型。就是上面定义的结构体。 
 第七个参数：全局变量名称。
*/
/* }}} */
PHP_INI_BEGIN()
    STD_PHP_INI_ENTRY("say.number", "100", PHP_INI_ALL, OnUpdateLong, global_number, zend_say_globals, say_globals)
    STD_PHP_INI_ENTRY("say.string", "ab", PHP_INI_ALL, OnUpdateString, global_string, zend_say_globals, say_globals)
    STD_PHP_INI_ENTRY("say.boolean", "0", PHP_INI_ALL, OnUpdateBool, global_string, zend_say_globals, say_globals)
PHP_INI_END()

/* Remove the following function when you have successfully modified config.m4
   so that your module can be compiled into PHP, it exists only for testing
   purposes. */

/* Every user-visible function in PHP should document itself in the source */
/* {{{ proto string confirm_say_compiled(string arg)
   Return a string to confirm that the module is compiled in */
PHP_FUNCTION(confirm_say_compiled)
{
	char *arg = NULL;
	size_t arg_len, len;
	zend_string *strg;

	if (zend_parse_parameters(ZEND_NUM_ARGS(), "s", &arg, &arg_len) == FAILURE) {
		return;
	}

	strg = strpprintf(0, "Congratulations! You have successfully modified ext/%.78s/config.m4. Module %.78s is now compiled into PHP.", "say", arg);

	RETURN_STR(strg);
}
/* }}} */
/* The previous line is meant for vim and emacs, so it can correctly fold and
   unfold functions in source code. See the corresponding marks just before
   function definition, where the functions purpose is also documented. Please
   follow this convention for the convenience of others editing your code.
*/

PHP_FUNCTION(say)
{
    zend_string *strg;
    strg = strpprintf(0, "hello world");
    RETURN_STR(strg);
}


/*
方法的返回值是使用RETURN_开头的宏方法进行返回的。常用的宏方法有：
RETURN_NULL()        返回nullRETURN_LONG(l)        返回整型
RETURN_DOUBLE(d) 返回浮点型
RETURN_STR(s)        返回一个字符串。参数是一个zend_string * 指针
RETURN_STRING(s)    返回一个字符串。参数是一个char * 指针
RETURN_STRINGL(s, l) 返回一个字符串。第二个参数是字符串长度。
RETURN_EMPTY_STRING()    返回一个空字符串。
RETURN_ARR(r)        返回一个数组。参数是zend_array *指针。
RETURN_OBJ(r)         返回一个对象。参数是zend_object *指针。
RETURN_ZVAL(zv, copy, dtor) 返回任意类型。参数是 zval *指针。
RETURN_FALSE        返回falseRETURN_TRUE            返回true
更多宏方法请查看 Zend/zend_API.h中的相关代码。
*/
PHP_FUNCTION(default_value)
{
    /*
    struct _zend_string {
      zend_refcounted gc;
      zend_ulong h;
      size_t len;
      char val[1]
    };  
    */
    zend_string     *type;    
    zval            *value = NULL;

/*https://wiki.php.net/rfc/fast_zpp*/
#ifndef FAST_ZPP
    /* Getfunction parameters anddo error-checking. */
    if (zend_parse_parameters(ZEND_NUM_ARGS(), "S|z", &type, &value) == FAILURE) {
        return;
    }    
#else
    ZEND_PARSE_PARAMETERS_START(1, 2)
        Z_PARAM_STR(type)
        Z_PARAM_OPTIONAL
        Z_PARAM_ZVAL_EX(value, 0, 1)
    ZEND_PARSE_PARAMETERS_END();
#endif

    if (ZSTR_LEN(type) == 3 && strncmp(ZSTR_VAL(type), "int", 3) == 0 && value == NULL) {
        RETURN_LONG(0);
    } else if (ZSTR_LEN(type) == 3 && strncmp(ZSTR_VAL(type), "int", 3) == 0 && value != NULL) {
        RETURN_ZVAL(value, 0, 1); 
    } else if (ZSTR_LEN(type) == 4 && strncmp(ZSTR_VAL(type), "bool", 4) == 0 && value == NULL) {
        RETURN_FALSE;
    } else if (ZSTR_LEN(type) == 4 && strncmp(ZSTR_VAL(type), "bool", 4) == 0 && value != NULL) {
        RETURN_ZVAL(value, 0, 1); 
    } else if (ZSTR_LEN(type) == 3 && strncmp(ZSTR_VAL(type), "str", 3) == 0 && value == NULL) {
        RETURN_EMPTY_STRING();
    } else if (ZSTR_LEN(type) == 3 && strncmp(ZSTR_VAL(type), "str", 3) == 0 && value != NULL) {
        RETURN_ZVAL(value, 0, 1); 
    } 
    RETURN_NULL();
}


/*PHP7中对于zval变量的结构
https://github.com/laruence/php7-internal/blob/master/zval.md
http://0x1.im/blog/php/Internal-value-representation-in-PHP-7-part-1.html
http://0x1.im/blog/php/Internal-value-representation-in-PHP-7-part-2.html
*/
PHP_FUNCTION(get_size)
{
    zval *val;  /*Zend/zend_types.h*/
    size_t size;
    zend_string *result;
    HashTable *myht;

    if (zend_parse_parameters(ZEND_NUM_ARGS(), "z", &val) == FAILURE) {
      return;
    }
    /*
    Z_TYPE_P(zval *) 获取zval变量的类型
    #define IS_UNDEF                    0
    #define IS_NULL                     1
    #define IS_FALSE                    2
    #define IS_TRUE                     3
    #define IS_LONG                     4
    #define IS_DOUBLE                   5
    #define IS_STRING                   6
    #define IS_ARRAY                    7
    #define IS_OBJECT                   8
    #define IS_RESOURCE                 9
    #define IS_REFERENCE                10
    */
    /*strpprintf是PHP为我们提供的字符串拼接的方法。第一个参数是最大字符数。*/
    if (Z_TYPE_P(val) == IS_STRING) {
      /*Z_STRLEN_P(zval *) 获取字符串的长度*/
      result = strpprintf(0, "string size is %d", Z_STRLEN_P(val));
    } else if (Z_TYPE_P(val) == IS_ARRAY) {
      /*在 Zend/zend_hash.c文件中包含一些array处理的方法。 zend_array_count(HashTable *) 
      获取数组的元素个数。 zend_array 和 HashTable其实是相同的数据结构。在Zend/zend_types.h
      文件中有定义。typedef struct _zend_array HashTable;*/
      myht = Z_ARRVAL_P(val);
      result = strpprintf(0, "array size is %d", zend_array_count(myht));
    } else {
      result = strpprintf(0, "can not support");
    }

    RETURN_STR(result);
}


/*
zend_string是PHP7新增的结构。结构如下：
struct _zend_string {
    zend_refcounted_h gc; //gc信息
    zend_ulong        h;  // hash value 
    size_t            len; //字符串长度
    char              val[1]; //字符串起始地址
};
在Zend/zend_string.h提供了一些zend_string处理的一些方法。 ``ZSTR``开头的宏方法是zend_string结构专属的方法。主要有如下几个：
#define ZSTR_VAL(zstr)  (zstr)->val
#define ZSTR_LEN(zstr)  (zstr)->len
#define ZSTR_H(zstr)    (zstr)->h
#define ZSTR_HASH(zstr) zend_string_hash_val(zstr)
*/
PHP_FUNCTION(str_concat)
{
    zend_string *prefix, *subject, *result;
    zval *string;

    if (zend_parse_parameters(ZEND_NUM_ARGS(), "Sz", &prefix, &string) == FAILURE) {
      return;
    }

    /*zval_get_string, zend_binary_strncmp。 这些方法在Zend/zend_operators.h文件中*/
    subject = zval_get_string(string);
    if(zend_binary_strncmp(ZSTR_VAL(prefix), ZSTR_LEN(prefix), ZSTR_VAL(subject), ZSTR_LEN(subject), ZSTR_LEN(prefix)) == 0) {
      RETURN_STR(subject);
    }

    result = strpprintf(0, "%s %s", ZSTR_VAL(prefix), ZSTR_VAL(subject));
    RETURN_STR(result);
}


/*
PHP中的数组本质上就是一个哈希。 对于哈希处理的方法主要集中在Zend/zend_hash.h中。 对于数组的操作方法主要集中在Zend/API.h。
https://jpauli.github.io/2016/04/08/hashtables.html
*/
PHP_FUNCTION(array_concat)
{
    zval *arr, *prefix, *entry, *prefix_entry, value;
    zend_string *string_key, *result;
    zend_ulong num_key;

    if (zend_parse_parameters(ZEND_NUM_ARGS(), "aa", &arr, &prefix) == FAILURE) {
      return;
    }

    array_init_size(return_value, zend_hash_num_elements(Z_ARRVAL_P(arr)));

    ZEND_HASH_FOREACH_KEY_VAL(Z_ARRVAL_P(arr), num_key, string_key, entry) {
      if (string_key && zend_hash_exists(Z_ARRVAL_P(prefix), string_key)) {
          prefix_entry = zend_hash_find(Z_ARRVAL_P(prefix), string_key);
          if (Z_TYPE_P(entry) == IS_STRING && prefix_entry != NULL && Z_TYPE_P(prefix_entry) == IS_STRING) {
              result = strpprintf(0, "%s%s", Z_STRVAL_P(prefix_entry), Z_STRVAL_P(entry));
              ZVAL_STR(&value, result);
              zend_hash_update(Z_ARRVAL_P(return_value), string_key, &value);
          }
      } else if (string_key == NULL && zend_hash_index_exists(Z_ARRVAL_P(prefix), num_key)) {
          prefix_entry = zend_hash_index_find(Z_ARRVAL_P(prefix), num_key);
          if (Z_TYPE_P(entry) == IS_STRING && prefix_entry != NULL && Z_TYPE_P(prefix_entry) ==IS_STRING) {
            result = strpprintf(0, "%s%s", Z_STRVAL_P(prefix_entry), Z_STRVAL_P(entry));
            ZVAL_STR(&value, result);
            zend_hash_index_update(Z_ARRVAL_P(return_value), num_key, &value);
          }
      } else if (string_key) {
          zend_hash_update(Z_ARRVAL_P(return_value), string_key, entry);
          zval_add_ref(entry);
      } else {
          zend_hash_index_update(Z_ARRVAL_P(return_value), num_key, entry);
          zval_add_ref(entry);
      }
    }ZEND_HASH_FOREACH_END();
}


/*
class demo {}
代码实现以下操作:
$lng = 2;
$str = "abc";
$arr = array(1,'a' => 'b');
$obj = new demo();
*/
// 创建本地变量主要分两步，创建变量和设置为本地变量
/*
变量的类型有多种，在创建变量的方式也有所不同。 对于简单的数据类型，创建变量很简单。只需调用相应的宏方法就可以。 这些方法在Zend/zendtypes.h文件中，宏方法以ZVAL开头。
ZVAL_NULL 设置为null
ZVAL_FALSE 设置为false。
ZVAL_TRUE 设置为true
ZVAL_BOOL 设置bool。
ZVAL_LONG 设置long。
ZVAL_DOUBLE 设置为double。
*/
/*
设置本地变量Zend引擎为我们提供了两个方法。两个函数的使用，都在以上的代码中做了演示。这两个方法的应用场景有所差别。
zend_set_local_var 如果已经存在类型为zend_string的变量名，则使用这个方法创建本地变量
zend_set_local_var_str 如果没有类型为zend_string的变量名，使用此方法创建本地变量
*/
PHP_FUNCTION(define_var)
{
    //$lng = 2;
    zval var_value;  //变量的值
    zend_string *var_name =  NULL; //变量名称//创建整型变量
    ZVAL_LONG(&var_value, 2);
    //zend_set_local_var_str(const char *name, size_t len, zval *value, int force)
    zend_set_local_var_str("lng", 3, &var_value, 0);  //设置本地变量
    ZVAL_NULL(&var_value);

    //创建字符串变量
    //$str = "abc";
    zend_string *str = NULL;
    char content[4] = "abc";
    var_name = zend_string_init("str", 3, 0); //设置变量名称
    str = zend_string_init(content, sizeof(content)-1, 0);
    ZVAL_STR(&var_value, str); //设置变量的值
    zend_set_local_var(var_name, &var_value, 0); //设置本地变量
    zend_string_release(var_name);
    ZVAL_NULL(&var_value);

    //创建数组变量
    //$arr = array(1,'a' => 'b');
    var_name = zend_string_init("arr", 3, 0); //设置变量名称
    array_init(&var_value);
    add_index_long(&var_value, 0, 1);
    add_assoc_stringl_ex(&var_value, "a", 1, "b", 1);
    zend_set_local_var(var_name, &var_value, 0); //设置本地变量
    zend_string_release(var_name);
    ZVAL_NULL(&var_value);

    //创建对象变量
    //$obj = new demo();
    zend_class_entry *ce;
    zend_string *class_name;
    class_name = zend_string_init("demo", 4, 0);
    ce = zend_fetch_class(class_name, ZEND_FETCH_CLASS_AUTO); //获取类
    zend_string_release(class_name);
    object_init_ex(&var_value, ce);
    zend_set_local_var_str("obj", 3, &var_value, 0); //设置本地变量
    ZVAL_NULL(&var_value);
}

//扩展中定义常量
//增加两个方法
//释放hash
static void say_hash_destroy(HashTable *ht)
{
    zend_string *key;
    zval *element;
    if (((ht)->u.flags & HASH_FLAG_INITIALIZED)) {
        ZEND_HASH_FOREACH_STR_KEY_VAL(ht, key, element) {
            if (key) {
              free(key);
            }
            switch(Z_TYPE_P(element)) {
              case IS_STRING:
                  free(Z_PTR_P(element));
                  break;
              case IS_ARRAY:
                  say_hash_destroy(Z_ARRVAL_P(element));
                  break;
            }
        } ZEND_HASH_FOREACH_END();
        free(HT_GET_DATA_ADDR(ht));
    }
    free(ht);
}

//释放数组和字符串
static void say_entry_dtor_persistent(zval *zvalue)
{
    if(Z_TYPE_P(zvalue) == IS_ARRAY) {
        say_hash_destroy(Z_ARRVAL_P(zvalue));
    } else if (Z_TYPE_P(zvalue) == IS_STRING) {
        zend_string_release(Z_STR_P(zvalue));
    }
}


PHP_FUNCTION(show_ini)
{
    zval arr;
    array_init(&arr);
    add_assoc_long_ex(&arr, "say.number", 10, SAY_G(global_number));
    add_assoc_string_ex(&arr, "say.string", 10, SAY_G(global_string));
    add_assoc_bool_ex(&arr, "say.boolean", 11, SAY_G(global_boolean));
    RETURN_ZVAL(&arr, 0, 1);
}


/**
call_user_function_ex方法用于调用函数和方法。参数说明如下：
第一个参数：方法表。通常情况下，写 EG(function_table) 更多信息点击查看 http://www.bo56.com/php7%E6%BA%90%E7%A0%81%E5%88%86%E6%9E%90%E4%B9%8Bcg%E5%92%8Ceg/
第二个参数：对象。如果不是调用对象的方法，而是调用函数，填写NULL
第三个参数：方法名。
第四个参数：返回值。
第五个参数：参数个数。
第六个参数：参数值。是一个zval数组。
第七个参数：参数是否进行分离操作。详细的，可以看下鸟哥的这篇文章。点击查看:http://www.laruence.com/2008/09/19/520.html
第八个参数：符号表。一般情况写设置为NULL即可。
*/
PHP_FUNCTION(call_function)
{
    zval *obj = NULL;
    zval *fun = NULL;
    zval *param = NULL;
    zval retval;
    zval args[1];

#ifndef FAST_ZPP
      if (zend_parse_parameters(ZEND_NUM_ARGS(), "zzz", &obj, &fun, &param) == FAILURE) {
          return;
      }
#else
      ZEND_PARSE_PARAMETERS_START(3, 3)
          Z_PARAM_ZVAL(obj)
          Z_PARAM_ZVAL(fun)
          Z_PARAM_ZVAL(param)
      ZEND_PARSE_PARAMETERS_END();
#endif

      args[0] = *param;
      if (obj == NULL || Z_TYPE_P(obj) == IS_NULL) {
          call_user_function_ex(EG(function_table), NULL, fun, &retval, 1, args, 0, NULL);
      } else {
          call_user_function_ex(EG(function_table), obj, fun, &retval, 1, args, 0, NULL);
      }
      RETURN_ZVAL(&retval, 0, 1);
}


/**
php_stat函数是PHP中is_dir函数在实现的时候，使用的一个函数。具体代码参见ext/standard/filestat.c文件的FileFunction宏方法。
在1092行附近。这个函数是判断一个路径的状态。如，是否是文件夹等。一般在扩展实现的时候，不建议使用。这里只是为了演示，才使用的。
zend_stat宏方法。也是实现判断一个路径的状态。推荐在扩展中使用。如果调用有问题，会返回-1。
PHP把一些IO操作都封装成了流操作。这些流操作都声明在main/php_streams.h文件中。下面我们说下，我们用到的流操作函数。
*/



void list_dir(const char *dir);

PHP_FUNCTION(list_dir)
{
    char *dir;
    size_t dir_len;

#ifdef FAST_ZPP
    if (zend_parse_parameters(ZEND_NUM_ARGS(), "s", &dir, &dir_len) == FAILURE) {
        return;
    }
#else
    ZEND_PARSE_PARAMETERS_START(1, 1)
    Z_PARAM_PATH(dir, dir_len)
    ZEND_PARSE_PARAMETERS_END();
#endif

    php_stat(dir, (php_stat_len) dir_len, FS_IS_DIR, return_value);

    if (Z_TYPE_P(return_value) == IS_FALSE) {
        RETURN_NULL();
    }

    list_dir(dir);

    RETURN_NULL();
}

void list_dir(const char *dir)
{
    php_stream *stream;
    int options = REPORT_ERRORS;
    php_stream_dirent entry;
    int path_len;
    char path[MAXPATHLEN];
    zend_stat_t st;

    /**
    php_stream_opendir函数是用于打开一个目录。
    第一个参数：路径
    第二个参数：选项。控制一些函数调用行为。定义在main/php_streams.h中。
    多个选项可以使用异或操作。如 int options = IGNORE_PATH | REPORT_ERRORS;
    */
    stream = php_stream_opendir(dir, options, NULL);
    if (!stream) {
        return;
    }

    /**
    php_stream_readdir读取目录流。
    第一个参数：上面函数打开的stream流
    第二个参数：php_stream_dirent 用于存储当前读取的信息。
    */
    while(php_stream_readdir(stream, &entry)) {
        if ((path_len = snprintf(path, sizeof(path), "%s/%s", dir, entry.d_name)) < 0) {
            break;
        }
        if (zend_stat(path, &st) != -1 && S_ISDIR(st.st_mode) && strcmp(entry.d_name, ".") != 0 && strcmp(entry.d_name, "..") != 0) {
            list_dir(path);
        } else if (strcmp(entry.d_name, ".") != 0 && strcmp(entry.d_name, "..") != 0) {
            PUTS(path);
            PUTS("\n");
        }
    }
    /*php_stream_closedir关闭目录流。参数是之前打开的流。*/
    php_stream_closedir(stream);
}

/* {{{ php_say_init_globals
 */
/* Uncomment this function if you have INI entries
static void php_say_init_globals(zend_say_globals *say_globals)
{
	say_globals->global_value = 0;
	say_globals->global_string = NULL;
}
*/
/* }}} */

/* {{{ PHP_MINIT_FUNCTION
 */
////PHP_MINIT_FUNCTION(say)方法的PHP扩展源码： 扩展初始化的调用此方法
PHP_MINIT_FUNCTION(say)
{
    //宏方法REGISTER_INI_ENTRIES();是用于加载配置文件的
    REGISTER_INI_ENTRIES();

    /*实现：
        define("__ARR__", array('2', 'site'=>"www.bo56.com"));  
        define("__SITE__", "www.bo56.com", true);
        define("say\__SITE__", "信海龙的博客");
    */
    zend_constant c;
    zend_string *key;
    zval value;

    //定义了一个ARR常量。 ZVAL_NEW_PERSISTENT_ARR(&c.value);我们想让ARR为持久的。所以使用ZVAL_NEW_PERSISTENT_ARR创建一个数组。
    ZVAL_NEW_PERSISTENT_ARR(&c.value);
    //初始化的代码就是。参数中的say_entry_dtor_persistent是一个析构函数，用于释放数组的元素。
    zend_hash_init(Z_ARRVAL(c.value), 0 /* initial hash size */, NULL /* hash_func */, (dtor_func_t)say_entry_dtor_persistent /* dtor */, 1/* pers */);
    add_index_long(&c.value, 0, 2);
    key = zend_string_init("site", 4, 1);
    ZVAL_STR(&value, zend_string_init("www.taobao.com", 14, 1));
    zend_hash_update(Z_ARRVAL(c.value), key, &value);
    c.flags = CONST_CS|CONST_PERSISTENT;
    c.name = zend_string_init("__ARR__", 7, 1);
    c.module_number = module_number;
    zend_register_constant(&c);

    // CONST_PERSISTENT 表示为持久的,常驻内存。 CONST_CS 表示为区分大小写。
    REGISTER_STRINGL_CONSTANT("__SITE__", "www.taobao.com", 14, CONST_PERSISTENT);
    REGISTER_NS_STRINGL_CONSTANT("say", "__SITE__", "好好学习", 12, CONST_CS|CONST_PERSISTENT);
}


/* }}} */

/* {{{ PHP_MSHUTDOWN_FUNCTION
 */
//扩展卸载的时候调用此方法
PHP_MSHUTDOWN_FUNCTION(say)
{
	 zval *val;
   val = zend_get_constant_str("__ARR__", 7);
   say_hash_destroy(Z_ARRVAL_P(val));
   ZVAL_NULL(val);

   //销毁配置项 这一步主要是为了在PHP进程结束时，释放配置项占用的资源。 销毁配置项是通过宏方法UNREGISTER_INI_ENTRIES()来实现的。这个方法默认在PHP_MSHUTDOWN_FUNCTION方法中。
   UNREGISTER_INI_ENTRIES();

   return SUCCESS;
}
/* }}} */

/* Remove if there's nothing to do at request start */
/* {{{ PHP_RINIT_FUNCTION
 */
PHP_RINIT_FUNCTION(say)
{
#if defined(COMPILE_DL_SAY) && defined(ZTS)
	ZEND_TSRMLS_CACHE_UPDATE();
#endif
	return SUCCESS;
}
/* }}} */

/* Remove if there's nothing to do at request end */
/* {{{ PHP_RSHUTDOWN_FUNCTION
 */
PHP_RSHUTDOWN_FUNCTION(say)
{
	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION
 */
PHP_MINFO_FUNCTION(say)
{
	php_info_print_table_start();
	php_info_print_table_header(2, "say support", "enabled");
	php_info_print_table_end();

	/* Remove comments if you have entries in php.ini
	DISPLAY_INI_ENTRIES();
	*/
}
/* }}} */

/* {{{ say_functions[]
 *
 * Every user visible function must have an entry in say_functions[].
 */
const zend_function_entry say_functions[] = {
	PHP_FE(confirm_say_compiled,	NULL)		/* For testing, remove later. */
	PHP_FE(say,	NULL)		/* hello world */
	PHP_FE(default_value,  NULL)		/* default_value */
  PHP_FE(get_size, NULL)    /*get_size*/
  PHP_FE(str_concat, NULL)  /*str_concat*/
  PHP_FE(array_concat, NULL) /*array_concat*/
  PHP_FE(define_var, NULL) /*define_var*/
  PHP_FE(show_ini, NULL) /*show_ini*/
  PHP_FE(call_function, NULL) /*call_function*/
  PHP_FE(list_dir, NULL) /*list_dir*/
	PHP_FE_END	/* Must be the last line in say_functions[] */
};
/* }}} */

/* {{{ say_module_entry
 */
zend_module_entry say_module_entry = {
	STANDARD_MODULE_HEADER,
	"say",
	say_functions,
	PHP_MINIT(say),
	PHP_MSHUTDOWN(say),
	PHP_RINIT(say),		/* Replace with NULL if there's nothing to do at request start */
	PHP_RSHUTDOWN(say),	/* Replace with NULL if there's nothing to do at request end */
	PHP_MINFO(say),
	PHP_SAY_VERSION,
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_SAY
#ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
#endif
ZEND_GET_MODULE(say)
#endif

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
