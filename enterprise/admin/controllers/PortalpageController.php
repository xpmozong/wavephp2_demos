<?php
/**
 * 页面管理控制层
 */
class PortalpageController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->subtitle = '页面管理';
        $this->pclass = 'cms';
        $this->classname = 'portalpage';
        $this->subname = 'portalpage';
        $this->judgePermission($this->subname);
    }

    /**
     * 页面管理
     */
    public function actionIndex()
    {

    }

    /**
     * 页面管理列表JSON
     */
    public function actionJsonlist()
    {
        $portalpageModel = new Portalpage();
        $start = (int)$_GET['iDisplayStart'];
        $pagesize = (int)$_GET['iDisplayLength'];
        $list = $portalpageModel->select('pid,title')->limit($start, $pagesize)->order('pid')->getAll();
        $iTotal = $portalpageModel->getCount('*');
        $output = array(
            "sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );
        $homeUrl = Wave::app()->homeUrl.$this->classname.'/modify/';
        foreach ($list as $key => $value) {
            $list[$key]['operation'] = '<button type="button" class="btn btn-info btn-xs" onclick="javascript:location.href=\''.$homeUrl.$value['pid'].'\'">修改</button> | ';
            $list[$key]['operation'] .= '<button type="button" class="btn btn-danger btn-xs" onclick="mdelete('.$value['pid'].')">删除</button>';
        }
        $output['aaData'] = $list;
        echo json_encode($output);die;
    }

    /**
     * 添加、修改内容
     */
    public function actionModify($id)
    {
        $portalpageModel = new Portalpage();
        $id = (int)$id;
        $this->data = $portalpageModel->getOne('*', array('pid'=>$id));
    }

    /**
     * 提交信息
     */
    public function actionModified()
    {
        $portalpageModel = new Portalpage();
        $data = WaveCommon::getFilter($_POST);
        $pid = (int)$data['pid'];
        unset($data['pid']);
        if ($pid == 0) {
            $data['add_date'] = date('Y-m-d H:i:s');
            $portalpageModel->insert($data);
        }else{
            $portalpageModel->update($data, array('pid'=>$pid));
        }

        $this->jumpBox('成功！', Wave::app()->homeUrl.$this->classname, 1);
    }

    /**
     * 删除
     */
    public function actionDelete($id)
    {
        $id = (int)$id;

        $portalpageModel = new Portalpage();
        $portalpageModel->delete(array('pid'=>$id));

        WaveCommon::exportResult(true, '成功！');
    }
}

?>
