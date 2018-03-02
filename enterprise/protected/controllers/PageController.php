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
        $cacheDir = '/data/page/'.($pid%10).'/';
        $cacheFile = ROOT_PATH.$cacheDir.$pid.'.html';
        if (file_exists($cacheFile)) {
            $url = $this->hostInfo.$cacheDir.$pid.'.html';
            $this->redirect($url);
        } else {
            $portalpageModel = new Portalpage();
            $this->data = $portalpageModel->getOne('*', array('pid'=>$pid));
            WaveCommon::mkDir(ROOT_PATH.$cacheDir);
            $content = $this->fetch('page/index.html');
            Wave::writeCache($cacheFile, $content);
        }
    }
}