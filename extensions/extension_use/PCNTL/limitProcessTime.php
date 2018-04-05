<?php
/**
 * Created by PhpStorm.
 * User: viruser
 * Date: 2017/2/8
 * Time: 12:27
 */
declare(ticks=1);


function setMaxExecuteTime($second, $timeout_func = null, $begin=0)
{
    $pid = pcntl_fork();
    if ($pid == -1)
    {
        exit;
    }
    if ($pid > 0) //父进程
    {
        echo PHP_EOL.' father '. posix_getpid().' child '. $pid. PHP_EOL;
        pcntl_signal(SIGALRM, "handleSignal");
        pcntl_signal(SIGTERM, "handleSignal");
        pcntl_alarm($second);
        $status = 0;
        echo PHP_EOL." this is father pid ".posix_getpid().", and begin father sleep, run child:".PHP_EOL;
        //pcntl_waitpid()返回退出的子进程进程号，发生错误时返回-1,如果提供了 WNOHANG作为option（wait3可用的系统）并且没有可用子进程时返回0。进程退出返回0
        $ret = pcntl_waitpid($pid, $status); //pcntl_waitpid挂起当前进程的执行直到参数pid指定的进程号的进程退出， 或接收到一个信号要求中断当前进程或调用一个信号处理函数。
        echo PHP_EOL." 父进程由于SIGALRM醒来，当前进程:".posix_getpid()."，获取到的子进程{$pid}的状态是:".$status.'，pcntl_waitpid返回:'.$ret.PHP_EOL;
        if ($ret == -1)
        {
            posix_kill($pid, SIGTERM);
            $ret = pcntl_waitpid($pid, $status);
            echo PHP_EOL." 当前进程:".posix_getpid()."， 子进程 {$pid} 状态".$status.'，pcntl_waitpid返回:'.$ret.PHP_EOL;
            if (!is_null($timeout_func))
            {
                $timeout_func($begin);
            }
        }
        exit;
    }
}

/**
 * 信号处理器
 *
 * @param int $signo
 * @return void
 * @author gx
 */
function handleSignal($signo)
{
    echo PHP_EOL."handleSignal in pid ".posix_getpid().PHP_EOL;
    switch ($signo) {
        case SIGTERM:
            echo "Caught SIGTERM...\n";
            exit;
            break;
        case SIGHUP:
            echo "Caught SIGHUP...\n";
            break;
        case SIGUSR1:
            echo "Caught SIGUSR1...\n";
            break;
        case SIGALRM:
            echo "Caught SIGALRM...\n";
            break;
        default:
            // 处理所有其他信号
            echo "Caught $signo...\n";
            break;
    }


}

function hello($begin)
{
    echo PHP_EOL.'use time '.(time()-$begin).PHP_EOL;
    echo PHP_EOL."stop".PHP_EOL;
}

echo "test in ".posix_getpid().PHP_EOL;
$begin = time();
setMaxExecuteTime(10, 'hello', $begin);
//子进程会执行以下代码
pcntl_signal(SIGTERM, "handleSignal"); //设置子进程signal
for($i=1;$i<=100;$i++){

    echo "do $i in ".posix_getpid().PHP_EOL;
    sleep(1);
}
