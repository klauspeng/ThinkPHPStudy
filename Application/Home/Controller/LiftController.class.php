<?php
namespace Home\Controller;

use Think\Controller;

class LiftController extends BaseController
{
    /*
     * 电梯首页
     */
    public function index()
    {
        // 实例化User对象
        $User = M('lift');
        $p = I('get.p','','intval')?I('get.p','','intval'):1;
        $pagecount = 20;
        $list = $User->page($p.','.$pagecount)->select();
        $this->assign('list',$list);// 赋值数据集
        $count      = $User->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    /*
     * 创建测试数据
     */
    public function creatTestDate()
    {
        $user     = M('lift');
        $province = array('北京', '上海', '广州', '深圳');
        $city     = array('北京', '上海', '广州', '深圳');
        $quxian   = array('朝阳区', '北辰区', '东城区', '西城区');
        for ($i = 1; $i <= 10000; $i++) {
            $date['num']      = time() . rand(1000, 9999);
            $date['province'] = $province[ rand(0, count($province) - 1) ];
            $date['city']     = $city[ rand(0, count($city) - 1) ];
            $date['quxian']   = $quxian[ rand(0, count($city) - 1) ];
            $date['detail']   = '曙光西里甲1号第三置业B' . rand(1000, 9999);
            $date['floor']    = rand(10, 30);
            var_dump($user->add($date));
        }
    }

}