<?php /* Smarty version 2.6.26, created on 2026-06-10 20:18:53
         compiled from element/editnfs.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Edit/Add NFS Share Directory </h2>

    <form action="nfs" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Path:</label>
                    </th>
                    <td>
                        <?php if ($this->_tpl_vars['nfsArg'][0]): ?>
                            <input class="regular-text" type="text" readonly="" name="path" id="path" value="<?php echo $this->_tpl_vars['nfsArg'][0]; ?>
"/>
                        <?php else: ?>
                            <input class="regular-text" type="text" name="path" id="path" value=""/>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Read Only:</label>
                    </th>
		    <td>
                        <?php if ($this->_tpl_vars['nfsArg'][1] == 'ro'): ?>
			    <input type = "checkbox" name = "authority" checked> Set Read Only <p>
                        <?php else: ?>
                            <input type = "checkbox" name = "authority" > Set Read Only <p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Authorised Network:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="ip" id="ip" value="<?php echo $this->_tpl_vars['nfsArg'][2]; ?>
"/>
                        <select name="mask">
                            <?php if ($this->_tpl_vars['nfsArg'][3] == '0'): ?>
                                <option value="0" selected>0</option>
                            <?php else: ?>
                                <option value="0" >0</option>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['nfsArg'][3] == '8'): ?>
                                <option value="8" selected>8</option>
                            <?php else: ?>
                                <option value="8" >8</option>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['nfsArg'][3] == '16'): ?>
                                <option value="16" selected>16</option>
                            <?php else: ?>
                                <option value="16" >16</option>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['nfsArg'][3] == '24' || $this->_tpl_vars['nfsArg'][3] == ''): ?>
                                <option value="24" selected>24</option>
                            <?php else: ?>
                                <option value="24" >24</option>
                            <?php endif; ?>
			</select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Description:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="description" id="description" value="<?php echo $this->_tpl_vars['nfsArg'][4]; ?>
"/>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Apply Changes" name="editNfs"/>
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