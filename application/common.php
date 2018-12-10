<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


if (!function_exists('is_moble')) {
    function is_moble()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
            return true;
        //此条摘自TPM智能切换模板引擎，适合TPM开发
        if (isset ($_SERVER['HTTP_CLIENT']) && 'PhoneClient' == $_SERVER['HTTP_CLIENT'])
            return true;
        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
            //找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
        //判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile'
            );
            //从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        //协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
    //    define('APP_DEBUG',True);
}


if (!function_exists('format_data')) {
    function format_data($data, $msg = '', $is_success = false, $is_data = true)
    {
        $arr = [];
        if (empty($is_success)) {
            $arr['code'] = 0;
        } else {
            $arr['code'] = 1;
        }
        $arr['msg'] = $msg;
        if ($is_data) {
            $arr['data'] = $data;
        }
        return $arr;
    }
}
if (!function_exists('auther')) {

    function auther($data = [], $uid = '')
    {
        $controllers = explode('.', $data[0]);
        $controller = empty($controllers) ? '' : count($controllers) == 2 ? $controllers[1] : $controllers[0];
        $action = $data[1];
        $rule = $controller . '-' . $action;
        // 1，是对规则进行认证，不是对节点进行认证。用户可以把节点当作规则名称实现对节点进行认证。
        $auth = new app\common\model\Auther();
        $re = $auth->check($rule, 1, 1, 'myurl');
        return $re;
//2，可以同时对多条规则进行认证，并设置多条规则的关系（or或者and）
//第三个参数为and时表示，用户需要同时具有规则1和规则2的权限。 当第三个参数为or时，表示用户值需要具备其中一个条件即可。默认为or
//3，一个用户可以属于多个用户组(think_auth_group_access表 定义了用户所属用户组)。我们需要设置每个用户组拥有哪些规则(think_auth_group 定义了用户组权限)
//4，支持规则表达式。
//在think_auth_rule 表中定义一条规则时，如果type为1， condition字段就可以定义规则表达式。 如定义{score}>5 and {score}<100 表示用户的分数在5-100之间时这条规则才会通过。

        //return $arr;
    }
}

if (!function_exists('getTitle')) {

    function getTitle()
    {
      return '自定义标题'.rand();
    }
}


if (!function_exists('getInfo')) {

    function getInfo()
    {
      return [
          'acid'=>'acid',
          'openid'=>'openid',
          'uid'=>'uid',
          'siteroot'=>'siteroot',
          'siteurl'=>'siteurl',
          'attachurl'=>'attachurl',
          'uniacid'=>'uniacid',
          'attachurl_local'=>'attachurl_local',
          'attachurl_remote'=>'attachurl_remote',
          'cookie'=>'cookie',
          'account'=>'account',
      ];
    }
}


if (!function_exists('is_phone')) {

    function is_phone($phone)
    {
      return preg_match("/^1[34578]\d{9}$/", $phone);
    }
}


if (!function_exists('getFileFix')) {
    /**
     * 获取文件的后缀
     * @param $file
     * @auther sl
     * @return bool|string
     */
    function getFileFix($file)
    {
      return  strrpos($file, '.') ? substr($file, strrpos($file, '.')+1) : '';//后缀;
    }
}


if (!function_exists('fomartError')) {
    /**
     * 获取文件的后缀
     * @param $file
     * @auther sl
     * @return bool|string
     */
    function fomartError($e)
    {
      return sprintf('ErrorFile:%s;<br>ErrorLine:%s;<br>Error:%s',$e->getFile(),$e->getLine(),$e->getMessage());//后缀;
    }
}