<?php
/**
 * 设置单一入口文件
 */
//加载autoload.php文件
require_once "../vendor/autoload.php";
//在\houdunwang\core\Boot调用run方法
\houdunwang\core\Boot::run();