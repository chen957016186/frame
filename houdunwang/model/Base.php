<?php

namespace houdunwang\model;

use PDO;
use PDOException;
use exception;
//创建Base类
//创建类时注意与文件名一致
class Base{
    //创建私有静态属性$pdo,并让$pdo的值为空
    private static $pdo = null;
    //创建私有属性table
    private $table;
    //创建构造方法
    public function __construct($class)
    {
        //判断pdo的值是否为空
        if (is_null(self::$pdo)){
            self::connect();
        }
        //strtolower 小写
        $info = strtolower(ltrim(strrchr($class,'\\'),'\\'));
        $this->table = $info;
    }

    private static function connect(){
        try{
            //连接数据库
            $dsn = c('mqldata.driver').";host=".c('mysql.host').";dbname=".c('mysqldata.dbname');
            //mysql登录账号
            $username =c('mysqldata.username');
            //mysql登录密码
            $password =c('mysqldata.password');
            //实例化PDO
            $pdo = new PDO($dsn,$username,$password);
            //设置字符集
            $pdo->query('set names utf8');
            //设置错误属性
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        }catch (PDOException $exception){
            //抛出异常
            throw new Exception($exception->getMessage());
        }
    }

    /**
     *定义find方法
     * 作用：获取数据表的主键
     */

    public function find($id){
        //获取主键
        //获取当前操作的数据表的主键在哪个字段里面
        $zj = $this->getPk();
        //dd($zj)
        //执行查询语句
        $sql = "select * from {$this->table} where {$zj}={$id}";
        $data = $this->query($sql);
        //dd($data);
        //将查询到的值返出去
        return current($data);
    }

    /**
     * getPk()方法
     * 作用：获取主键是在表结构哪个字段中
     */
    private function getPk(){
        //查看表结构
        $sql = "desc".$this->table;
        $data = $this->query($sql);
        //dd($data);
        //$zj接收主键
        $zj='';
        //数组循环获取到主键值
        foreach ($data as $v){
            if($v[key]=='PRI'){
                $zj = $v['Field'];
                break;
            }
        }
        //将主键return出去
        return $zj;
    }

    /**
     * query方法
     * 作用：执行有结果集的查询
     */
    public function query(){
        try{
            //静态调用执行数据库
            $res = self::$pdo->query($sql);
            //将结果集去除
            return $row = $res->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $exception){
            //抛出异常
            throw new Exception($exception->getMessage());
        }
    }
}