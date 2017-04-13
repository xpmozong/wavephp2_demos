<?php
/**
 * 文章分类控制层
 */
class CategoryController extends FController
{
       
    public function __construct()
    {
        parent::__construct();
        $this->classname = Wave::getClassName();
    }

    public function actionIndex()
    {
        $this->cid = $this->getRequest()->getInt('cid', 1);
        $categoryModel = new Category();
        $this->category = $categoryModel->getOne('*', array('cid'=>$this->cid));

        $page = $this->getRequest()->getInt('page', 1);
        $pagesize = 20;
        $start = ($page - 1) * $pagesize;
        $articlesModel = new Articles();
        $where = array();
        $where['cid'] = $this->cid;
        $this->list = $articlesModel->where($where)->limit($start, $pagesize)->order('aid')->getAll();
        $allcount = $articlesModel->getCount('*', $where);
        $commonModel = new Common();
        $this->pagebar = $commonModel->getPageBar($this->homeUrl, $allcount, $pagesize, $page);
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
        $cid = $this->getRequest()->getInt('cid', 1);
        $where['cid'] = $cid;
        $list = $articlesModel->where($where)->limit($start, $pagesize)->order('aid')->getAll();
        $iTotal = $articlesModel->getCount('*', $where);
        $output = array(
            "sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );
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