<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 14:05
 * Auther sl
 */

namespace app\index\controller\one;

use app\index\controller\one\Common;
use think\Request;
use app\index\logicModel\HomeLogic;
class Home extends Common
{    protected  $model = '';
    function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model = new HomeLogic();

    }


    public function user()
    {
        
    }
    

    /**
     * 首页展示
     * @param Request $request
     * @auther sl
     * @return mixed
     */
    public function index(Request $request)
    {
        $agent = $request->header('user-agent');
       // echo  $agent;
        $this->assign('title','ThinkPHP');
        $this->assign('is_phone',is_moble());
        $this->assign('url', $this->url);


      //  $re = $this->model->deletes();
       // return $this->fetch('index/index');
     return $this->fetch('index');
    }
    public function tan(){






    }



}