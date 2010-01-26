<?php /* Smarty version 2.6.26, created on 2026-06-11 12:03:22
         compiled from snippet/content.html */ ?>
<div class="content">
    <div class="innercontent-side">
        <ul id="adminmenu" class="adminmenu">
            <li id="menu-dashboard" class="first-item  menu-top menu-top-first menu-top-last <?php if ($this->_tpl_vars['menucurrent'] == '__index__'): ?>has-current-submenu<?php endif; ?>">
                <div class="menu-image">
                    <br/>
                </div>
                <div class="menu-toggle">
                    <br/>
                </div>
                <a class="first-item  menu-top menu-top-first menu-top-last <?php if ($this->_tpl_vars['menucurrent'] == '__index__'): ?>has-current-submenu<?php endif; ?>" tabindex="1" href="<?php echo $this->_tpl_vars['webUrl']; ?>
" >index</a>
            </li>
            <li class="menu-separator"></li>
            
            <?php $_from = $this->_tpl_vars['adminmenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['foo']['iteration']++;
?>
            
            <li id ="menu-<?php echo $this->_tpl_vars['item']['id']; ?>
" class="has-submenu <?php if (($this->_foreach['foo']['iteration']-1) == 0): ?>menu-top-first<?php endif; ?> <?php if ($this->_tpl_vars['item']['current'] == $this->_tpl_vars['menucurrent']): ?>has-current-submenu<?php endif; ?> <?php if ($this->_tpl_vars['item']['open'] == $this->_tpl_vars['menuopen']): ?>menu-open<?php endif; ?> <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>menu-top-last<?php else: ?><?php endif; ?>">
                <div class="menu-image">
                    <br/>
                </div>
                <div class="menu-toggle">
                    <br/>
                </div>
                <a class="has-submenu menu-top <?php if (($this->_foreach['foo']['iteration']-1) == 0): ?>menu-top-first<?php endif; ?> <?php if ($this->_tpl_vars['item']['current'] == $this->_tpl_vars['menucurrent']): ?>has-current-submenu<?php endif; ?> <?php if ($this->_tpl_vars['item']['open'] == $this->_tpl_vars['menuopen']): ?>menu-open<?php endif; ?> <?php if (($this->_foreach['foo']['iteration'] == $this->_foreach['foo']['total'])): ?>menu-top-last<?php else: ?><?php endif; ?>" tabindex="1" href="javascript:;" onclick="return false;"><?php echo $this->_tpl_vars['item']['desc']; ?>
</a>
                <div class="submenu">
                    <div class="submenu-head"><?php echo $this->_tpl_vars['item']['id']; ?>
</div>
                    <?php $this->assign('submenu', $this->_tpl_vars['item']['sub']); ?>
                   
                    <ul>
                        <?php $_from = $this->_tpl_vars['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menu']):
?>
                        <li <?php if ($this->_tpl_vars['subaction'] == $this->_tpl_vars['menu']['action']): ?>class="current"<?php endif; ?>>
                           
                            <a tabindex="1" <?php if ($this->_tpl_vars['subaction'] == $this->_tpl_vars['menu']['action']): ?>class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['webUrl']; ?>
<?php echo $this->_tpl_vars['menu']['href']; ?>
" ><?php echo $this->_tpl_vars['menu']['text']; ?>
</a>
                        </li>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </div>
            </li>
            <?php endforeach; endif; unset($_from); ?>
            <li class="menu-separator"></li>

        </ul>
        <div class="admin-panel">
            <div id="screen-meta" class="screen-meta" style="display: none;">
                <div id="show-help-link-wrap" class="screen-meta-panel">
                    <h5>在屏幕上显示帮助</h5>
                </div>
                <div id="show-settings-link-wrap" class="screen-meta-panel">
                    <h5>在屏幕上显示设置</h5>
                </div>
                <div id="screen-meta-links" class="screen-meta-links">
                    <div class="screen-meta-toggle">
                        <a id="show-help-link" class="show-settings" href="javascript:;"  onclick="return false;">帮助</a>
                    </div>
                    <div class="screen-meta-toggle" >
                        <a id="show-settings-link" class="show-settings" href="javascript:;" onclick="return false;">显示选项</a>
                    </div>
                </div>
            </div>
            <div class="update-nag" style="display: none;">
                Welcome openSMT
                <a href="javascript:;" onclick="return false;">readme</a>
                。
            </div>
            <?php if ($this->_tpl_vars['tplfile']): ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tplfile']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php else: ?>
            <?php echo $this->_tpl_vars['tpldata']; ?>

            <?php endif; ?>
        </div>
        <div class="clear"></div>
    </div>
</div>