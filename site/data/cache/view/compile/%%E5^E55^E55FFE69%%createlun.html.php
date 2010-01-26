<?php /* Smarty version 2.6.26, created on 2026-06-10 20:45:43
         compiled from element/createlun.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>LUN create</h2>
    <form action="default" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>zfs father</label>
                    </th>
		    <td>
			    <select name="zfs_name">
				    <?php $_from = $this->_tpl_vars['zfsName']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['zpool']):
?>
				    <option value = "<?php echo $this->_tpl_vars['zpool']; ?>
"><?php echo $this->_tpl_vars['zpool']; ?>
</option>
				    <?php endforeach; endif; unset($_from); ?>
			    </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>name</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="name" id="name" value=""/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Size</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="size" id="size" value=""/>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Create!" name="luncreate"/>
        </p>
    </form>
</div>