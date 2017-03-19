<?php
namespace Home\Controller;

use Think\Controller;

class UserController extends BaseController
{
    /*
     * 登录
     */
    public function login()
    {
        if (self::isOnline()) {
            $this->success('您已安全退出', U('/'), 0);
        }
        $user              = M('user');
        $condition['name'] = I('post.name');
        $checkName         = $user->where($condition)->select();
        if (empty($checkName)) {
            echo 1;//未注册
            exit();
        }
        if (I('post.password') == $checkName[0]['passwd']) {
            S('user', $checkName[0]);
            echo 2;//登录成功
        } else {
            echo 3;//密码错误
        }
    }

    /*
     * 注册
     */
    public function register()
    {
//       echo I('post.name');
        $user              = M('user');
        $condition['name'] = I('post.name');
        $checkName         = $user->where($condition)->select();
        if ($checkName) {
            echo 1;//用户名已注册
        } else {
            $condition['passwd']    = I('post.password');
            $condition['creattime'] = time();
            $condition['type']      = I('post.type');
            $condition['ischeck']   = 0;
            $insertUser             = $user->add($condition);
            echo $insertUser;
        }
    }

    /*
     * 用户信息
     */
    public function info()
    {
        $this->assign('user', S('user'));
        $this->display();
    }

    /*
     * 退出
     */
    public function loginOut()
    {
        S('user', null);
        $this->success('您已安全退出', '/Home/Index/login', 3);
    }

    /*
     * 用户信息列表
     */
    public function userList()
    {
        $curuntUser = S('user');
        //仅超管和运营人员可以查看
        if (($curuntUser['type'] != 1 && $curuntUser['type'] != 2) || $curuntUser['ischeck'] != 1) {
            $this->success('您无权限访问', '/Home/Index', 3);
            exit();
        }
        $user     = M('user');
        $allUsers = $user->where('id>1')->order('ischeck')->select();
//        dump($allUsers);
        $this->assign('allUser', $allUsers);
        $this->display();
    }

    /*
     * 用户审核（类型改变）
     */
    public function check()
    {
        if (!parent::isAdmin()) {
            $this->redirect('/Home/Index/Index', '', 0, '页面跳转中...');
        }
        $user = M('user');
        $data = $user->select(I('get.id'));
        if (empty($data)) {
            $this->success('无此用户，请重试', '/Home/User/userList.html', 3);
        } else {
            if ($user->where('id=' . I('get.id'))->save(array('ischeck' => I('get.ischeck')))) {
                $this->success('审核成功', '/Home/User/userList.html', 1);
            }
        }
    }

    /*
     * 导出用户信息
     */
    public function export()
    {
        $user = M('user');
        $data = $user->select();
        parent::arrToExcel($data, 'AllUser');
    }


}