<?php
/**
 * 日志控制层
 */
class LogsController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->subtitle = '系统日志';
        $this->pclass = 'manage';
        $this->classname = 'logs';
        $this->subname = 'logs';
        $this->judgePermission($this->subname);
    }

    /**
     * 日志列表
     */
    public function actionIndex()
    {
        
    }

    /**
     * 日志列表JSON
     */
    public function actionJsonlist()
    {
        $start = $this->getRequest()->getInt('iDisplayStart');
        $pagesize = $this->getRequest()->getInt('iDisplayLength');
        $list = $this->Log->limit($start, $pagesize)->order('id')->getAll('*');
        $iTotal = $this->Log->getCount('*');
        $output = array(
            "sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );
        foreach ($list as $key => $value) {
            $list[$key]['parameters'] = '<textarea class="form-control" rows="1">'.$value['parameters'].'</textarea>';
            $list[$key]['time'] = date('Y-m-d H:i:s', $value['time']);
            if ($value['remark']) {
                $list[$key]['remark'] = '<font color="green">成功</font>';
            }else{
                $list[$key]['remark'] = '<font color="red">失败</font>';
            }    
        }
        $output['aaData'] = $list;
        echo json_encode($output);die;
    }

}

?>