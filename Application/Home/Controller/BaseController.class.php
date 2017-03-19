<?php
namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller
{
    /*
     * 判断用户是否登录
     */
    public static function isOnline()
    {
        return empty(S('user')) ? false : true;
    }
    /*
     * 判断用户是否是有管理权限（超管，运营）
     */
    public static function isAdmin()
    {
        $user = S('user');
        if(in_array($user['type'],array(1,2))){
            return true;
        }else{
            return false;
        }
    }

    /*
     * PHPExcel导出
     */
    function arrToExcel($data, $name)
    {
        import("Org.Util.PHPExcel");
        //处理数据，获取key
        $keys        = array_keys($data[0]);
        $objPHPExcel = new \PHPExcel();
        // 修改sheet名称
        $objPHPExcel->getActiveSheet()->setTitle($name . '_' . date('Ymd_His'));
        // 读取数组
        for ($j = 1; $j <= count($data); $j++) {
            for ($k = 1; $k <= count($data[0]); $k++) {
                $colname = \PHPExcel_Cell::stringFromColumnIndex($k - 1); // 从o开始
                $colname .= $j;
                if ($j == 1) {
                    $value = $keys[ $k - 1 ];
                } else {
                    $key   = $keys[ $k - 1 ];
                    $value = $data[ $j - 1 ][ $key ];
                }
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($colname, $value);
            }
        }
        //设置列宽
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(49);

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $name . '_' . date('Ymd_His') . '.xls');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}