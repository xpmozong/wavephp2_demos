<?php /* Smarty version 2.6.25-dev, created on 2016-01-16 11:11:59
         compiled from links/index.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
// 删除
var mdelete = function(id){
    if(window.confirm('确定删除？')){
        $.getJSON("<?php echo $this->_tpl_vars['homeUrl']; ?>
links/delete/"+id, function(data){
            if(data.code == true){
                window.location.href = "<?php echo $this->_tpl_vars['homeUrl']; ?>
links";
            }else{
                alert(data.msg);
            }
        })
    }
}

</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">友情链接列表
                <button type="button" class="btn btn-success btn-xs pull-right" onclick="javascript:location.href='<?php echo $this->_tpl_vars['homeUrl']; ?>
links/modify/0'">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 添加链接
                </button>
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="8%">ID</th>
                        <th width="40%">链接标题</th>
                        <th width="32%">链接URL</th>
                        <th width="20%">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['value']['lid']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['value']['title']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['value']['url']; ?>
</td>
                        <td>
                            <button type="button" class="btn btn-info btn-xs" onclick="javascript:location.href='<?php echo $this->_tpl_vars['homeUrl']; ?>
links/modify/<?php echo $this->_tpl_vars['value']['lid']; ?>
'">修改</button>
                            |
                            <button type="button" class="btn btn-danger btn-xs" onclick="mdelete(<?php echo $this->_tpl_vars['value']['lid']; ?>
)">删除</button>
                        </td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>