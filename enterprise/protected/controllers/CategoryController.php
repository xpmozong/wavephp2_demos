<?php
/**
 * 文章分类控制层
 */
class CategoryController extends FController
{
       
    public function __construct()
    {
        parent::__construct();
        $this->classname = 'category';
    }

    public function actionIndex()
    {
        $this->cid = $this->getRequest()->getInt('cid');
        $categoryModel = new Category();
        $this->category = $categoryModel->order('cate_order')->getAll('*');
    }

    /**
     * 文章列表JSON
     */
    public function actionJsonlist()
    {
        $articlesModel = new Articles();
        $start = (int)$_GET['iDisplayStart'];
        $pagesize = (int)$_GET['iDisplayLength'];
        $where = array();
        $this->cid = isset($_GET['cid']) ? (int)$_GET['cid'] : 1;
        if ($this->cid) {
            $where['cid'] = $this->cid;
        }
        $list = $articlesModel->where($where)->limit($start, $pagesize)->order('aid')->getAll();
        $iTotal = $articlesModel->getCount('*', $where);
        $output = array(
            "sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );
        $homeUrl = Wave::app()->homeUrl.$this->classname.'/modify/';
        foreach ($list as $key => $value) {
            $list[$key]['title'] = '<a href="'.Wave::app()->homeUrl.$this->classname.'/article?cid='.$value['cid'].'&aid='.$value['aid'].'">'.$value['title'].'</a>';
        }
        $output['aaData'] = $list;
        echo json_encode($output);die;
    }

    /**
     * 文章详情
     */
    public function actionArticle()
    {
        $this->cid = $this->getRequest()->getInt('cid');
        $categoryModel = new Category();
        $this->category = $categoryModel->order('cate_order')->getAll('*');

        $aid = $this->getRequest()->getInt('aid');
        $where = array('a.aid'=>$aid);
        $articlesModel = new Articles();
        $this->data = $articlesModel ->select('c.*,a.*')
                                ->from('w_articles a')
                                ->join('w_articles_content c', 'a.aid=c.aid')
                                ->where($where)
                                ->getOne();
        if (!empty($this->data)) {
            $this->data['content'] = stripslashes($this->data['content']);
            $this->data['content'] = htmlspecialchars_decode($this->data['content']);
        }
    }

}