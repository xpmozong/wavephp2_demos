<?php
/**
 * 前台菜单管理控制层
 */
class FrontmenuController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->subtitle = '前台菜单';
        $this->pclass = 'cms';
        $this->classname = 'frontmenu';
        $this->subname = 'frontmenu';
        $this->judgePermission($this->subname);
    }

    /**
     * 菜单列表
     */
    public function actionIndex()
    {
        $menuModel = new FrontMenus();
        $this->menuTree = $menuModel->getMenuTree();
    }

    /**
     * 添加、修改
     */
    public function actionModify($id)
    {
        $menuModel = new FrontMenus();
        $id = (int)$id;
        $this->data = $menuModel->getOne('*', array('menu_id'=>$id));
        $this->menuTree = $menuModel->getMenuTree();

        $categoryModel = new Category();
        $this->category = $categoryModel->getAll();
        foreach ($this->category as $key => $value) {
            $this->category[$key]['cid'] = 'c_'.$value['cid'];
        }
        $portalpageModel = new Portalpage();
        $this->portalpage = $portalpageModel->getAll('pid,title');
        foreach ($this->portalpage as $key => $value) {
            $this->portalpage[$key]['pid'] = 'p_'.$value['pid'];
        }
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
        $urlArr = explode('_', $data['url_id']);
        if ($urlArr[0] == 'c') {
            $data['menu_url'] = 'category/index?cid='.$urlArr[1];
        } elseif ($urlArr[0] == 'p') {
            $data['menu_url'] = 'page/index?pid='.$urlArr[1];
        } else {
            $data['menu_url'] = $data['url_id'];
        }
        $menuModel = new FrontMenus();
        if ($menu_id == 0) {
            $menu_id = $menuModel->insert($data, 'front_menus');
            $data['menu_id'] = $menu_id;
            $this->Log->saveLogs('添加菜单', 1, $data);
        } else {
            $menuModel->update($data, array('menu_id'=>$menu_id), 'front_menus');
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
        $menuModel = new FrontMenus();
        $menuModel->delete(array('menu_id'=>$id), 'front_menus');
        $this->Log->saveLogs('删除菜单', 1, array('menu_id'=>$id));
        WaveCommon::exportResult(true, '成功！');
    }

    /**
     * 显示菜单父类
     */
    public function actionMenupclass()
    {
        $menuModel = new FrontMenus();
        $data = $menuModel->getOne('pclass',array('menu_id'=>$_POST['menuid']));
        echo json_encode($data);die;
    }
}
?>