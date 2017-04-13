<?php /* Smarty version 2.6.25-dev, created on 2017-04-13 10:55:36
         compiled from category/index.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container main">
    <h3><?php echo $this->_tpl_vars['category']['c_name']; ?>
</h3>
    <div id="container">
    <?php if ($this->_tpl_vars['category']['list_cate'] == 1): ?>
        <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a'] => $this->_tpl_vars['value']):
?>
        <div class="item">
            <div class="tc-gridbox">
                <div class="header">
                    <div class="item-image">
                        <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
<?php echo $this->_tpl_vars['classname']; ?>
/article?cid=<?php echo $this->_tpl_vars['cid']; ?>
&aid=<?php echo $this->_tpl_vars['value']['aid']; ?>
">
                            <img class="img-responsive" src="<?php echo $this->_tpl_vars['value']['img']; ?>
" alt="<?php echo $this->_tpl_vars['value']['title']; ?>
">
                        </a>
                    </div>
                    <h3>
                    <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
<?php echo $this->_tpl_vars['classname']; ?>
/article?cid=<?php echo $this->_tpl_vars['cid']; ?>
&aid=<?php echo $this->_tpl_vars['value']['aid']; ?>
"><?php echo $this->_tpl_vars['value']['title']; ?>
</a>
                    </h3>
                    <hr>
                </div>
                <div class="body">
                    <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
<?php echo $this->_tpl_vars['classname']; ?>
/article?cid=<?php echo $this->_tpl_vars['cid']; ?>
&aid=<?php echo $this->_tpl_vars['value']['aid']; ?>
"><?php echo $this->_tpl_vars['value']['intro']; ?>
</a>
                </div>
                <div class="footer">
                    <div class="pull-left">
                        <span class="meta"><?php echo $this->_tpl_vars['value']['add_date']; ?>
</span>
                    </div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
        <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a'] => $this->_tpl_vars['value']):
?>
        <div class="list-boxes">
            <h2>
                <a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
<?php echo $this->_tpl_vars['classname']; ?>
/article?cid=<?php echo $this->_tpl_vars['cid']; ?>
&aid=<?php echo $this->_tpl_vars['value']['aid']; ?>
"><?php echo $this->_tpl_vars['value']['title']; ?>
</a>
            </h2>
            <p><?php echo $this->_tpl_vars['value']['intro']; ?>
</p>
            <div>
                <div class="pull-left">
                    
                </div>
                <a class="btn btn-warning pull-right" href="<?php echo $this->_tpl_vars['homeUrl']; ?>
<?php echo $this->_tpl_vars['classname']; ?>
/article?cid=<?php echo $this->_tpl_vars['cid']; ?>
&aid=<?php echo $this->_tpl_vars['value']['aid']; ?>
">查看更多</a>
            </div>
        </div>
        <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
    </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/loadjs.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>