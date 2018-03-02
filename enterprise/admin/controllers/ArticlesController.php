<?php
/**
 * 文章列表控制层
 */
class ArticlesController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->subtitle = '文章管理';
        $this->pclass = 'cms';
        $this->classname = 'articles';
        $this->subname = 'articles';
        $this->judgePermission($this->subname);
    }
    /**
     * 文章页
     */
    public function actionIndex()
    {
        $categoryModel = new Category();
        $this->category = $categoryModel->getAll();
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
            $list[$key]['operation'] = '<button type="button" class="btn btn-info btn-xs m-right20" onclick="javascript:location.href=\''.$homeUrl.$value['aid'].'\'">修改</button>';
            $list[$key]['operation'] .= '<button type="button" class="btn btn-danger btn-xs" onclick="mdelete('.$value['aid'].')">删除</button>';
        }
        $output['aaData'] = $list;
        echo json_encode($output);die;
    }

    /**
     * 添加、修改文章
     */
    public function actionModify($id)
    {
        $id = (int)$id;
        $where = array('a.aid'=>$id);
        $articlesModel = new Articles();
        $categoryModel = new Category();
        $this->data = $articlesModel ->select('c.*,a.*')
                                ->from('w_articles a')
                                ->join('w_articles_content c', 'a.aid=c.aid')
                                ->where($where)
                                ->getOne();
        if (!empty($this->data)) {
            $this->data['content'] = stripslashes($this->data['content']);
            $this->data['content'] = htmlspecialchars_decode($this->data['content']);
        }
        $this->category = $categoryModel->getAll();
    }

    /**
     * 提交信息
     */
    public function actionModified()
    {
        $data = WaveCommon::getFilter($_POST);
        $aid = (int)$data['aid'];
        $article = $data['aritcle'];
        $content = $data['a_content'];
        $content['content'] = htmlspecialchars($content['content']);
        $articlesModel = new Articles();
        $articlesContentModel = new ArticlesContent();
        if ($aid == 0) {
            $article['add_date'] = WaveCommon::getDate();
            $content['aid'] = $articlesModel->insert($article);
            $articlesContentModel->insert($content);
            $article['aid'] = $content['aid'];
        } else {
            $where = array('aid'=>$aid);
            $articlesModel->update($article, $where);
            $count = $articlesContentModel->getCount('*', $where);
            if ($count > 0) {
                $articlesContentModel->update($content, $where);
            } else {
                $content['aid'] = $aid;
                $articlesContentModel->insert($content);
            }
            $cacheDir = '/data/article/'.($aid%10).'/';
            $cacheFile = ROOT_PATH.$cacheDir.$aid.'.html';
            unlink($cacheFile);
        }
        unlink(ROOT_PATH.'/data/index.html');

        $this->jumpBox('成功！', Wave::app()->homeUrl.$this->classname, 1);
    }

    /**
     * 删除
     */
    public function actionDelete($id)
    {
        $id = (int)$id;
        $where = array('aid'=>$id);
        $articlesModel = new Articles();
        $articlesModel->delete($where);
        $articlesContentModel = new ArticlesContent();
        $articlesContentModel->delete($where);
        WaveCommon::exportResult(true, '成功！');
    }
}

?>