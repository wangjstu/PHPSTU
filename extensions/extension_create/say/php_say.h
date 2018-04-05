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

#ifndef PHP_SAY_H
#define PHP_SAY_H

extern zend_module_entry say_module_entry;
#define phpext_say_ptr &say_module_entry

#define PHP_SAY_VERSION "0.1.0" /* Replace with version number for your extension */

#ifdef PHP_WIN32
#	define PHP_SAY_API __declspec(dllexport)
#elif defined(__GNUC__) && __GNUC__ >= 4
#	define PHP_SAY_API __attribute__ ((visibility("default")))
#else
#	define PHP_SAY_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

/*
  	Declare any global variables you may need between the BEGIN
	and END macros here:
*/
//定义一个全局变量类型，代码在php_say.h文件中
//ZEND_BEGIN_MODULE_GLOBALS() ZEND_END_MODULE_GLOBALS() 用于定义一个全局变量结构体类型
/*
把宏方法展开后的代码如下：
typedef struct _zend_say_globals{
    zend_long  global_number; //数字
    char *global_string; //字符串
    zend_bool global_boolean; //布尔
} zend_say_globals;
*/
ZEND_BEGIN_MODULE_GLOBALS(say)
	zend_long  global_number;
	char *global_string;
  zend_bool global_boolean;
ZEND_END_MODULE_GLOBALS(say)


/* Always refer to the globals in your function as SAY_G(variable).
   You are encouraged to rename these macros something shorter, see
   examples in any other php module directory.
   SAY_G()用于读取全局变量的值。如，SAY_G(global_number)展开后的代码如下：say_globals.global_number
*/
#define SAY_G(v) ZEND_MODULE_GLOBALS_ACCESSOR(say, v)

#if defined(ZTS) && defined(COMPILE_DL_SAY)
ZEND_TSRMLS_CACHE_EXTERN()
#endif

#endif	/* PHP_SAY_H */


/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
