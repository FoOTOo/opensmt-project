<?php /* Smarty version 2.6.26, created on 2026-06-10 17:38:27
         compiled from element/zpoolop.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>zpool op</h2>
    <?php if ($this->_tpl_vars['execMessage']): ?>
    <div id="execMessage" class="updated fade" style="background-color: rgb(255, 251, 204);">
        <?php unset($this->_sections['line']);
$this->_sections['line']['name'] = 'line';
$this->_sections['line']['loop'] = is_array($_loop=$this->_tpl_vars['execMessage']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['line']['show'] = true;
$this->_sections['line']['max'] = $this->_sections['line']['loop'];
$this->_sections['line']['step'] = 1;
$this->_sections['line']['start'] = $this->_sections['line']['step'] > 0 ? 0 : $this->_sections['line']['loop']-1;
if ($this->_sections['line']['show']) {
    $this->_sections['line']['total'] = $this->_sections['line']['loop'];
    if ($this->_sections['line']['total'] == 0)
        $this->_sections['line']['show'] = false;
} else
    $this->_sections['line']['total'] = 0;
if ($this->_sections['line']['show']):

            for ($this->_sections['line']['index'] = $this->_sections['line']['start'], $this->_sections['line']['iteration'] = 1;
                 $this->_sections['line']['iteration'] <= $this->_sections['line']['total'];
                 $this->_sections['line']['index'] += $this->_sections['line']['step'], $this->_sections['line']['iteration']++):
$this->_sections['line']['rownum'] = $this->_sections['line']['iteration'];
$this->_sections['line']['index_prev'] = $this->_sections['line']['index'] - $this->_sections['line']['step'];
$this->_sections['line']['index_next'] = $this->_sections['line']['index'] + $this->_sections['line']['step'];
$this->_sections['line']['first']      = ($this->_sections['line']['iteration'] == 1);
$this->_sections['line']['last']       = ($this->_sections['line']['iteration'] == $this->_sections['line']['total']);
?>
        <p>
            <strong><?php echo $this->_tpl_vars['execMessage'][$this->_sections['line']['index']]; ?>
</strong>
        </p>
        <?php endfor; endif; ?>
    </div>
    <?php else: ?>
    <?php endif; ?>
    <form action="" method="post">    
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>pool name</label>
                    </th>
		    <td>
			    <select name="poolName">
				    <?php $_from = $this->_tpl_vars['zpoolName']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
                        <label>op type</label>
                    </th>
                    <td>
                        <select name="opType">
				<option value='destroy'>destroy</option>
				<option value='add'>add</option>
				<option value='attach'>attach</option>
				<option value='detach'>detach</option>
				<option value='clear'>clear</option>
				<option value='replace'>replace</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>vdevice type</label>
                    </th>
                    <td>
                        <select name="vdeviceType">
				<option value=' '>stripe(default)</option>
				<option value='mirror'>mirror</option>
				<option value='raidz'>raidz</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Disks</label>
                    </th>
                    <td>
			<select name="disk1">
				<?php $_from = $this->_tpl_vars['diskName']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['disk']):
?>
                            	<option value="<?php echo $this->_tpl_vars['disk']; ?>
"><?php echo $this->_tpl_vars['disk']; ?>
</option>
                            	<?php endforeach; endif; unset($_from); ?>
			</select>
                    </td>
                </tr>
		<tr valign="top">
		    <th scope="row">
		    </th>
                    <td>
			<select name="disk2">
                                <option value=""></option>
				<?php $_from = $this->_tpl_vars['diskName']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['disk']):
?>
                            	<option value="<?php echo $this->_tpl_vars['disk']; ?>
"><?php echo $this->_tpl_vars['disk']; ?>
</option>
                            	<?php endforeach; endif; unset($_from); ?>
			</select>
                    </td>
                </tr>
		<tr valign="top">
		    <th scope="row">
		    </th>
                    <td>
			<select name="disk3">
                                <option value=""></option>
				<?php $_from = $this->_tpl_vars['diskName']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['disk']):
?>
                            	<option value="<?php echo $this->_tpl_vars['disk']; ?>
"><?php echo $this->_tpl_vars['disk']; ?>
</option>
                            	<?php endforeach; endif; unset($_from); ?>
			</select>
                        <pre>
If you want to destroy a zpool, choose the pool and ignore all of these disk choices.
If you want to add a vdevice to a current pool, choose the vdevice type and the disks just like zpool create.
If you want to attach to a vdevice, you can just choose the disk, and we will automatically attach it to the first disk of the the pool.
If you want to replace a disk, choose the disk you want to be replaced in the first selection box and in the second choose the new disk.
                        </pre>
                    </td>
                </tr>
               
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Do!" name="Submit"/>
        </p>
    </form>
</div>