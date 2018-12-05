<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 9:04
 * Auther sl
 */

namespace app\index\controller\one;
use app\index\controller\one\Common;
use think\Request;

use app\index\logicModel\HomeLogic;

class Technology extends Common
{
    private $Model = '';
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->Model = new HomeLogic();
    }
    public function index(Request $request){
        $data = $this->Model->getList();
        $this->assign('title','ThinkPHP');
        $this->assign('is_phone',is_moble());
        $this->assign('url', $this->url);
        $this->assign('list',$data);
        return $this->fetch('index');
    }
}