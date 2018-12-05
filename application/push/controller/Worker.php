<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/14
 * Time: 17:47
 * Auther sl
 */

namespace app\push\controller;

use GatewayWorker\Gateway;


use think\worker\Server;
use Workerman\Lib\Timer;
class Worker extends Server
{
    protected $socket = 'websocket://127.0.0.1:2346';

    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        $connection->send('我收到你的信息了'.json_encode($data));
          //定时推送
        $timer_id = Timer::add(1, function()use($connection, $data,&$timer_id)
        {
            $connection->send('timer_id='.$timer_id);
        });
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {

    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {

    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }
}
