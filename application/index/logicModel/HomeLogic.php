<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/14
 * Time: 13:30
 * Auther sl
 */

namespace app\index\logicModel;

use app\admin\logicModel\MyException;
use app\index\model\Article;
use app\index\model\ArticleDetail;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;
use app\common\model\MyLog;

class HomeLogic extends Model
{
    use Dog;
    public function getAll()
    {


        try {
            $Art = new Article();// $ArtDetail = new ArticleDetail();
          //  $re = collection($Art->with('ArticleDetail')->whereNotIn('art_id',[2])->select())->toArray();
            $re = collection($Art->with('ArticleDetail')->whereNotIn('article_id',[2])->select())->toArray();

            return $re;
        } catch (MyException $e) {
            MyLog::write($e->getMessage());
            return false;
        } catch (Exception $e) {
            MyLog::write($e->getMessage(),3);

            return false;

        }


    }


    /**
     * 获取列表
     * @auther sl
     * @return array|bool
     */
    public function getList()
    {
        try {
            $Art = new Article();// $ArtDetail = new ArticleDetail();
            $re = collection($Art->with('ArticleDetail')->select())->toArray();

            return $re;
        } catch (\MyException $e) {
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
    /**
     * 删除（事务）
     * @param string $id
     * @auther sl
     * @return array|bool
     */
    public function deletes($id = '')
    {
        try {
            $Art = new Article();// $ArtDetail = new ArticleDetail();
            $Art->startTrans();     // 开启事务A
            $result = $Art->where(['article_id'=>2])->delete();
            if ($result == 0) {
                $Art->rollBack();//事务A回滚
                throw new MyException('删除A信息失败，请重试');
            }
            $Art1 = new ArticleDetail();// $ArtDetail = new ArticleDetail();
            $Art1->startTrans();     // 开启事务b
            $result = $Art1->where(['art_id' => 1])->delete();
            if ($result==0){
                $Art->rollback();
                throw new MyException('删除b信息失败，请重试');
            }
            $Art->commit();   //提交事务a
            $Art1->commit();  //提交事务b
            return ['success'];

        } catch (MyException $e) {
            MyLog::write($e->getMessage());
            return [];
        } catch (\Exception $e) {
            MyLog::write($e->getMessage(), 3);
            return false;
        }
    }
}