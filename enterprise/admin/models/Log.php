<?php
/**
 * 日志类
 */
class Log extends Model
{
    protected function init() {
        $this->_tableName = 'b_admin_log';
    }
    /**
     * 记录日志
     */
    public function saveLogs($description = '', $remark = 1, $parameters = array())
    {
        $data = array();
        $userinfo = Wave::app()->session->getState('userinfo');
        $data['username'] = @$userinfo['username'];
        $data['time'] = time();
        $data['description'] = $description;
        $data['remark'] = $remark;
        $data['client_ip'] = Request::getInstance()->getClientIp();
        if ($parameters) {
            $p = '';
            foreach ($parameters as $key => $value) {
                $v = '';
                if (is_array($value)) {
                    $v = implode(',', $value);
                } else {
                    $v = $value;
                }
                $p .= $key.'='.$v.' | ';
            }
            $data['parameters'] = $p;
        }
        $this->insert($data);
    }
}
?>