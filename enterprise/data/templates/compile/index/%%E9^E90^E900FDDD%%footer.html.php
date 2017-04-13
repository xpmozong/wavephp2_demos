<?php /* Smarty version 2.6.25-dev, created on 2017-04-13 10:52:50
         compiled from layout/footer.html */ ?>
<div class="container links">
    友情链接：
        <?php $_from = $this->_tpl_vars['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a'] => $this->_tpl_vars['value']):
?>
        <a href="<?php echo $this->_tpl_vars['value']['url']; ?>
" target="_blank">
            <?php echo $this->_tpl_vars['value']['title']; ?>

        </a>
        <?php endforeach; endif; unset($_from); ?>
    </ul>
</div>
<hr class="featurette-divider">
<!-- FOOTER -->
<div class="container">
    <p class="pull-right"><a href="#">返回顶部</a></p>
    <p>&copy; 2017 沿途画室. </p>
</div>
<script type="text/javascript">
    $(function(){
        $("#main-menu li.dropdown").hover(function(){
            $(this).addClass("open");
        },function(){
            $(this).removeClass("open");
        })
        ;(function($){
            $.fn.totop=function(opt){
                var scrolling=false;
                return this.each(function(){
                    var $this=$(this);
                    $(window).scroll(function(){
                        // if(!scrolling){
                        //  var sd=$(window).scrollTop();
                        //  if(sd>100){
                        //      $this.fadeIn();
                        //  }else{
                        //      $this.fadeOut();
                        //  }
                        // }
                    });
                    
                    $this.click(function(){
                        scrolling=true;
                        $('html, body').animate({
                            scrollTop : 0
                        }, 500,function(){
                            scrolling=false;
                            $this.fadeOut();
                        });
                    });
                });
            };
        })(jQuery); 
        
        $("#backtotop").totop();
        
        $('#main-im').css("height","272");
        $('#im_main').show();

        $('.go-top').bind('click',function(){
            // $(window).scrollTop(0);
            $('html, body').animate({
                scrollTop : 0
            })
        });
        $('.weixing-show').hide();
        
        $(".weixing-container").bind('mouseenter',function(){
            $('.weixing-show').show();
        })
        $(".weixing-container").bind('mouseleave',function(){        
            $('.weixing-show').hide();
        });

    });
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "layout/debuger.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>