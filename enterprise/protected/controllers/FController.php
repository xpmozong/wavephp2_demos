<?php
/**
 * 公共控制层
 */
class FController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->title = Wave::app()->config['projectTitle'];

        $menuModel = new FrontMenus();
        $this->menuList = $menuModel->getMenu();
        
        $Links = new Links();
        $this->links = $Links->order('lid', 'desc')->getAll();

        $this->REQUEST_URI = $_SERVER['REQUEST_URI'];

    }
}