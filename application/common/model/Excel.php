<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5
 * Time: 10:29
 * Auther sl
 */

namespace app\common\model;

use think\Exception;
use app\common\model\MyException;
use PHPExcel_IOFactory;
use PHPExcel;


/**
 * composer 库
 * Class Excel
 * @auther sl
 * @package app\common\model
 */
class Excel
{
    const HORIZONTAL_GENERAL = 'general';
    const HORIZONTAL_LEFT = 'left';
    const HORIZONTAL_RIGHT = 'right';
    const HORIZONTAL_CENTER = 'center';
    public $types = ['xls','xlsx'];

    static  protected  $Phpexcel = '';

    public function import($path)
    {
        try {
            $objPHPExcel = \PHPExcel_IOFactory::load($path);
            $sheet = $objPHPExcel->getSheet(0);//获取行数与列数,注意列数需要转换
            $highestRowNum = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $highestColumnNum = \PHPExcel_Cell::columnIndexFromString($highestColumn);
            $usefullColumnNum = $highestColumnNum;//取得字段，这里测试表格中的第一行为数据的字段，因此先取出用来作后面数组的键名
            $filed = array();
            for ($i = 0; $i < $highestColumnNum; $i++) {
                $cellName = \PHPExcel_Cell::stringFromColumnIndex($i) . '1';
                $cellVal = $sheet->getCell($cellName)->getValue();//取得列内容

                if (!$cellVal) {
                    break;
                }
                $usefullColumnNum = $i;
                $filed [] = $cellVal;
            }//开始取出数据并存入数组
            $data = [];
            $tmp = [];
            $variety = [];
            $dataStr = '';
            for ($i = 2; $i <= $highestRowNum; $i++) {//ignore row 1
                // for( $i=2; $i <= $highestRowNum ;$i++ ){//ignore row 1
                $row = array();
                $sqlStr = [];
                $tmp_row = array();
                for ($j = 0; $j <= $usefullColumnNum; $j++) {

                    $cellName = \PHPExcel_Cell::stringFromColumnIndex($j) . $i;

                    $cell = $sheet->getCell($cellName);
                    $cellVal = $sheet->getCell($cellName)->getValue();
                    if ($cellVal instanceof \PHPExcel_RichText) { //富文本转换字符串
                        $cellVal = $cellVal->__toString();
                    }

                    if ($cell->getDataType() == \PHPExcel_Cell_DataType::TYPE_NUMERIC) {
                        $cellstyleformat = $cell->getStyle($cell->getCoordinate())->getNumberFormat();
                        // $cellstyleformat = $cell->getParent()->getStyle( $cell->getCoordinate() )->getNumberFormat();
                        $formatcode = $cellstyleformat->getFormatCode();
                        if (preg_match('/^($[A−Z]∗−[0−9A−F]∗)*[hmsdy]/i', $formatcode)) {
                            $cellVal = gmdate("Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($cellVal));
                            if ($cellVal) {
                                $cellVal = strtotime($cellVal);
                            }
                        } else {
                            $cellVal = \PHPExcel_Style_NumberFormat::toFormattedString($cellVal, $formatcode);
                        }
                    }

                    $row[] = trim($cellVal);
                }
                if (!$row[0]) {
                    // 首行序号 不存在则认为结束
                    break;
                }
                $data[$i - 2] = $row;
            }
            return $data;
        } catch (\Exception $e) {
            MyLog::write('excelImport:'.$e->getMessage(),3);
            return false;
        }
    }

    public function export($data, $obj,$name,$type='xls')
    {
        try {
            $objPHPExcel = $obj->dataFormat($data);
            if ($type == 'xls') {
                ob_end_clean();//这一步非常关键，用来清除缓冲区防止导出的excel乱码
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="' . $name . date('Ymd-His') . ').xls"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
            } elseif ($type == 'xlsx') {
                ob_end_clean();//这一步非常关键，用来清除缓冲区防止导出的excel乱码
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="' . $name . date('Ymd-His') . ').xlsx"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
            }
        } catch (\Exception $e) {
            MyLog::write('excelImport:'.$e->getMessage(),3);
            return false;
        }
    }
    public static function  getPHPExcel(){
        return self::createPhpExcel();
    }
    private static function createPhpExcel(){
        if (!self::$Phpexcel) self::$Phpexcel = new PHPExcel();
        return self::$Phpexcel;
    }

}