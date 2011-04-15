<?php
class IndexController extends Zend_Controller_Action
{
    public function init ()
    {
        /* Initialize action controller here */
    }
    public function indexAction ()
    {
        // action body
    }
    public function showAction ()
    {
        // action body
        $db = new Application_Model_DbTable_Userinfo();
        //查询所有用户的信息
        $all_userinfo="SELECT * FROM userinfo";
        $userinfo = $db->getAllUserInfo($all_userinfo);
        $this->view->userinfo = $userinfo;
        //多表联合查询
        $user_name="SELECT u.user_name FROM username u ,userinfo i where u.user_autoid=i.user_autoid";
        $username = $db->getAllUserInfo($user_name);
        $this->view->username = $username;
    }
    public function addAction ()
    {
        // action body
        //如果是POST过来的值.就增加.否则就显示增加页面
        //不赞成用这种方法
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $user_name = $this->_request->getPost('user_name');
            $user_pwd = $this->_request->getPost('user_pwd');
            if ($user_name != null || $user_pwd != null) {
                $db = new Application_Model_DbTable_Userinfo();
                $add_userinfo="insert into userinfo(user_name,user_pwd) values('".$user_name."','".$user_pwd."')";
               	$db->HanlderUserInfo($add_userinfo);
                echo 'success';
                echo $this->_helper->redirector('show');
            } else {
            	echo 'failue';
                echo $this->_helper->redirector('add');
            }
        }
    }
    public function add01Action ()
    {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
        	//取得前台得传过来的值
            $user_name = $this->_request->getPost('user_name');
            $user_pwd = $this->_request->getPost('user_pwd');
            if ($user_name != null || $user_pwd != null) {
            	//实例化
                $db = new Application_Model_DbTable_Userinfo();
                //将前台传过来的值进行数组化,为inser服务
                $data = array('user_name' => $user_name, 
                'user_pwd' => $user_pwd);
                //该方法的api是这样的insert($array)
                $db->insert($data);
                //成功后跳转页面
                echo $this->_helper->redirector('show');
            } else {
            	//失败后返回
                echo $this->_helper->redirector('add');
            }
        }
    }
}





