<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends BaseController
{
    /*
     * 首页
     */
    public function index()
    {
        $value = S('user');
        if(empty($value)){
            $this->success('请登录','/Home/Index/login',3);exit();
        }
        $title = 'ceshi';
        $this->assign('title', $title);
        $this->assign('name', $value['name']);
        $this->display();
    }

    /*
     * 登录
     */
    public function login()
    {
        if(parent::isOnline()){
            $this->redirect('/Home/Index/Index','', 0, '页面跳转中...');
        }else{
            $this->display();
        }
    }

    /*
     * 注册
     */
    public function register()
    {
        if(parent::isOnline()){
            $this->redirect('/Home/Index/Index','', 0, '页面跳转中...');
        }else{
            $this->display();
        }
    }
}