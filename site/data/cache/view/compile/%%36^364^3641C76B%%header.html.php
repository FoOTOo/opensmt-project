<?php /* Smarty version 2.6.26, created on 2026-06-11 12:03:22
         compiled from snippet/header.html */ ?>
<div class="head">
    <div class="innerhead">
        <div class="head-logo">
        </div>
        <h1>
            <a href="javascript:;" onclick="return false;" title="查看站点">openSMT <span>&larr; View</span></a>
        </h1>
        <div class="head-info">
            <div class="user_info">
                <?php if ($this->_tpl_vars['authCheck'] == true): ?>
                <p>
                    <a title="Edit your profile" href="javascript:;" onclick="return false;"><?php echo $this->_tpl_vars['cue_user_name']; ?>
</a>
                    <span class="turbo-nag hidden" style="display: inline;"> | <a href="javascript:;" onclick="return false;">Settings</a></span> |
                    <a title="退出" href="<?php echo $this->_tpl_vars['webUrl']; ?>
/auth/login/logout">logout</a>
                </p>
                <?php endif; ?>
            </div>
        </div>
        <!--
        
        -->
    </div>
</div>