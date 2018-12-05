<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5
 * Time: 16:16
 * Auther sl
 */

namespace app\common\model;
use think\Exception;
use think\Loader;
class Tcpdf
{
    public function import($lan='en',$name='asdfasd',$html='',$filename='asdfasdasdfasdasdfsdfsdfsdfsdf')
    {


        Loader::import('tcpdf.tcpdf');
        $pdf = new \TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);


        try {
            switch ($lan) {
                case 'en':
                    $pdf->SetAuthor('微猴');
                    $pdf->SetTitle($name);
                    $pdf->SetSubject('猪支统计');
                    $pdf->SetKeywords('微猴, 猪支统计, 智慧养殖');
                    //   $pdf->setFont('DejaVuSans');
                    $pdf->setFont('droidsansfallback');
                    break;
                case 'zh-cn':

                    // set document information
                    $pdf->SetAuthor('micro-monkey');
                    $pdf->SetTitle($name);
                    $pdf->SetSubject('statistics_pig');
                    $pdf->SetKeywords('micro-monkey, statistics_pig, Wisdom breeding');
                    // $pdf->setFont('stsongstdlight');
                    $pdf->setFont('droidsansfallback');

                    break;
                default:
                    $pdf->SetAuthor('微猴');
                    $pdf->SetTitle($name);
                    $pdf->SetSubject('猪支统计');
                    $pdf->SetKeywords('微猴, 猪支统计, 智慧养殖');
                    //$pdf->setFont('stsongstdlight');
                    $pdf->setFont('droidsansfallback');
                    break;
            }// set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $name, PDF_HEADER_STRING);// set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);// set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);// set margins
            //        $lan = myGetLan();
            //        if ($lan===false){
            //            $pdf->setFont('stsongstdlight');
            //
            //        }else{
            //            if ($lan['lan']=='en'){
            //                $pdf->setFont('DejaVuSans');
            //
            //            }else{
            //            }
            //        }
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);// set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);// set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);// set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
                require_once(dirname(__FILE__) . '/lang/eng.php');
                $pdf->setLanguageArray($l);
            }// -------------------------------------------------------------------
            // add a page
            $pdf->AddPage();// set JPEG quality
            $pdf->setJPEGQuality(75);// Image method signature:
            // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            // Example of Image from data stream ('PHP rules')
            // The '@' character is used to indicate that follows an image data stream and not an image file name
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            //$pdf->Rect(0  , 0, 297, 232, 'F', array(), array(128,255,128));
            // Image example with resizing
            //   $pdf->Image($url1,30,30,100,100);
            //  $pdf->Image($url2,160,30,100,100);
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            // Image example with resizing
            $pdf->SetXY(30, 30);// $pdf->writeHTMLCell('', '', '30', '141', $html, 0, 1, 0, true, '', true); //使用writeHTMLCell打印文本
            // output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            // test fitbox with all alignment combinations
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            // Stretching, position and alignment example
            //   $pdf->Image('@'.$imgdata, '', '', 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
            //   $pdf->Image('@'.$imgdata, '', '', 40, 40, '', '', '', false, 300, '', false, false, 1, false, false, false);
            // -------------------------------------------------------------------
            $type = $filename . '.pdf';
            switch ($lan) {
                case 'en':
                    $pdf->setFont('DejaVuSans');
                    break;
                case 'zh-cn':
                    // set document information
                    $pdf->setFont('stsongstdlight');
                    break;
                default:
                    $pdf->setFont('stsongstdlight');
                    break;
            }//Close and output PDF document
            $pdf->Output($type, 'D');//下载文件名称不支持中文
            //  $pdf->Output($type, 'I');//下载文件名称不支持中文
            die();// set document information
            // $pdf->SetCreator(PDF_CREATOR);
            //  $pdf->SetAuthor('Nicola Asuni');
        } catch (\Exception $e) {
            MyLog::write('pdfOut:'.$e->getMessage(),3);
            return false;
        }
    }
}