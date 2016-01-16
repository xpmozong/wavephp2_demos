<?php
/**
 * 友情链接控制层
 */
class LinksController extends AdminCommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->title = '友情链接';
    }

    /**
     * 友情链接页
     */
    public function actionIndex()
    {
        $Links = new Links();
        $this->list = $Links->getAll();   
    }

    /**
     * 添加、修改链接
     */
    public function actionModify($id)
    {
        $Links = new Links();
        $id = (int)$id;
        $this->data = $Links->getOne('*', array('lid'=>$id));
    }

    /**
     * 提交信息
     */
    public function actionModified()
    {
        $Links = new Links();
        $data = WaveCommon::getFilter($_POST);
        $id = (int)$data['lid'];
        unset($data['lid']);
        if ($id == 0) {
            $Links->insert($data);
        }else{
            $Links->update($data, array('lid'=>$id));
        }

        $this->jumpBox('成功！', Wave::app()->homeUrl.'links', 1);
    }

    /**
     * 删除
     */
    public function actionDelete($id)
    {
        $id = (int)$id;
        $Links = new Links();
        $Links->delete(array('lid'=>$id));
        WaveCommon::exportResult(true, '成功！');
    }

}

?>