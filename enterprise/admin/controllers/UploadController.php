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
     * 上传
     */
    public function actionIndex()
    {
        $fn = $_GET['CKEditorFuncNum'];
        $type = isset($data['type']) ? $data['type'] : 'upload';
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
        if (!empty($updateInfo)) {
            $imgurl = 'http://'.$this->hostInfo.'/'.$saveDir.'/'.$updateInfo[$type]['savename'];
            echo '<script type="text/javascript">
            window.parent.CKEDITOR.tools.callFunction("'.$fn.'","'.$imgurl.'","上传成功");
            </script>';
        }else{
            echo '<script type="text/javascript">
            window.parent.CKEDITOR.tools.callFunction("'.$fn.'","",'.$waveUpload->getError().');
            </script>';
        }
    }
}

?>