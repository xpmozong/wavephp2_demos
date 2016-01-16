<?php /* Smarty version 2.6.25-dev, created on 2016-01-16 11:14:07
         compiled from service/index.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container marketing content">
    <div class="col-sm-2 blog-sidebar">
        <ul class="nav nav-sidebar list-group">
            <li class="list-group-item <?php echo '<?php'; ?>
 if($data['sid'] == 6) echo 'active';<?php echo '?>'; ?>
">
                <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
service/index/6">桌面服务</a>
            </li>
            <li class="list-group-item <?php echo '<?php'; ?>
 if($data['sid'] == 7) echo 'active';<?php echo '?>'; ?>
">
                <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
service/index/7">网络服务</a>
            </li>
            <li class="list-group-item <?php echo '<?php'; ?>
 if($data['sid'] == 8) echo 'active';<?php echo '?>'; ?>
">
                <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
service/index/8">系统服务</a>
            </li>
            <li class="list-group-item <?php echo '<?php'; ?>
 if($data['sid'] == 9) echo 'active';<?php echo '?>'; ?>
">
                <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
service/index/9">办公设备服务</a>
            </li>
            <li class="list-group-item <?php echo '<?php'; ?>
 if($data['sid'] == 10) echo 'active';<?php echo '?>'; ?>
">
                <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
service/index/10">数据安全</a>
            </li>
            <li class="list-group-item <?php echo '<?php'; ?>
 if($data['sid'] == 11) echo 'active';<?php echo '?>'; ?>
">
                <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
service/index/11">IT设备迁移</a>
            </li>
        </ul>
    </div>
    <div class="col-sm-10 blog-main">
        <div class="panel panel-default">
            <div class="panel-heading">
                您当前位置：
                <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
">首页</a> &gt;
                服务项目 &gt;
                <?php echo $this->_tpl_vars['data']['title']; ?>

            </div>
            <div class="panel-body">
                <?php echo $this->_tpl_vars['data']['content']; ?>

            </div>
        </div>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>