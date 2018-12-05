<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 16:43
 * Auther sl
 */

namespace app\common\model;

/**
 * 自定义打印语柄
 * Interface LogHandle
 * @package app\index\logicModel
 */
interface LogHandle
{

    const FILE_BASE_PATH = ROOT_PATH.'runtime'.DS.'myLog';
    const LEVEL=['NOTICE','INFO','WARNING','ERROR','DEBUG'];//
    public  static function write($data,$lvevl=1);

}



//; E_ALL             所有错误和警告（除E_STRICT外）
//; E_ERROR           致命的错误。脚本的执行被暂停。
//; E_RECOVERABLE_ERROR    大多数的致命错误。
//; E_WARNING         非致命的运行时错误，只是警告，脚本的执行不会停止。
//; E_PARSE            编译时解析错误，解析错误应该只由分析器生成。
//; E_NOTICE          脚本运行时产生的提醒（往往是我们写的脚本里面的一些bug，比如某个变量没有定义），这个错误不会导致任务中断。
//; E_STRICT          脚本运行时产生的提醒信息，会包含一些php抛出的让我们要如何修改的建议信息。
//; E_CORE_ERROR      在php启动后发生的致命性错误
//; E_CORE_WARNING    在php启动后发生的非致命性错误，也就是警告信息
//; E_COMPILE_ERROR    php编译时产生的致命性错误
//; E_COMPILE_WARNING  php编译时产生的警告信息
//; E_USER_ERROR       用户生成的错误
//; E_USER_WARNING    用户生成的警告
//; E_USER_NOTICE      用户生成的提醒