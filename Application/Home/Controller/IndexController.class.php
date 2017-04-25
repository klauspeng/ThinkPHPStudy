<?php
namespace Home\Controller;

use Think\Controller;
use Think\Think;

class IndexController extends Controller
{
    public function index()
    {
//        \Think\Build::buildController('Home','User');
        $this->assign('title',"标题");
        $this->display();
    }
}