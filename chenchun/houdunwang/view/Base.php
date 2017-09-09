<?php
//创建命名空间
namespace houdunwang\view;
//创建Base类
class Base{
    //创建数据库属性名data
    protected $data = [];
    //创建文件属性名
    //存放模板路径
    protected $file;
    //定义with方法
    //作用：分配变量
    public function with($var){
        //dd($var);
        //将传过来的值存到数据库
        $this->data =$var;
        return $this;
    }
    //定义make（）方法
    //作用：显示模板
    public function make(){
        //dd(MODULE); home
        //dd(CONTROLLER); Entry
        //dd(ACTION); index
        //include "../app/home/view/entry
        $this->file = "../app/".MODULE."/view/".strtolower(CONTROLLER)."/".ACTION.".".c('view.suffix');
        return $this;
    }

    /**
     * 当echo 输出对象的时候执行
     * @return string
     */
    public function __toString()
    {
       // echo 'heillo';
        // TODO: Implement __toString() method.
        extract($this->data);
        include $this->file;
        return '';
    }
}