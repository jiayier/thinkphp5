<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/14
 * Time: 17:57
 * Auther sl
 */

namespace app\index\controller\one;
use app\common\model\Post;

use think\Controller;
use think\Exception;
use think\Request;
use app\index\logicModel\WebsockLogic;
use think\Loader;
use think\Db;
use app\common\model\Auther;
class Websock extends Common
{

    protected $beforeActionList = [
       // 'first',
        //'second' =>  ['except'=>'hello'],
        'three'  =>  ['only'=>'hello,data'],
    ];

    public function websock()
    {
        return $this->fetch();
    }
//http://www.weihuo.com/app/index.php?i=3&c=entry&do=Api&m=nonghuotongweihou&r=api.user.sendCode
    public function test()
    {
       $this->assign('title','资源控制器');
        $this->assign('url',url('index/one.websock/test'));
       return $this->fetch();
    }

    public function io(Request $request){

        return json(['ss'=>json_decode($request->param('__input'))[0]]);
    }

    public function home(Request $request)
    {

        $auth = Auther::instance();
       $re =  $auth->getGroups(1);
  //     dump(  $re);
        // 检测权限
        if($auth->check('show_button',1)){// 第一个参数是规则名称,第二个参数是用户UID
            //有显示操作按钮的权限
          //  echo 'fasdfasd';
        }else{
            //没有显示操作按钮的权限
          //  echo 'faaaaasdfasd';

        }
        $data = [
            'name'=>'thisnkphp',
            'email'=>'thinkphprtyuqq.com'
        ];
        $validate = Loader::validate('User');
        if(!$validate->check($data)){
         //   dump($validate->getError());
        }
             $websorck = new WebsockLogic();
           //  dump($websorck->eat());
        $result = $this->validate($data,'User');
        if(true !== $result){
            // 验证失败 输出错误信息
         //   dump($result);
        }
       $this->LogModel->write(['asdfasdf'=>$request->param()]);
       return $this->fetch('index/index');

    }
    protected function first()
    {
        echo 'first<br/>';
    }

    protected function second()
    {
        echo 'second<br/>';
    }

    protected function three()
    {
        echo 'three<br/>';
    }

    public function hello()
    {
        return 'hello';
    }

    public function token(Request $request){

        $re = $this->validate($request->param(),'User');
        return json(['param'=>$request->param(),'validate'=>$re]);
    }

}