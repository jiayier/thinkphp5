<?php

namespace app\index\controller;

use app\common\model\Excel;
use app\index\logicModel\PdfWeb;
use app\common\model\MyAes;
use app\index\logicModel\ExcelWeb;
use think\Controller;
use think\Cache;
use think\Request;
use app\common\model\SendSms;

class Index extends Controller
{
    use MyAes;
    /**
     * 首页展示
     * @auther sl
     * @return mixed
     */
    public function index(Request $request)
    {
        /***************************************  导入  ********************************************/

        $re = new PdfWeb();
        $re->pdfOut();
        /***************************************  导入  ********************************************/

        /***************************************  导入  ********************************************/
//        $path = ROOT_PATH.'public\upload'.DS.'test.xls';
//        $Aes =  new ExcelWeb();
//        $re = $Aes->import($path);
        /***************************************  导入  ********************************************/
        /***************************************  导入  ********************************************/

        //$Aes->export([],[],'asdfasdf');//导出
        // dump($re);
        //  dump($Aes->decode($re));
        /********************************************************************************************/

        /***************************************  发短信  ********************************************/
//        $Sms = new SendSms();
//        $kk = $Sms->sendSms('15332371148','{"code":"123456","product":"微猴科技"}');
//        dump($kk);
        /********************************************************************************************/

        /***************************************  国际化  ********************************************/
//        $lang = cookie('think_var'); //语言
//        $this->assign('title', getTitle());//标题
//        $this->assign('lang', $lang);
//        $this->assign('info', getInfo($request));
//        return $this->fetch('index');
//        return $this->fetch('index/test');
        /********************************************************************************************/

    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }


    /**
     * aes 加密
     * @param Request $request
     * @auther sl
     * @return \think\response\Json
     */
    public function test(Request $request)
    {
        $Aes = new self();
        $json = $request->param('json');
        $str = $request->param('str');
        $str_decode = $Aes->decode($str, 'string');
        $jsondecode = $Aes->decode($json);
        $pp = $Aes->encode(json_encode(['asdf' => 'asdfasdfasdf']));
        return json([
            'param' => $request->param(),
            'json_decode' => json_decode($jsondecode, true),
            'str_decode' => $str_decode,
            'str' => $str,
            'pp' => $pp,
            'json' => $json
        ]);
    }
}
