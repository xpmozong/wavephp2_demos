<?php
/**
 * 菜单管理控制层
 */
class MenusController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->subtitle = '菜单管理';
        $this->pclass = 'manage';
        $this->classname = 'menus';
        $this->subname = 'menus';
        $this->judgePermission($this->subname);
    }

    /**
     * 菜单列表
     */
    public function actionIndex()
    {
        $menuModel = new Menus();
        $this->menuTree = $menuModel->getMenuTree();
    }

    /**
     * 添加、修改
     */
    public function actionModify($id)
    {
        $menuModel = new Menus();
        $id = (int)$id;
        $this->data = $menuModel->getOne('*', array('menu_id'=>$id));

        $this->menuTree = $menuModel->getMenuTree();
    }

    /**
     * 提交信息
     */
    public function actionModified()
    {
        $data = WaveCommon::getFilter($_POST);
        $menu_id = (int)$data['menu_id'];
        unset($data['menu_id']);
        $returnUrl = Wave::app()->homeUrl.$this->classname;
        $menuModel = new Menus();
        if ($menu_id == 0) {
            $menu_id = $menuModel->insert($data, 'menus');
            $data['menu_id'] = $menu_id;
            $this->Log->saveLogs('添加菜单', 1, $data);
        } else {
            $menuModel->update($data, array('menu_id'=>$menu_id), 'menus');
            $data['menu_id'] = $menu_id;
            $this->Log->saveLogs('修改菜单', 1, $data);
        }

        $this->jumpBox('成功！', $returnUrl, 1);
    }

    /**
     * 删除
     */
    public function actionDelete($id)
    {
        $id = (int)$id;
        $menuModel = new Menus();
        $menuModel->delete(array('menu_id'=>$id), 'menus');
        $this->Log->saveLogs('删除菜单', 1, array('menu_id'=>$id));
        WaveCommon::exportResult(true, '成功！');
    }

    /**
     * 显示菜单父类
     */
    public function actionMenupclass()
    {
        $menuModel = new Menus();
        $data = $menuModel->getOne('pclass',array('menu_id'=>$_POST['menuid']));
        echo json_encode($data);die;
    }
}
?>