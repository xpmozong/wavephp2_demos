<?php
/**
 * 用户组管理控制层
 */
class GroupsController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->subtitle = '用户组管理';
        $this->pclass = 'manage';
        $this->classname = 'groups';
        $this->subname = 'groups';
        $this->judgePermission($this->subname);
    }

    /**
     * 用户组列表
     */
    public function actionIndex()
    {
        
    }

    /**
     * 用户组列表JSON
     */
    public function actionJsonlist()
    {
        $start = $this->getRequest()->getInt('iDisplayStart');
        $pagesize = $this->getRequest()->getInt('iDisplayLength');
        $groupModel = new Group();
        $list = $groupModel->limit($start, $pagesize)->getAll('*');
        $iTotal = $groupModel->getCount('*');
        $output = array(
            "sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );
        $modifyUrl = Wave::app()->homeUrl.$this->classname.'/modify/';
        foreach ($list as $key => $value) {
            $list[$key]['group_state'] = $value['group_state'] ? '<font color="green">启用</font>' : '<font color="red">禁用</font>';
            $list[$key]['operation'] = '<a href="'.$modifyUrl.$value['group_id'].'" class="btn btn-xs btn-info">编辑</a> | ';
            if ($value['group_state']) {
                $list[$key]['operation'] .= '<a href="javascript:void(0);" onclick="enable('.$value['group_state'].','.$value['group_id'].')" class="btn btn-xs btn-danger">禁用</a>';
            } else {
                $list[$key]['operation'] .= '<a href="javascript:void(0);" onclick="enable('.$value['group_state'].','.$value['group_id'].')" class="btn btn-xs btn-success">启用</a>';
            }
        }
        $output['aaData'] = $list;
        echo json_encode($output);die;
    }

    /**
     * 添加、修改
     */
    public function actionModify($id)
    {
        $groupModel = new Group();
        $id = (int)$id;
        $this->data = $groupModel->getOne('*', array('group_id'=>$id));
        if (!empty($this->data)) {
            $this->data['menu_ids'] = explode(',', $this->data['menu_ids']);
        }
        $menuModel = new Menus();
        $this->menuList1 = $menuModel->getMenu();
    }

    /**
     * 提交信息
     */
    public function actionModified()
    {
        $data = WaveCommon::getFilter($_POST);
        $group_id = (int)$data['group_id'];
        unset($data['group_id']);
        $returnUrl = Wave::app()->homeUrl.$this->classname;
        $groupModel = new Group();
        $data['menu_ids'] = implode(',', $data['menu_ids']);
        if ($group_id == 0) {
            $group_id = $groupModel->insert($data);
            $data['group_id'] = $group_id;
            $this->Log->saveLogs('添加用户组', 1, $data);
        } else {
            $groupModel->update($data, array('group_id'=>$group_id));
            $data['group_id'] = $group_id;
            $this->Log->saveLogs('修改用户组', 1, $data);
        }
        $this->jumpBox('成功！', $returnUrl, 1);
    }

    // /**
    //  * 删除
    //  */
    // public function actionDelete($id)
    // {
    //     $id = (int)$id;
    //     $publicModel = new PublicModel('b_users_group');
    //     die;
    //     $publicModel->delete(array('group_id'=>$id));
    //     $this->Log->saveLogs('删除用户组', 1, array('group_id'=>$id));
    //     WaveCommon::exportResult(true, '成功！');
    // }
    /**
     * 修改用户状态
     */
    public function actionDisable()
    {
        $data = WaveCommon::getFilter($_GET);
        $group_state = (int)$data['group_state'];
        $group_id = (int)$data['group_id'];
        $publicModel = new PublicModel('b_users_group');
        $publicModel->update(array('group_state'=>$group_state),array('group_id'=>$group_id));
        $this->Log->saveLogs('更新用户状态', 1, $data);
        WaveCommon::exportResult(true, '成功！');
    }


}
?>