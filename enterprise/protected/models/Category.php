<?php
/**
 * 分类类
 */
class Category extends Model
{
    protected function init() {
        $this->_tableName = $this->getTablePrefix().'category';
    }
}
?>