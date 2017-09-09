<?php
//创建命名空间
namespace houdunwang\core;
//创建class类Boot
//类名与文件名必须一致
class Boot
{

    //定义一个run方法
    public static function run()
    {

        self::handler();
//        //静态调用init（）方法
        self::init();
//        //静态调用appRun()方法
        self::appRun();
    }

    public static function handler()
    {
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    }


    //定义appRun()方法
    public static function appRun()
    {
        //在这使用if语句进行判断
        //判断地址栏中是否有参数s
        if (isset($_GET['s'])){
            //explode() 函数把字符串打散为数组
            //将接受过来的参数s用分隔符分开
            $info = explode('/',$_GET['s']);
            //当地址栏没有参数就默认一个类的方法，后面是这个类的具体路径，ucfirst将文件的首字母大写
            $class = "\app\\{$info[0]}\controller\\" . ucfirst($info[1]);
            //将$info['2']赋给$action
            $action = $info['2'];
            //定义常量MODULE
            define('MODULE',$info[0]);
            //定义常量CONTROLLER
            define('CONTROLLER',$info[1]);
            //定义常量ACTION
            define('ACTION',$info[2]);
        }else{
            //将路径保存到变量class当中
            //‘\app\home\controller\Entry’ 路径
            $class = "\app\home\controller\Entry";
            //将index赋给变量$action
            $action = 'index';
            //定义常量MODULE
            define('MODULE','home');
            //定义常量CONTROLLER
            define('CONTROLLER','entry');
            //定义常量ACTION
            define('ACTION','index');
        }
        //调实例化对象方法、对象名
        echo call_user_func_array([new $class,$action],[]);
    }

    /**
     * 初始化框架
     */
    //定义一个静态的方法init()
    public static function init()
    {
        //声明变量
        //不加头部，浏览器输出就会出现乱码
        header('Content-type:text/html;charset=utf8');
        //设置时区
        //获取当前时间
        date_default_timezone_set('PRC');
        //session_id()  获取设置当前会话id
       // session_start() 开启会话
        //使用二元一次进行判断session是否开启
        //如果前面已经开启则获取设置它的id，没有则开启会话
        session_id()|| session_start();
    }
}