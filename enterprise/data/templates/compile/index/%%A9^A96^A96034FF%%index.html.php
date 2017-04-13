<?php /* Smarty version 2.6.25-dev, created on 2017-04-13 10:58:58
         compiled from site/index.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="http://7xr7ff.com1.z0.glb.clouddn.com/1.jpg" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <p>沿途美术培训</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="http://7xr7ff.com1.z0.glb.clouddn.com/2.jpg" alt="Second slide">
                <div class="container">
                    <div class="carousel-caption">
                        <p>沿途教育  专注名校  从未改变</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="http://7xr7ff.com1.z0.glb.clouddn.com/3.jpg" alt="Third slide">
                <div class="container">
                    <div class="carousel-caption">
                        <p>沿途成绩</p>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div><!-- /.carousel -->

    <div class="container" id="container">
        <div class="main-title">
            <h3 class="text-center">优秀作品</h3>
        </div>
        <div class="row">
            <?php $_from = $this->_tpl_vars['list1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
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
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?>
        </div>

        <div class="main-title">
            <h3 class="text-center">教师团队</h3>
        </div>
        <div class="row">
            <?php $_from = $this->_tpl_vars['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
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
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?>
        </div>

        <div class="main-title">
            <h3 class="text-center">校园记录</h3>
        </div>
        <div class="row">
            <?php $_from = $this->_tpl_vars['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
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
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?>
        </div>

        <div class="main-title">
            <h3 class="text-center">高考咨询</h3>
        </div>
        <div class="row">
            <?php $_from = $this->_tpl_vars['list4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
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
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?>
        </div>

    </div><!-- /.container -->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/loadjs.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
    $(function(){
        // carousel demo
        $('#myCarousel').carousel({
            interval: 2000
        })
    })
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>