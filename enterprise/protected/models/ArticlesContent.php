<?php
/**
 * 文章类
 */
class ArticlesContent extends Model
{
    protected function init() {
        $this->_tableName = $this->getTablePrefix().'articles_content';
    }
}
?>