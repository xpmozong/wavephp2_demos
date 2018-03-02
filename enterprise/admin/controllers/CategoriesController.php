<?php
/**
 * 文章分类控制层
 */
class CategoriesController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->subtitle = '分类管理';
        $this->pclass = 'cms';
        $this->classname = 'categories';
        $this->subname = 'categories';
        $this->judgePermission($this->subname);
        $this->listCateArr = array('文章', '图片');
    }

    /**
     * 分类页
     */
    public function actionIndex()
    {
        $categoryModel = new Category();
        $this->list = $categoryModel->getAll();
        foreach ($this->list as $key => $value) {
            $this->list[$key]['listname'] = $this->listCateArr[$value['list_cate']];
        }
    }

    /**
     * 添加、修改分类
     */
    public function actionModify($cid)
    {
        $cid = (int)$cid;
        $categoryModel = new Category();
        $this->data = $categoryModel->getOne('*', array('cid'=>$cid));
    }

    /**
     * 添加、修改分类结果
     */
    public function actionModified()
    {
        $categoryModel = new Category();
        $data = WaveCommon::getFilter($_POST);
        $cid = (int)$data['cid'];
        unset($data['cid']);
        if ($cid == 0) {
            $categoryModel->insert($data);
        } else {
            $categoryModel->update($data, array('cid'=>$cid));
        }

        $this->jumpBox('成功！', Wave::app()->homeUrl.$this->classname, 1);
    }

    /**
     * 删除
     */
    public function actionDelete($id)
    {
        $id = (int)$id;
        $categoryModel = new Category();
        $categoryModel->delete(array('cid'=>$id));
        WaveCommon::exportResult(true, '成功！');
    }

}

?>