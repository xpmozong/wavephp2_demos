<?php

/**
 * 通用的树型类
 *
 * 可以生成任意树形结构
 *
 * @version $Id$
 */

class Tree {
    /**
     * 生成树型结构所需要的2维数组
     * @var array
     */
    var $arr = array();

    /**
     * 生成树型结构的字段
     */
    var $colum = array("id"=>"role_id","parent_id"=>"parent_id","name"=>"role_value");
    /**
     * 生成树型结构所需修饰符号，可以换成图片
     * @var array
     */
    var $icon = array('│','├','└');

    /**
     * @access private
     */
    var $ret = '';

    /**
     * 构造函数，初始化类
     * @param array 2维数组，例如：
     * array(
     *      1 => array('sort_role_id'=>'1','parent_id'=>0,'sort_role_value'=>'一级栏目一'),
     *      2 => array('role_id'=>'2','parent_id'=>0,'role_value'=>'一级栏目二'),
     *      3 => array('role_id'=>'3','parent_id'=>1,'role_value'=>'二级栏目一'),
     *      4 => array('role_id'=>'4','parent_id'=>1,'role_value'=>'二级栏目二'),
     *      5 => array('role_id'=>'5','parent_id'=>2,'role_value'=>'二级栏目三'),
     *      6 => array('role_id'=>'6','parent_id'=>3,'role_value'=>'三级栏目一'),
     *      7 => array('role_id'=>'7','parent_id'=>3,'role_value'=>'三级栏目二')
     *      )
     */
    function __construct($arr = array())
    {
        $this->arr = $arr;
        $this->ret = '';

        return is_array($arr);
    }

    /**
     * 得到父级数组
     * @param int
     * @return array
     */
    function get_parent($myid)
    {
        $newarr = array();
        if (!isset($this->arr[$myid])) {
            return false;
        }
        $pid = $this->arr[$myid][$this->colum['parent_id']];
        $pid = $this->arr[$pid][$this->colum['parent_id']];
        if (is_array($this->arr)) {
            foreach ($this->arr as $role_id => $a) {
                if ($a[$this->colum['parent_id']] == $pid) {
                    $newarr[$role_id] = $a;
                }
            }
        }

        return $newarr;
    }

    /**
     * 得到子级数组
     * @param int
     * @return array
     */
    function get_child($myid)
    {
        $a = $newarr = array();
        if (is_array($this->arr)) {
            foreach ($this->arr as $role_id => $a) {
                if ($a[$this->colum['parent_id']] == $myid) {
                    $newarr[$role_id] = $a;
                }
            }
        }

        return $newarr ? $newarr : false;
    }

    /**
     * 得到当前位置数组
     * @param int
     * @return array
     */
    function get_pos($myid, &$newarr)
    {
        $a = array();
        if (!isset($this->arr[$myid])) {
            return false;
        }
        $newarr[] = $this->arr[$myid];
        $pid = $this->arr[$myid][$this->colum['parent_id']];
        if (isset($this->arr[$pid])) {
            $this->get_pos($pid,$newarr);
        }
        if (is_array($newarr)) {
            krsort($newarr);
            foreach ($newarr as $v) {
                $a[$v[$this->colum['id']]] = $v;
            }
        }

        return $a;
    }

    /**
     * 得到树型结构
     * @param int role_id，表示获得这个role_id下的所有子级
     * @param string 生成树型结构的基本代码
     * 例如："<option value=\$role_id \$selected>\$spacer\$role_value</option>"
     * @param int 被选中的role_id，比如在做树型下拉框的时候需要用到
     * @return string
     */
    function get_tree($myid, $str, $sid = 0, $adds = '')
    {
        $nstr = '';
        $number = 1;
        $child = $this->get_child($myid);
        if (is_array($child)) {
            $total = count($child);
            foreach ($child as $role_id => $a) {
                @$a['old_name'] = $a['cat_name'];
                $j = '';
                if ($number == $total) {
                    $j .= $this->icon[2];
                } else {
                    $j .= $this->icon[1];
                }
                $spacer     = $adds ? $adds.$j : '';
                @extract($a);
                eval("\$nstr = \"$str\";");
                $a[$this->colum['name']] = $nstr;
                $this->ret[] = $a;
                $this->get_tree($a[$this->colum['id']], $str, $sid, $adds.'&nbsp;&nbsp;&nbsp;&nbsp;');
                $number++;
            }
        }
        if (!is_array($this->ret)) {
            $this->ret = array();
        }

        return $this->ret;
    }
    
    function set_array_colum($a)
    {
        $this->colum = $a;
    }
}
