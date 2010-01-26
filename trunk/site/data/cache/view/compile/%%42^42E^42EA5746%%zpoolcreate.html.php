<?php /* Smarty version 2.6.26, created on 2026-06-10 15:52:02
         compiled from element/zpoolcreate.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>zpool create</h2>
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
                        <input class="regular-text" type="text" name="pool_name" id="pool_name" value=""/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>pool type</label>
                    </th>
                    <td>
                        <select name="pool_type">
			    <option value=' '>stripe(default)</option>
			    <option value='mirror'>mirror</option>
			    <option value'raidz'>raidz</option>
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
                    </td>
                </tr>
                
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Create!" name="Submit"/>
        </p>
    </form>
</div>