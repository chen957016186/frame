<?php
//创建命名空间
namespace houdunwang\core;
//创建Controller类
class Controller{
    //定义跳转地址属性
    private $url = "window.history.back()";

    /**
     * @param $message 消息内容
     */
    public function message($message){
        //加载public/view/message.php
        //消息提示的模板文件
        include "./view/message.php";
        exit;
    }

    /**
     * setRedirect方法
     * 用于跳转地址
     * @param string $url 跳转地址
     * @return $this
     */
    public  function setRedirect($url =''){
        //判断 empty()函数是用来测试变量是否已经配置
        if(empty($url)){
            //有执行该语句
            $this->url = "window.history.back()";
        }else{
            //没有执行该语句
            $this->url = "location.href='$url'";
        }
        //将值返出去
        return $this;
    }
}