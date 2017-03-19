<?php
return array(
    //'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'             => 'mysql',     // 数据库类型
    'DB_HOST'             => '127.0.0.1', // 服务器地址
    'DB_NAME'             => 'think',          // 数据库名
    'DB_USER'             => 'root',      // 用户名
    'DB_PWD'              => 'root',          // 密码
    'DB_PORT'             => '3306',        // 端口
    'DB_PREFIX'           => 'think_',    // 数据库表前缀
    'TMPL_ACTION_ERROR'   => THINK_PATH . '../Public/success.html',//默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => THINK_PATH . '../Public/success.html',//默认成功跳转对应的模板文件
    'SITE_NAME'           => '电梯广告管理系统',//网站名称
    'SHOW_PAGE_TRACE'     => true, // 显示页面Trace信息
    'URL_MODEL' => 2,
);