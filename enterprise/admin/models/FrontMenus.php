<?php
/**
 * 前台菜单表
 */
class FrontMenus extends Model
{
    protected function init(){
        $this->_tableName = $this->getTablePrefix().'front_menus';
        // $this->cache = Wave::app()->redis;
    }

    /**
     * 菜单树
     */
    public function getMenuTree() {
        $mdata = $this->order('menu_order', 'asc')->getAll('*', array(), 'front_menus');
        $tree = new Tree($mdata);
        $tree->set_array_colum(array('id'=>'menu_id', 'parent_id'=>'top_id', 'name'=>'menu_name'));
        $menuTree = $tree->get_tree(0, "\$spacer\$menu_name");
        unset($mdata);

        return $menuTree;
    }

    /**
     * 获得菜单
     */
    public function getMenuList($groups) {
        $mdata = $this->order('menu_order', 'asc')->in(array('menu_id'=>$groups))->getAll('*');
        $newMenu = $menuList = array();
        foreach ($mdata as $key => $value) {
            $newMenu[$value['top_id']][] = $value;
        }
        foreach ($newMenu[0] as $key => $value) {
            $menuList[$key] = $value;
            $menuList[$key]['child'] = @$newMenu[$value['menu_id']];
        }
        unset($mdata, $newMenu);

        return $menuList;
    }

    /**
     * 权限菜单
     */
    public function getMenu()
    {
        $mdata = $this->order('menu_order', 'asc')->getAll('*', array(), "front_menus");
        $newMenu = $menuList = array();
        foreach ($mdata as $key => $value) {
            $newMenu[$value['top_id']][] = $value;
        }
        foreach ($newMenu[0] as $key => $value) {
            $menuList[$key] = $value;
            $menuList[$key]['child'] = @$newMenu[$value['menu_id']];
        }
        unset($mdata, $newMenu);

        return $menuList;
    }
}
?>
