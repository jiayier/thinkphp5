<?php

namespace app\index\controller;

use app\common\model\Excel;
use app\index\logicModel\PdfWeb;
use app\common\model\MyAes;
use app\index\logicModel\ExcelWeb;
use think\Controller;
use think\Cache;
use think\Exception;
use think\Request;
use designMode\strategyPattern\Browser;
use designMode\strategyPattern\OtherAgent;
use designMode\factoryPattern\SimpleFactoty;
use designMode\singletonPattern\Single;
use designMode\observerPattern\Event;
use designMode\observerPattern\Observer1;
use designMode\observerPattern\Observer2;
use designMode\registrationPattern\Register;


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

        /***************************************  策略模式（strategy pattern） ********************************************/
//        $browerType = new OtherAgent();//
//        $brower = new Browser();
//        echo $brower->call($browerType);

        /********************************************************************************************/


        /***************************************  静态工厂模式--工厂模式（factory pattern）  ********************************************/
//        $man = SimpleFactoty::createMan();
//        $Women = SimpleFactoty::createWomen();
//
//        echo $man->say() . PHP_EOL . '<br>';
//        echo $Women->say() . PHP_EOL . '<br>';
        /********************************************************************************************/
        /***************************************  单例模式（ singleton pattern）  ********************************************/
//        $og = Single::getinstance();
//        $ob = Single::getinstance();
//        $og->setname('hello world');
//        $ob->setname('good morning');
//        echo $og->getname() . PHP_EOL . '<br>';//good morning
//        echo $ob->getname() . PHP_EOL . '<br>';//good morning
        /********************************************************************************************/
        /***************************************  注册模式（Registration  pattern）  ********************************************/
//        $re = new Register();//全局
//        $re::set('sss', $man);
//        dump($re::get('sss')->say());
//        $re = new Register();
//        dump($re::get('sss')->say());

        /********************************************************************************************/
        /***************************************  适配器模式（adapter pattern）  ********************************************/
        /***************************************  观察者模式（Observer pattern）  ********************************************/
//        $event = new Event();
//        $event->addObserver(new Observer1());
//        $event->addObserver(new Observer2());
//       $event->triger();
//       $event->notify();
//        $event->last();
        /********************************************************************************************/


        //  echo '<br>asdf';
        /***************************************  导入  ********************************************/

//        $re = new PdfWeb();
//        $re->pdfOut();
        /***************************************  导入  ********************************************/

        /***************************************  导入  ********************************************/
//        $path = ROOT_PATH.'public\upload'.DS.'test.xls';
//        $Aes =  new ExcelWeb();
//        $re = $Aes->import($path);
//        dump($re);
        /***************************************  导入  ********************************************/
        /***************************************  导入  ********************************************/
        $Aes =  new ExcelWeb();

        $Aes->export([],[],'asdfasdf');//导出
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
