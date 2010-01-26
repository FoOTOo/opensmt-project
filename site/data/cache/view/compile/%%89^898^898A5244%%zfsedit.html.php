<?php /* Smarty version 2.6.26, created on 2026-06-10 18:23:30
         compiled from element/zfsedit.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>zfs edit</h2>
    <form action="zfsmanage" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>zfs name</label>
                    </th>
		    <td>
		        <input class="regular-text" type="text" readonly="readonly"  name="zfseditname" id="zfseditname" value="<?php echo $this->_tpl_vars['zfs_name']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>mountpoint</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text"  name="mountpoint" id="mountpoint" value="<?php echo $this->_tpl_vars['mountpoint']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>share</label>
                    </th>
                    <td>
                        <select name="share">
                            <?php if ($this->_tpl_vars['share'] == 'on'): ?>
				<option value='on'>on</option>
				<option value='off'>off</option>
                            <?php else: ?>
                                <option value='off'>off</option>
				<option value='on'>on</option>
                            <?php endif; ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>quota</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text"  name="quota" id="quota" value="<?php echo $this->_tpl_vars['quota']; ?>
"/>
                    </td>
                </tr>
		<tr valign="top">
		    <th scope="row">
                        <label>reservation</label>
		    </th>
                    <td>
                        <input class="regular-text" type="text"  name="reservation" id="reservation" value="<?php echo $this->_tpl_vars['reservation']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
		    <th scope="row">
                        <label>others</label>
		    </th>
                    <td>
                        <select name="otherattr">
				    <?php $_from = $this->_tpl_vars['zfs_attr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attr']):
?>
				    <option value = "<?php echo $this->_tpl_vars['attr']; ?>
"><?php echo $this->_tpl_vars['attr']; ?>
</option>
				    <?php endforeach; endif; unset($_from); ?>
			</select>
                    </td>
                </tr>
                <tr valign="top">
		    <th scope="row">
                        <label></label>
		    </th>
                    <td>
                        <input class="regular-text" type="text"  name="othervalue" id="othervalue" value=""/>
                        <pre>
If you want to change other attribute, choose the attribute, and write the value here.And check the result by zfsquery.
                        </pre>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Apply Changes!" name="Submit"/>
        </p>
    </form>
</div>
<script type="text/javascript">
    selElement = 'mountpoint';
    selPath = document.getElementById('mountpoint').getAttribute("value")
    if (selPath == '') selPath = '/'
    $('mountpoint').addEvent('click',function(){
        window.open("<?php echo $this->_tpl_vars['webUrl']; ?>
/file/browser/dir/?dir="+selPath, 'strWindowName', 'strWindowFeatures');
    })
</script>