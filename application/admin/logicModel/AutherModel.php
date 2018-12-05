<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/30
 * Time: 9:18
 * Auther sl
 */

namespace app\admin\logicModel;


use app\common\model\MyLog;
use think\Model;
use think\Exception;
use app\common\model\MyException;
use app\admin\model\User;
class AutherModel extends Model
{
    const TYPE = ['User','UserGroup','Auther','getAuther','getUser'];

    /**
     * 添加操作入口
     * @param $data
     * @param string $type
     * @auther sl
     * @return array
     */
    public function myAdd($data,$type='')
    {
        // TODO: Implement myAdd() method.
        try {
            if (empty($data)) {
               throw new MyException('无数据');
            }
            if (!in_array($type,self::TYPE)){
                throw new Exception('type 不对');
            }
            switch ($type){
                case 'User':
                    $re =  $this->addUser($data);
                    break;
            }
            if ($re===false){
                throw new  MyException('操作失败');
            }
            return format_data([],$re,true,false);
        } catch (MyException $e) {
            MyLog::write($e->getMessage());
            return  format_data([],$e->getMessage(),true,false);
        }catch (Exception $e) {
            MyLog::write($e->getMessage(),3);
          return  format_data([],$e->getMessage(),false,false);
        }
    }
    public function myEdit($data)
    {
        // TODO: Implement myEdit() method.
    }
    public function myGetList($type,$uid='')
    {

        try {
            if (!in_array($type,self::TYPE)){
                throw new Exception('type 不对');
            }
            switch ($type){
                case 'getAuther':
                    $re =  $this->getAutherList($uid);
                    break;
                default:
                    $re=['asdfasdf'];
                    break;
            }
            dump($re);
            if ($re===false){
                throw new  MyException('操作失败');
            }
            return format_data([],$re,true,false);
        } catch (MyException $e) {
            MyLog::write($e->getMessage());
            return  format_data([],$e->getMessage(),true,false);
        }catch (Exception $e) {
            MyLog::write($e->getMessage(),3);
            return  format_data([],$e->getMessage(),false,false);
        }

        // TODO: Implement myGetList() method.
    }
    public function myDelete($id)
    {
        // TODO: Implement myDelete() method.
    }


   private function addUser($data){

       try {
           $user = new User;
           $user->data($data);
        $re =   $user->save();
        return $re ;
       }catch (MyException $e) {
           MyLog::write($e->getMessage());
           return  false;
       }catch (Exception $e) {
           MyLog::write($e->getMessage(),3);
           return false;
       }
   }

   private function getAutherList($uid){

       try {
           $user = new User;
         //  $re =  $user->where($where)->select();
      //  return $re ;
       }catch (MyException $e) {
           MyLog::write($e->getMessage());
           return  false;
       }catch (Exception $e) {
           MyLog::write($e->getMessage(),3);
           return false;
       }
   }







}