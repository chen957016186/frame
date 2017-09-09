<?php
//创建命名空间
namespace app\home\controller;

use houdunwang\core\Controller;
use houdunwang\view\View;
use system\model\Article;
//创建类Entry
//类名与文件名必须一致
//继承Controller类
class Entry extends Controller
{
    //echo adc；
    //定义index（）方法
    public function index(){
       // echo 'index';
        //测试数据库操作

        $data = Article::find(1);
        dd($data);
//        $test = 'houdunwang';
        //dd(View::with(compact('test')));
//        return View::with(compact('test'))->make();
    }
    //定义add方法
    public function add(){
        //echo 'add';
        //测试Controller.php中setRedirect和message方法
        //$this->setRedirect ()
        //接收到setRedirect()返回的$this
        //$this->setRedirect ()->message ( '123' );
    }
}