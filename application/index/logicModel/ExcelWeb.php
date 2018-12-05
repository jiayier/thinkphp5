<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5
 * Time: 10:59
 * Auther sl
 */

namespace app\index\logicModel;
use app\common\model\Excel1;
use app\common\model\Excel;
use app\common\model\ExcelMy;
class ExcelWeb extends Excel  implements ExcelMy
{
    /**
     * 处理表格内容和样式
     * @param $data
     * @param $obj
     * @auther sl
     * @return mixed
     */
    public function dataFormat($data,$obj)
    {

        $obj->getProperties()->setCreator("ctos")
            ->setLastModifiedBy("ctos")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

//set width  
        $obj->getActiveSheet()->getColumnDimension('A')->setWidth(8);
        $obj->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $obj->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $obj->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $obj->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $obj->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $obj->getActiveSheet()->getColumnDimension('G')->setWidth(12);
        $obj->getActiveSheet()->getColumnDimension('H')->setWidth(12);
        $obj->getActiveSheet()->getColumnDimension('I')->setWidth(12);
        $obj->getActiveSheet()->getColumnDimension('J')->setWidth(30);

//设置行高度  
        $obj->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

        $obj->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

//set font size bold  
        $obj->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
        $obj->getActiveSheet()->getStyle('A2:J2')->getFont()->setBold(true);

//        $obj->getActiveSheet()->getStyle('A2:J2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//        $obj->getActiveSheet()->getStyle('A2:J2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
//
////设置水平居中
        $obj->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(self::HORIZONTAL_CENTER);
        $obj->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(self::HORIZONTAL_CENTER);
        $obj->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(self::HORIZONTAL_CENTER);
        $obj->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(self::HORIZONTAL_CENTER);
        $obj->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(self::HORIZONTAL_CENTER);
        $obj->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(self::HORIZONTAL_CENTER);
        $obj->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(self::HORIZONTAL_CENTER);
        $obj->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(self::HORIZONTAL_CENTER);
//  
        $obj->getActiveSheet()->mergeCells('A1:J1');

// set table header content  
        $obj->setActiveSheetIndex(0)
            ->setCellValue('A1', '订单数据汇总  时间:' . date('Y-m-d H:i:s'))
            ->setCellValue('A2', '订单ID')
            ->setCellValue('B2', '下单人')
            ->setCellValue('C2', '客户名称')
            ->setCellValue('D2', '下单时间')
            ->setCellValue('E2', '需求机型')
            ->setCellValue('F2', '需求数量')
            ->setCellValue('G2', '需求交期')
            ->setCellValue('H2', '确认BOM料号')
            ->setCellValue('I2', 'PMC确认交期')
            ->setCellValue('J2', 'PMC交货备注');

// Miscellaneous glyphs, UTF-8  

        for ($i = 0; $i < count($data) - 1; $i++) {
            $obj->getActiveSheet(0)->setCellValue('A' . ($i + 3),1);
            $obj->getActiveSheet(0)->setCellValue('B' . ($i + 3),2);
//            $obj->getActiveSheet(0)->setCellValue('C' . ($i + 3), $result[$i]['customer_name']);
//            $obj->getActiveSheet(0)->setCellValue('D' . ($i + 3), $OrdersData[$i]['create_time']);
//            $obj->getActiveSheet(0)->setCellValue('E' . ($i + 3), $result[$i]['require_product']);
//            $obj->getActiveSheet(0)->setCellValue('F' . ($i + 3), $result[$i]['require_count']);
//            $obj->getActiveSheet(0)->setCellValue('G' . ($i + 3), $result[$i]['require_time']);
//            $obj->getActiveSheet(0)->setCellValue('H' . ($i + 3), $result[$i]['product_bom_encoding']);
//            $obj->getActiveSheet(0)->setCellValue('I' . ($i + 3), $result[$i]['delivery_time']);
//            $obj->getActiveSheet(0)->setCellValue('J' . ($i + 3), $result[$i]['delivery_memo']);
//            $obj->getActiveSheet()->getStyle('A' . ($i + 3) . ':J' . ($i + 3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//            $obj->getActiveSheet()->getStyle('A' . ($i + 3) . ':J' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
//            $obj->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(16);
        }
// Rename sheet  
        $obj->getActiveSheet()->setTitle('订单汇总表');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet  
        $obj->setActiveSheetIndex(0);
        return $obj;
       // echo  'dataFormat';
        // TODO: Implement dataFormat() method.
    }
    /**
     * excel 导入 得到内容的数组
     * @param $path
     * @auther sl
     * @return array|bool
     */
    public function import($path)
    {
        if (!file_exists($path)){
            echo  $path;
            return false;
        }
        if (!in_array(getFileFix($path),$this->types)){
            echo  getFileFix($path);
            return false;
        }
        return   parent::import($path); // TODO: Change the autogenerated stub
    }
    public function export($data,$obj='',$name,$type='xlsx')
    {
        if (!is_string($name)){
            return false;
        }
        if (!is_array($data)){
            return false;
        }
        if (!in_array($type,$this->types)){
            return false;
        }
        parent::export($data,new self(),$name,$type); // TODO: Change the autogenerated stub
    }
    /**
     * excel csv 导出
     * @param array $list
     * @param string $title
     * @param array $field
     * @param string $fileName
     * @auther sl
     */
    public function put_csv($list=[], $title='', $field=[], $fileName='')
    {

        parent::put_csv($list, $title, $field, $fileName); // TODO: Change the autogenerated stub
    }
    private  function getCsvTitle(){





    }
     private  function getCsvField(){





    }
    private  function getCsvFileName(){





    }
}