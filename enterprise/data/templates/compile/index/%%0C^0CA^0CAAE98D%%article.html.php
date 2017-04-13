<?php /* Smarty version 2.6.25-dev, created on 2017-04-13 10:57:02
         compiled from category/article.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="container main">
    <div class="tc-box first-box article-box">
        <h2><?php echo $this->_tpl_vars['data']['title']; ?>
</h2>
        <div class="article-infobox">
            <span>发布时间：<?php echo $this->_tpl_vars['data']['add_date']; ?>
</span>
        </div>
        <hr>
        <div id="article_content">
            <?php echo $this->_tpl_vars['data']['content']; ?>

        </div>

        <!-- 多说评论框 start -->
        <div class="ds-thread" data-thread-key="<?php echo $this->_tpl_vars['data']['aid']; ?>
" data-title="<?php echo $this->_tpl_vars['data']['title']; ?>
" data-url="http://<?php echo $this->_tpl_vars['hostInfo']; ?>
<?php echo $this->_tpl_vars['REQUEST_URI']; ?>
"></div>
        <!-- 多说评论框 end -->
        <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
        <script type="text/javascript">
        var duoshuoQuery = {short_name:"yantuhs"};
            (function() {
                var ds = document.createElement('script');
                ds.type = 'text/javascript';ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0] 
                 || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
            </script>
        <!-- 多说公共JS代码 end -->
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