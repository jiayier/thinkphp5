<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/14
 * Time: 10:37
 * Auther sl
 */

namespace app\admin\controller;
use app\admin\logicModel\ArticleDetailLogic;

use think\Request;

class ArticleDetail
{
   public $Model = '';

    function __construct()
    {
        $this->Model = new ArticleDetailLogic();
    }
    /**
     * get
     * @auther sl
     * @return \think\response\Json
     */
    public function index()
    {
        return json(['ssadfasdf']);
   }

    /**
     * 获取数据
     * @param $id
     * @auther sl
     * @return \think\response\Json
     */
    public function read($id)
    {
        $re =  $this->Model->getOne($id);
        return json($re);
        //return json(['ssadfasdf'=>$id]);

    }
    /**
     * POST(添加和修改)
     * @param Request $request
     * @auther sl
     * @return \think\response\Json
     */
   public function save(Request $request){
        // $re = $this->Model->saveData($request->post());
       // return json(['ss'=>$request->post(),'sdf'=>$re]);
        return json( $this->Model->saveData($request->post()));
   }
}