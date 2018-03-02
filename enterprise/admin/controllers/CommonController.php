<?php
/**
 * 公共控制层
 */
class CommonController extends KController
{
    public function __construct()
    {
        parent::__construct();

        $this->userinfo = Wave::app()->session->getState('userinfo');
        if (empty($this->userinfo)) {
            $this->redirect(Wave::app()->homeUrl.'admin/login');
        }
        
        $this->username = $this->userinfo['username'];
        $this->last_login_date = $this->userinfo['last_login_date'];
        $this->avatarUrl = $this->userinfo['avatar'];
        $groupModel = new Group();
        $menusModel = new Menus();
        $data = $groupModel->getgroup($this->userinfo['group_id']);
        $this->menuList = $menusModel->getMenuList($data['menu_ids']);

        $this->permisionMenus = array('member');
        foreach ($this->menuList as $key => $value) {
            foreach ($value['child'] as $k => $v) {
                $this->permisionMenus[] = $v['menu_url'];
            }
        }
    }

    protected function judgePermission($subname)
    {
        if (!in_array($subname, $this->permisionMenus)) {
            $this->jumpBox('对不起，您没有权限！', Wave::app()->homeUrl, 1);
        }
    }
}
?>