<?php
/**
 * 网站默认入口控制层
 */
class AdminController extends KController
{
       
    public function __construct()
    {
        parent::__construct();
        $this->subtitle = '概览';
        $this->pclass ='admin';
        $this->classname = 'admin';
        $this->subname = 'admin/index';
    }

    /**
     * 后台首页
     */
    public function actionIndex()
    {
        $userinfo = Wave::app()->session->getState('userinfo');

        if(empty($userinfo)){
            $this->redirect(Wave::app()->homeUrl.'admin/login');
        }

        $groupModel = new Group();
        $menusModel = new Menus();
        $data = $groupModel->getgroup($userinfo['group_id']);
        $this->menuList = $menusModel->getMenuList($data['menu_ids']);
        
        $this->username = $userinfo['username'];
        $this->last_login_date = $userinfo['last_login_date'];
        $this->avatarUrl = $userinfo['avatar'];

        $articlesModel = new Articles();
        $this->articleCount = $articlesModel->getCount('*');
    }
    
    /**
     * 登录
     */
    public function actionLogin()
    {
        $userinfo = Wave::app()->session->getState('userinfo');
        if(!empty($userinfo)){
            $this->redirect(Wave::app()->homeUrl);
        }
        
        $this->title = Wave::app()->config['projectTitle'].'后台';
        if ($this->getRequest()->isPost()) {
            $this->error_msg = '';
            $this->data = WaveCommon::getFilter($_POST);
            $Users = new Users();
            $array = $Users->getOne('*', array('email'=>$this->data['email']));
            if(!empty($array)){
                if ($array['is_active'] != '1') {
                    $this->error_msg = '该用户被禁用！';
                }
                if ($array['password'] == md5($this->data['password'])) {
                    Wave::app()->session->setState('userinfo', $array);
                    $Users->update(array('last_login_date'=>WaveCommon::getDate()), array('userid'=>$array['userid']));
                    unset($this->data['password']);
                    $this->Log->saveLogs('登录', 1, $this->data);
                    $this->jumpBox('登录成功！', Wave::app()->homeUrl, 1);
                }else{
                    $this->error_msg = '用户名或密码错误！';
                }
            }else{
                $this->error_msg = '没有该用户！';
            }
            $this->Log->saveLogs('登录', 0, $this->data);
        }
    }

    /**
     * 退出
     */
    public function actionLogout()
    {
        Wave::app()->session->logout('userinfo');
        $this->jumpBox('退出成功！', Wave::app()->homeUrl, 1);
    }
}

?>