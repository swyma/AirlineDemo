<?php
class Application_Model_DbTable_Userinfo extends Zend_Db_Table_Abstract
{
    protected $_name = 'userinfo';
    //取得所有用户的信息
    public function getAllUserInfo ($sql)
    {
    	//实例一个全局变量
    	$adapter = Zend_Registry::get('db');
        //执行sql语句
      	$userinfo =  $adapter->query($sql);
        //返回所有信息
        return $userinfo;
    }
    //用户的信息增删改
    //这种方法你只要改变$sql就可以
    //其实个人觉得这种方法不安全，因为会涉及数据注入失败情况发生
    public function HanlderUserInfo($sql){
    	$adapter = Zend_Registry::get('db');
    	$adapter->query($sql);
    }
    /*
     * 个人觉得以下的方法可以很好的解决数据注入失败的情况
     * 也希望大家能用这种方法，也许处理相对复杂些
     * 这个方法具体用法看control的add01Action
     */
    /*public function addUserInfo($array){
    	$adapter = Zend_Registry::get('db');
    	$adapter->insert($array);
    }*/
}

