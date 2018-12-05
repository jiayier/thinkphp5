<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/5
 * Time: 16:40
 * Auther sl
 */

namespace app\index\logicModel;

use app\common\model\Tcpdf;
class PdfWeb extends Tcpdf
{
    public function pdfOut(){
     $this->import('en','sadf',self::getHtml(),'se');
    }


    private static function getHtml(){



     return   $html = <<<EOF
                            <!-- EXAMPLE OF CSS STYLE -->
                            <style>
                                .first {
                                    /*color: #003300;*/
                                    /*font-size: 8pt;*/
                                    /*border-left: 3px solid red;*/
                                    /*border-right: 3px solid #FF00FF;*/
                                    /*border-top: 3px solid green;*/
                                    /*border-bottom: 3px solid black;*/
                                    /*background-color: #ccffcc;*/
                                }
                                .first td {
                                    border: 1px solid black;
                                    /*background-color: #ffffee;*/
                                }
                                td.second {
                                    /*border: 2px dashed green;*/
                                }
                                .one{
                                width: 12.5%;
                                align:"center";
                                }
                                .two{
                                width: 20%;
                                } .three{
                                width: 12%;
                                
                                } .forth{
                                width: 11%;
                                
                                }
                                .title{
                                width: 100%;
                                height: 50;
                                text-align:center;
                                /*background-color: yellow;*/
                                font-size: 20pt;
                                }
                                .pic{
                                   /*height: 100%;*/
                                   /*width: 100%;     */
                                }
                                .lowercase {
                                    /*text-transform: lowercase;*/
                                }
                                .uppercase {
                                    /*text-transform: uppercase;*/
                                }
                                .capitalize {
                                    /*text-transform: capitalize;*/
                                }
                            </style>
                            <div class="title">ssssss</div>
                            <table class="" cellpadding="4">
                             <tr>
                             <td>asdfasdfasdf</td>
                               <!--<td  align="center"><img class="pic" src="ssssss"></td> -->
                             </tr>
                               <tr>
                                <td>asdfasdfasdf</td>
                               <!--<td  align="center"><img class="pic" src="ssssss"></td>-->
                             </tr>
                            </table>
                            <div></div>	
                            <div class="title">ssssss[1]</div>
                            <div></div>	

                            <table class="first" cellpadding="4"  >
                             ssssss
                            </table> 
                           
EOF;





    }




}