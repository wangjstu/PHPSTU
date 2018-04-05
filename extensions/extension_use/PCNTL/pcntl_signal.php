<?php
/**
 * User: wangjstu
 * Date: 2017/2/11 15:25
 */
//使用ticks需要PHP 4.3.0以上版本
//declare(ticks = 1); //用pcntl_signal_dispatch()性能会好些


function selfSignalHandle($signo)
{
    echo "pid " . posix_getpid() . " caught signal ".$signo . PHP_EOL;
    switch ($signo) {
        case SIGTERM: // SIGTERM信号
            exit;
            break;
        case SIGHUP: //SIGHUP信号
            break;
        case SIGUSR1: //SIGUSR1信号
            break;
        default:
            echo "Other";
    }
}


pcntl_signal(SIGTERM, "selfSignalHandle");
pcntl_signal(SIGHUP, "selfSignalHandle");
pcntl_signal(SIGUSR1, "selfSignalHandle");
pcntl_signal(SIGTERM, "selfSignalHandle");

//向当前进程发送SIGUSR1信号
posix_kill(posix_getpid(), SIGUSR1);
pcntl_signal_dispatch(); //declare(ticks = 1);后就不用设置这个
//sleep(10);