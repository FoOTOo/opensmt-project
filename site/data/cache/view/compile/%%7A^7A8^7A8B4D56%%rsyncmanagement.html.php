<?php /* Smarty version 2.6.26, created on 2026-06-10 14:05:44
         compiled from element/rsyncmanagement.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Services | Rsync</h2>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Max Connections:</label>
                    </th>
		    <td>
			<input class='regular-text' type = "text" name="maxConnections" id = "maxConnections"  value="<?php echo $this->_tpl_vars['maxConnections']; ?>
">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Log File:</label>
                    </th>
		    <td>
                        <input class ='regular-text' type = 'text' name = "logFile" id = "logFile" value = "<?php echo $this->_tpl_vars['logFile']; ?>
" >
                    </td>
                </tr>
                <tr valign="top">
		    <th scope="row">
			<label>Pid File:</label>
                    </th>
		    <td>
                        <input class = 'regular-text' type = 'text' name = 'pidFile' id = 'pidFile' value = "<?php echo $this->_tpl_vars['pidFile']; ?>
">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Syslog Facility:</label>
                    </th>
                    <td width='78%' class='vtable'>
                        <select class='formselect' name='syslog' id='syslog' >
                            <?php $_from = $this->_tpl_vars['syslogOption']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
                                <?php if ($this->_tpl_vars['option'] == $this->_tpl_vars['syslog']): ?>
                                    <option value="<?php echo $this->_tpl_vars['option']; ?>
" selected><?php echo $this->_tpl_vars['option']; ?>
</option>
                                <?php elseif ($this->_tpl_vars['option'] == 'daemon' && $this->_tpl_vars['syslogEmptyFlag']): ?>
                                    <option value="<?php echo $this->_tpl_vars['option']; ?>
" selected><?php echo $this->_tpl_vars['option']; ?>
</option>
                                <?php else: ?>
                                    <option value="<?php echo $this->_tpl_vars['option']; ?>
" ><?php echo $this->_tpl_vars['option']; ?>
</option>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                </tr>
            </tbody>
    	</table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Save and Restart" name="Submit"/>
        </p>
    </form>
</div>
<script type="text/javascript">
    selElement = 'logFile';
    selPath = document.getElementById('logFile').getAttribute("value")
    var parts = new Array();
    parts = selPath.split("/");
    selNewPath = ''
    for (var i = 1; i < parts.length-1; i++) {
        selNewPath = selNewPath + '/' + parts[i]
    }
    $('logFile').addEvent('click',function(){
        window.open("<?php echo $this->_tpl_vars['webUrl']; ?>
/file/browser/dir/?dir="+selNewPath, 'strWindowName', 'strWindowFeatures');
    })
</script>