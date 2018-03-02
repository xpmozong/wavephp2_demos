<?php
/**
 * 用户管理控制层
 */
class UsersController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        $this->subtitle = '用户管理';
        $this->pclass = 'manage';
        $this->classname = 'users';
        $this->subname = 'users';
        $this->judgePermission($this->subname);
    }

    /**
     * 用户列表
     */
    public function actionIndex()
    {
        
    }

    /**
     * 用户列表JSON
     */
    public function actionJsonlist()
    {
        $start = $this->getRequest()->getInt('iDisplayStart');
        $pagesize = $this->getRequest()->getInt('iDisplayLength');
        $Users = new Users();
        $list = $Users->select('u.*,g.group_name')
                    ->from('b_users u')
                    ->join('b_users_group g', 'u.group_id=g.group_id')
                    ->limit($start, $pagesize)
                    ->order('userid')
                    ->getAll();
        $iTotal = $Users->getCount('*');
        $output = array(
            "sEcho" => $_GET['sEcho'],
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );
        $modifyUrl = Wave::app()->homeUrl.$this->classname.'/modify/';
        foreach ($list as $key => $value) {
            $list[$key]['is_active'] = $value['is_active'] ? '<font color="green">启用</font>' : '<font color="red">禁用</font>';
            $list[$key]['operation'] = '<a href="'.$modifyUrl.$value['userid'].'" class="btn btn-xs btn-info">编辑</a> | ';
            if ($value['is_active']) {
                $list[$key]['operation'] .= '<a href="javascript:void(0)" onclick="enable('.$value['is_active'].','.$value['userid'].')" class="btn btn-xs btn-danger">禁用</a>';
            } else {
                $list[$key]['operation'] .= '<a href="javascript:void(0)" onclick="enable('.$value['is_active'].','.$value['userid'].')" class="btn btn-xs btn-success">启用</a>';
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
        $Users = new Users();
        $id = (int)$id;
        $this->data = $Users->getOne('*', array('userid'=>$id));

        $groupModel = new Group();
        $this->groups = $groupModel->getAll('*');
    }

    /**
     * 提交信息
     */
    public function actionModified()
    {
        $data = WaveCommon::getFilter($_POST);
        $userid = (int)$data['userid'];
        unset($data['userid']);
        $Users = new Users();
        $returnUrl = Wave::app()->homeUrl.$this->classname;

        $old_avatar = $data['old_avatar'];
        unset($data['old_avatar']);
        
        if (!empty($_FILES['avatar']['tmp_name'])) {
            $imgTypeArr = WaveCommon::getImageTypes();
            if (!in_array($_FILES['avatar']['type'], $imgTypeArr)) {
                $this->jumpBox('头像格式不正确！', $returnUrl, 1);
            } else {
                $projectPath = Wave::app()->projectPath;
                $uploadPath = $projectPath.'data/uploadfile/admin_avatar';
                if (!is_dir($uploadPath)) mkdir($uploadPath, 0777);

                $old_avatar_path = $uploadPath.'/'.$old_avatar;
                if (!empty($old_avatar) && file_exists($old_avatar_path)) {
                    unlink($old_avatar_path);
                }

                $imgType = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1));
                $imageName = time().'_'.rand().'.'.$imgType;

                $imgPath = $uploadPath.'/'.$imageName;
                if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $imgPath)) {
                    $this->jumpBox('头像失败！', $returnUrl, 1);
                }
                $data['avatar'] = $imageName;
            }
        }

        if ($userid == 0) {
            unset($data['oldemail']);
            $count = $Users->getCount('*', array('email' => $data['email']));
            if ($count > 0) {
                $this->jumpBox('邮箱不能重复！', $returnUrl, 1);
            }
            $data['password'] = md5($data['password']);
            $data['add_date'] = date('Y-m-d H:i:s');
            $userid = $Users->insert($data);
            $data['userid'] = $userid;
            $this->Log->saveLogs('添加用户', 1, $data);
        } else {
            if ($data['oldemail'] != $data['email']) {
                $count = $Users->getCount('*', array('email' => $data['email']));
                if ($count > 0) {
                    $this->jumpBox('邮箱不能重复！', $returnUrl, 1);
                }
            }
            unset($data['oldemail']);
            if (!empty($data['password'])) {
                $data['password'] = md5($data['password']);
            } else {
                unset($data['password']);
            }
            $Users->update($data, array('userid'=>$userid));
            $data['userid'] = $userid;
            $this->Log->saveLogs('更新用户', 1, $data);
        }

        $this->jumpBox('成功！', $returnUrl, 1);
    }

    // /**
    //  * 删除
    //  */
    // public function actionDelete($id)
    // {
    //     $id = (int)$id;
    //     $Users = new Users();
    //     $Users->delete(array('userid'=>$id));
    //     $this->Log->saveLogs('删除用户', 1, array('userid'=>$id));
    //     WaveCommon::exportResult(true, '成功！');
    // }

    /**
     * 修改用户状态
     */
    public function actionDisable()
    {
        $data = WaveCommon::getFilter($_GET);
        $is_active = (int)$data['is_active'];
        $userid = (int)$data['userid'];
        $Users = new Users();
        $Users->update(array('is_active'=>$is_active),array('userid'=>$userid));
        $this->Log->saveLogs('更新用户状态', 1, $data);
        WaveCommon::exportResult(true, '成功！');
    }
}

?>