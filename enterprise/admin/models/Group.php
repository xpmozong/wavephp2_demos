<?php
/**
 * 用户权限表
 */
class Group extends Model
{
    protected function init()
    {
        $this->_tableName = 'b_users_group';
        $this->cache = Wave::app()->redis;
    }

    public function getgroup($groupid)
    {
        $group = $this->getOne('menu_ids',array('group_id'=>$groupid));
        return $group;
    }

}
?>