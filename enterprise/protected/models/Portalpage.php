<?php
/**
 * 页面管理表
 */
class Portalpage extends Model
{
    protected function init() {
        $this->_tableName = $this->getTablePrefix().'portalpage';
    }
}
?>