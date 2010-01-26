<?php /* Smarty version 2.6.26, created on 2026-06-10 20:46:24
         compiled from element/lunview.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Add view</h2>
    <form action="default" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>LUN Name</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" readonly="" name="lun_name" id="lun_name" value="<?php echo $this->_tpl_vars['lun_name']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Host group</label>
                     </th>
                     <td>
			    <select name="host_group">
                                    <option value="">All</option>
                                    <?php $_from = $this->_tpl_vars['hg_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hg']):
?>
                                    <option value="<?php echo $this->_tpl_vars['hg']; ?>
"><?php echo $this->_tpl_vars['hg']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
			    </select>
                      </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Target group</label>
                     </th>
                     <td>
			    <select name="target_group">
                                    <option value="">All</option>
				    <?php $_from = $this->_tpl_vars['tg_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tg']):
?>
                                    <option value="<?php echo $this->_tpl_vars['tg']; ?>
"><?php echo $this->_tpl_vars['tg']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
			    </select>
                      </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Add view" name="addview"/>
        </p>
    </form>
        <div class="metabox-holder poststuff">
        <form method="post" action="post.php" onsubmit="return false;">
            <div class="postbox">
                        <div class="handlediv" title="显示/隐藏">
                            <br/>
                        </div>
                        <h3 class="hndle">
                            <span>View Info</span>
                        </h3>
                        <div class="inside">
                            <div class="inside-body">
                                <pre id="execMessage"><?php echo $this->_tpl_vars['execMessage']; ?>
</pre>
                            </div>
                        </div>
                    </div>
            <div class="clear"></div>
        </form>
    </div>
</div>