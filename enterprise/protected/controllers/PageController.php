<?php
/**
 * 页面控制层
 */
class PageController extends FController
{
       
    public function __construct()
    {
        parent::__construct();
        $this->classname = Wave::getClassName();
    }

    public function actionIndex()
    {
        $pid = $this->getRequest()->getInt('pid');
        $portalpageModel = new Portalpage();
        $this->data = $portalpageModel->getOne('*', array('pid'=>$pid));
    }
}