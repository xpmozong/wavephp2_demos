<?php
/**
 * 网站默认入口控制层
 */
class SiteController extends FController
{
       
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 默认函数
     */
    public function actionIndex()
    {
        $cacheDir = '/data/';
        $cacheFile = ROOT_PATH.$cacheDir.'index.html';
        if (file_exists($cacheFile)) {
            $url = $this->hostInfo.$cacheDir.'index.html';
            $this->redirect($url);
        } else {
            $articlesModel = new Articles();
            $this->classname = 'category';
            $this->list1 = $articlesModel->select('*')
                                    ->in(array('cid'=>'7,8,9'))
                                    ->order('aid')->limit(0,4)
                                    ->getAll();
            $this->list2 = $articlesModel->select('*')
                                    ->in(array('cid'=>'6'))
                                    ->order('aid')->limit(0,4)
                                    ->getAll();
            $this->list3 = $articlesModel->select('*')
                                    ->in(array('cid'=>'11,12,13'))
                                    ->order('aid')->limit(0,4)
                                    ->getAll();
            $this->list4 = $articlesModel->select('*')
                                    ->in(array('cid'=>'5'))
                                    ->order('aid')->limit(0,4)
                                    ->getAll();
            WaveCommon::mkDir(ROOT_PATH.$cacheDir);
            $content = $this->fetch('site/index.html');
            Wave::writeCache($cacheFile, $content);
        }
    }

    public function actionDbtest()
    {
        $insertData = array(
            'user_id' => '3900749415604665',
            'content' => '第三方似懂非懂',
            'cms_content' => '斯蒂芬斯蒂芬的发',
            'post_id' => 7429,
            'reply_post_content_id' => 0,
            'near_reply_post_content_id' => 0,
            'near_reply_post_content_uid' => 0,
            'status' => 1,
            'floor_num' => 1,
            'utime' => 1512357013,
            'ctime' => 1512357013,
        );
        $articlesModel = new Articles();
        $articlesModel->from('juzi_post_content')->insert($insertData);
        echo $articlesModel->lastSql();
        die;
    }

    public function actionTestLang()
    {
        I18n::$lang = 'vi-vn';
        echo i18n::get('平台管理')."<br>";
    }

    public function actionTestReport()
    {
        $this->report('测试弹窗', Wave::app()->homeUrl.'site/testlang', true);
    }

    /**
     * 验证码
     */
    public function actionVerifyCode()
    {
        echo $this->verifyCode('login_code');
    }
    
    public function actionLogin()
    {
        $userinfo = Wave::app()->session->getState('userinfo');
        if (!empty($userinfo)) {
            $this->redirect(Wave::app()->homeUrl);
        } else {
            
        }
    }

    public function actionLoging()
    {
        $data = WaveCommon::getFilter($_POST);
        if (empty($data['user_login']))
            WaveCommon::exportResult(false, '请输入用户名！');

        if (empty($data['user_pass']))
            WaveCommon::exportResult(false, '请输入密码！');
        
        $Users = new Users();
        $array = $Users->getOne('*', array('email'=>$data['user_login']));
        if (!empty($array)) {
            if ($array['password'] == md5($data['user_pass'])) {
                Wave::app()->session->setState('userinfo', $array);
                WaveCommon::exportResult(true, '登录成功！');
            } else {
                WaveCommon::exportResult(false, '用户名或密码错误！');
            }
        } else {
            WaveCommon::exportResult(false, '用户名或密码错误！');
        }
    }

    public function actionRegist()
    {
        
    }

    public function actionRegisting()
    {
        $Users = new Users();
        $data = WaveCommon::getFilter($_POST);
        if (empty($data['email']))
            WaveCommon::exportResult(false, '请输入邮箱！');

        if (empty($data['password']))
            WaveCommon::exportResult(false, '请输入密码！');

        $data['add_date'] = WaveCommon::getDate();
        $data['password'] = md5($data['password']);
        if ($Users->insert($data)) {
            WaveCommon::exportResult(true, '注册成功！');
        } else {
            WaveCommon::exportResult(false, '注册失败！');
        }
    }

    public function actionLogout()
    {
        Wave::app()->session->logout('userinfo');
        $this->jumpBox('退出成功！', Wave::app()->homeUrl.'site', 1);
    }


    public function actionUserinfo()
    {
        $array = array();
        $userinfo = Wave::app()->session->getState('userinfo');
        if (!empty($userinfo)) {
            $array['success'] = true;
            $array['userid'] = $userinfo['userid'];
            $array['username'] = $userinfo['email'];
        } else {
            $array['success'] = false;
        }
        
        echo json_encode($array);die;
    }
}

?>