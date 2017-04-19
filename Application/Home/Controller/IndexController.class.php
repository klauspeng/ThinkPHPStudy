<?php
namespace Home\Controller;

use Think\Controller;
use Think\Think;

class IndexController extends Controller
{
    public function index()
    {
        $this->assign('title',"标题");
        $this->display();
    }
}