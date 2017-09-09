<?php
//创建命名空间
namespace houdunwang\model;
//创建Model类
class Model{
    //__call方法为了避免当调用的方法不存在时产生错误，可以使用 __call() 方法来避免。
    //该方法在调用的方法不存在时会自动调用，程序仍会继续执行下去
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        //静态调用parseAction($name,$arguments)方法
        return self::parseAction($name,$arguments);
    }
    //__callStatic 当调用的静态方法不存在或权限不足时，会自动调用__callStatic方法
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
        //静态调用parseAction($name,$arguments)方法
        return self::parseAction($name,$arguments);
    }

    public static function parseAction($name,$argument){
        $class = get_called_class();
        //call_user_func_array — 调用回调函数，并把一个数组参数作为回调函数的参数
        //[new Base($class),$name] 被调用的回调函数
        return call_user_func_array([new Base($class),$name],$argument);
    }
}