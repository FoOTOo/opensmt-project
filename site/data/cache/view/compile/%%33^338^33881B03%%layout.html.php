<?php /* Smarty version 2.6.26, created on 2026-06-11 12:03:22
         compiled from layout.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['_baseUrl']; ?>
/Global.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['_baseUrl']; ?>
/Style.css" type="text/css" media="all" />

        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['_baseUrl']; ?>
/Color.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['_baseUrl']; ?>
/Ui.css" type="text/css" media="all" />
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['_baseUrl']; ?>
/mootools-1.2.4-core.js"></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['_baseUrl']; ?>
/mootools-1.2.4.1-more.js"></script>
        <?php if ($this->_tpl_vars['authCheck'] == true): ?>

        <?php else: ?>
            <link rel="stylesheet" href="<?php echo $this->_tpl_vars['_baseUrl']; ?>
/Login.css" type="text/css" media="all" />
        <?php endif; ?>
        <!--[if gte IE 6]>
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['_baseUrl']; ?>
/ie.css" type="text/css" media="all" />
        <![endif]-->
        <script type="text/javascript">
            //<![CDATA[

            window.addEvent('domready', function() {
                var favorite_inside = $('favorite-inside');
                var favorite_first = $('favorite-first');
                
                if(favorite_inside != null && favorite_first != null){
                    favorite_inside.setStyle('display ', 'block');
                    if (favorite_first.offsetWidth < favorite_inside.offsetWidth) {
                        favorite_first.setStyle('width', favorite_inside.offsetWidth - 4 + 'px');
                        favorite_inside.setStyle('width', favorite_first.offsetWidth - 4 + 'px');
                    }
                    favorite_inside.setStyle('display', 'none');
                    favorite_inside.setStyle('width', favorite_first.offsetWidth - 4 + 'px');
                }
                $$('.handlediv').each(function(element) {
                    element.addEvent('click', function() {
                        var parent = this.parentNode;
                        if (parent.get('class').trim() == 'postbox') {
                            $(parent).addClass('closed')
                        } else {
                            $(parent).removeClass('closed');
                        }
                    });
                });
                $$('.menu-toggle').each(function(element) {
                    element.addEvent('click', function() {
                        var parent = this.parentNode;
                        parent = $(parent);
                        if(parent.get('id') =='menu-dashboard')
                            return false;
                        if (parent.hasClass('menu-open')) {
                            parent.removeClass('menu-open');
                        } else {
                            parent.addClass('menu-open');
                        }
                    })
                })
                $$('.favorite-toggle').each(function(element) {
                    element.addEvent('click', function() {
                        var ffirst = $('favorite-first');
                        var finside = $('favorite-inside');
                        if (ffirst.get('class').trim() == 'favorite-first') {
                            ffirst.addClass('slide-down');
                            finside.removeClass('slideUp');
                            finside.addClass('slideDown');
                            finside.setStyle('display', 'block');

                        } else {
                            ffirst.removeClass('slide-down');
                            finside.removeClass('slideDown');
                            finside.addClass('slideUp');
                            finside.setStyle('display', 'none');
                        }
                    })
                })
                $$('.show-settings').each(function(element) {
                    element.addEvent('click', function() {
                        if (this.get('class').trim() == 'show-settings') {
                            $(this.get('id') + '-wrap').setStyle('display', 'block');
                            $$('.show-settings').removeClass('open');
                            $$('.screen-meta-toggle').addClass('invisible');
                            this.removeClass('invisible').addClass('open');
                            this.parentNode.removeClass('invisible')

                        } else {
                            $$('.screen-meta-panel').setStyle('display', 'none');
                            $$('.show-settings').removeClass('open');
                            $$('.screen-meta-toggle').removeClass('invisible');
                        }
                    })
                })
                //editor =  $('iframeName在在').contentWindow;


                //editor.document.open();
                //editor.document.writeln('<html><body onclick="alert(window);"></body></html>');
                // editor.document.close();
                //editor.document.designMode="On";
                // editor.document.contentEditable =true;
                //  editor.document.body.name = "alert('a')"
                //var editor = new Editor();
            })
            //]]>

        </script>
        

        <title>manage <?php $_from = $this->_tpl_vars['pageTitle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?> &rsaquo; <?php echo $this->_tpl_vars['item']; ?>
<?php endforeach; endif; unset($_from); ?></title>
    </head>
    <body>
        <div class="wrap">
            <div class="innerwrap">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "snippet/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php if ($this->_tpl_vars['authCheck'] == true): ?>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "snippet/content.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php else: ?>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "snippet/login.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php endif; ?>
                
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "snippet/otherElement.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "snippet/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
        </div>
    </body>
</html>