<?php

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

//定义默认模块(主要用于生成模块)
//define('BIND_MODULE', 'Admin');

// 引入ThinkPHP入口文件
require '../ThinkPHP/ThinkPHP.php';