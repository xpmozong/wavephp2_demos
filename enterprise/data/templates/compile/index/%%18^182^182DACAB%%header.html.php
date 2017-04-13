<?php /* Smarty version 2.6.25-dev, created on 2017-04-13 10:52:50
         compiled from layout/header.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $this->_tpl_vars['baseUrl']; ?>
/resouce/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $this->_tpl_vars['baseUrl']; ?>
/resouce/css/index.css" rel="stylesheet">
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
/resouce/bootstrap/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="<?php echo $this->_tpl_vars['baseUrl']; ?>
/resouce/bootstrap/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <div class="main-im">
        <!-- <div id="open_im" class="open-im">&nbsp;</div> -->  
        <div class="im_main" id="im_main">
            <!-- <div id="close_im" class="close-im"><a href="javascript:void(0);" title="点击关闭">&nbsp;</a></div> -->
            <a href="http://wpa.qq.com/msgrd?v=3&uin=727248092&site=qq&menu=yes" target="_blank" class="im-qq qq-a" title="在线QQ客服">
                <div class="qq-container"></div>
                <div class="qq-hover-c"><img class="img-qq" src="http://7xr7ff.com1.z0.glb.clouddn.com/qq.png"></div>
                <span> QQ在线咨询</span>
            </a>
            <div class="im-tel">
                <div>咨询热线</div>
                <div class="tel-num">189-0378-1265</div>
                <div class="tel-num">181-3777-7746</div>
            </div>
            <div class="im-footer" style="position:relative">
                <div class="weixing-container">
                    <div class="weixing-show">
                        <div class="weixing-txt">微信扫一扫<br>打开沿途画室</div>
                        <img class="weixing-ma" src="http://7xr7ff.com1.z0.glb.clouddn.com/homeweixin.png">
                        <div class="weixing-sanjiao"></div>
                        <div class="weixing-sanjiao-big"></div>
                    </div>
                </div>
                <div class="go-top"><a href="javascript:;" title="返回顶部"></a> </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php echo $this->_tpl_vars['title']; ?>
</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $this->_tpl_vars['homeUrl']; ?>
"><?php echo $this->_tpl_vars['title']; ?>
</a>
            </div>
            <div id="mymenu" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php $_from = $this->_tpl_vars['menuList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
                        <?php if (empty ( $this->_tpl_vars['value']['child'] )): ?>
                            <li><a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
<?php echo $this->_tpl_vars['value']['menu_url']; ?>
"><?php echo $this->_tpl_vars['value']['menu_name']; ?>
</a></li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->_tpl_vars['value']['menu_name']; ?>
 <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php $_from = $this->_tpl_vars['value']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                    <li><a href="<?php echo $this->_tpl_vars['homeUrl']; ?>
<?php echo $this->_tpl_vars['v']['menu_url']; ?>
"><?php echo $this->_tpl_vars['v']['menu_name']; ?>
</a></li>
                                    <?php endforeach; endif; unset($_from); ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>