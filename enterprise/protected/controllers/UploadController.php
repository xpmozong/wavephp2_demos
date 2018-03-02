<?php
/**
 * 上传
 */
class UploadController extends KController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ueditor 上传接口
     */
    public function actionUeditor()
    {
        $ueditorRoot = 'http://' . Wave::app()->request->hostInfo . '/resouce/plugins/ueditor1_4_3_2/';
        $config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents($ueditorRoot . "config/config.json")), true);
        $get = WaveCommon::getFilter($_GET);
        switch ($get['action']) {
            case 'config':
                $result =  json_encode($config);
                break;
            case 'uploadimage':
                $upfile = $_FILES[$config['imageFieldName']];
                $ajaxReturn = array(
                        "state"     => "上传失败",          //上传状态，上传成功时必须返回"SUCCESS"
                        "url"       => "",                  //返回的地址
                        "title"     => "",                  //新文件名
                        "original"  => $upfile['name'],     //原始文件名
                        "type"      => $upfile['type'],     //文件类型
                        "size"      => $upfile['size']      //文件大小
                    );
                if ( $upfile['error'] === 0 ) {
                    $type = 'upfile';
                    $month = WaveCommon::getYearMonth();
                    $projectPath = Wave::app()->projectPath;
                    $saveDir = 'data/'.$type.'/'.$month;
                    $uploadConfig = array();
                    $uploadConfig['mimes'] = WaveCommon::getImageTypes();
                    array_push($uploadConfig['mimes'],
                                'application/x-shockwave-flash',
                                'application/octet-stream',
                                'video/x-flv',
                                'image/x-icon');
                    $uploadConfig['savePath'] = $projectPath.$saveDir;
                    $uploadConfig['maxSize'] = 1024*1024*10;
                    $uploadConfig['exts'] = array('jpg', 'gif', 'png', 'jpeg', 'swf', 'flv', 'ico', 'bmp');
                    $waveUpload = new WaveUpload($uploadConfig);
                    $updateInfo = $waveUpload->upload($_FILES);
                    $imgurl = '';
                    if (!empty($updateInfo)) {
                        $imgurl = 'http://'.$this->hostInfo.'/'.$saveDir.'/'.$updateInfo[$type]['savename'];
                    }
                    if (!empty($imgurl)) {
                        // 请求成功
                        $ajaxReturn['state'] = 'SUCCESS';
                        $ajaxReturn['url'] = $imgurl;
                        $ajaxReturn['title'] = pathinfo($imgurl, PATHINFO_BASENAME);
                    } else {
                        // 请求失败
                        $ajaxReturn['state'] = 'Failure';
                    }

                } else {
                    $errorMsg = array('', '大小超过限制', '大小超过限制', '文件只有部分被上传', '没有文件被上传', '上传文件大小为0');
                    $ajaxReturn['state'] = $errorMsg[$upfile['error']];
                }
                $result = json_encode($ajaxReturn);
                break;
            default:
                # code...
                $result = json_encode(array('state' => '参数不合法'));
                break;
        }
        if (isset($get["callback"])) {
            if (preg_match("/^[\w_]+$/", $get["callback"])) {
                echo htmlspecialchars($get["callback"]) . '(' . $result . ')';
            } else {
                echo json_encode(array(
                    'state'=> 'callback参数不合法'
                ));
            }
        } else {
            exit($result);
        }
    }
}

?>
