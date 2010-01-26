<?php /* Smarty version 2.6.26, created on 2026-06-10 08:38:53
         compiled from element/editrsync.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Edit/Add Rsync Modules </h2>

    <form action="default" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Name:</label>
                    </th>
                    <td>
                        <?php if ($this->_tpl_vars['addFlag']): ?>
                            <input class="regular-text" type="text" name="name" id="name" value=""/>
                        <?php else: ?>
                            <input class="regular-text" type="text" readonly="" name="name" id="name" value="<?php echo $this->_tpl_vars['targetName']; ?>
"/>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Comment:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="comment" id="comment" value="<?php echo $this->_tpl_vars['comment']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Path:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="path" id="path" value="<?php echo $this->_tpl_vars['path']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Use Chroot:</label>
                    </th>
		    <td>
                        <?php if ($this->_tpl_vars['chroot'] == 'yes'): ?>
			    <input type = "checkbox" name = "chroot" checked> Checked for using chroot <p>
                        <?php elseif ($this->_tpl_vars['addFlag']): ?>
                            <input type = "checkbox" name = "chroot" checked> Checked for using chroot <p>
                        <?php else: ?>
                            <input type = "checkbox" name = "chroot" checked> Checked for using chroot <p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Listed in Available Modules:</label>
                    </th>
		    <td>
                        <?php if ($this->_tpl_vars['list'] == 'true'): ?>
			    <input type = "checkbox" name = "list" checked> Checked for listed <p>
                        <?php elseif ($this->_tpl_vars['addFlag']): ?>
                            <input type = "checkbox" name = "list" checked> Checked for listed <p>
                        <?php else: ?>
                            <input type = "checkbox" name = "list" > Checked for listed <p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Read Only:</label>
                    </th>
		    <td>
                        <?php if ($this->_tpl_vars['readonly'] == 'true'): ?>
			    <input type = "checkbox" name = "readonly" checked> Checked for read only <p>
                        <?php else: ?>
                            <input type = "checkbox" name = "readonly" > Checked for read only <p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Write Only:</label>
                    </th>
		    <td>
                        <?php if ($this->_tpl_vars['writeonly'] == 'true'): ?>
			    <input type = "checkbox" name = "writeonly" checked> Checked for write only <p>
                        <?php else: ?>
                            <input type = "checkbox" name = "writeonly" > Checked for write only <p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>UID:</label>
                    </th>
                    <td width='78%' class='vtable'>
                        <select class='formselect' name='uid' id='uid' >
                            <?php $_from = $this->_tpl_vars['usernames']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['username']):
?>
                                <?php if ($this->_tpl_vars['username'] == $this->_tpl_vars['uid']): ?>
                                    <option value="<?php echo $this->_tpl_vars['username']; ?>
" selected><?php echo $this->_tpl_vars['username']; ?>
</option>
                                <?php elseif ($this->_tpl_vars['username'] == 'nobody' && $this->_tpl_vars['addFlag']): ?>
                                    <option value="<?php echo $this->_tpl_vars['username']; ?>
" selected><?php echo $this->_tpl_vars['username']; ?>
</option>
                                <?php else: ?>
                                    <option value="<?php echo $this->_tpl_vars['username']; ?>
" ><?php echo $this->_tpl_vars['username']; ?>
</option>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>GID:</label>
                    </th>
                    <td width='78%' class='vtable'>
                        <select class='formselect' name='gid' id='gid' >
                            <?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupname']):
?>
                                <?php if ($this->_tpl_vars['groupname'] == $this->_tpl_vars['gid']): ?>
                                    <option value="<?php echo $this->_tpl_vars['groupname']; ?>
" selected><?php echo $this->_tpl_vars['groupname']; ?>
</option>
                                <?php elseif ($this->_tpl_vars['groupname'] == 'nobody' && $this->_tpl_vars['addFlag']): ?>
                                    <option value="<?php echo $this->_tpl_vars['groupname']; ?>
" selected><?php echo $this->_tpl_vars['groupname']; ?>
</option>
                                <?php else: ?>
                                    <option value="<?php echo $this->_tpl_vars['groupname']; ?>
" ><?php echo $this->_tpl_vars['groupname']; ?>
</option>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Apply Changes" name="editRsync"/>
        </p>
    </form>
</div>
<script type="text/javascript">
    selElement = 'path';
    selPath = document.getElementById('path').getAttribute("value")
    if (selPath == '') selPath = '/'
    $('path').addEvent('click',function(){
        window.open("<?php echo $this->_tpl_vars['webUrl']; ?>
/file/browser/dir/?dir="+selPath, 'strWindowName', 'strWindowFeatures');
    })
</script>