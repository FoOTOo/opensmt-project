<?php /* Smarty version 2.6.26, created on 2026-06-10 18:43:25
         compiled from element/zfssnapshot.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>

    <?php if ($this->_tpl_vars['myArray']): ?>
    <div class="admin-panel-wrap">
        <h2>zfs snapshot</h2>
        <form class="posts-filter" action="" method="post">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="25%">Name</th>
			<th class="manage-column column-author" style="" scope="col">Used</th>
			<th class="manage-column column-author" style="" scope="col">Avail</th>
			<th class="manage-column column-author" style="" scope="col">Refer</th>
			<th class="manage-column column-author" style="" scope="col">Mount Point</th>
                        <th class="manage-column column-author" style="" scope="col"></th>
                    </tr>
	    	</thead>
		<tbody>
        		<?php unset($this->_sections['line']);
$this->_sections['line']['name'] = 'line';
$this->_sections['line']['loop'] = is_array($_loop=$this->_tpl_vars['myArray']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr>
				<?php $_from = $this->_tpl_vars['myArray'][$this->_sections['line']['index']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['col']):
?>
				<td><?php echo $this->_tpl_vars['col']; ?>
</td>
				<?php endforeach; endif; unset($_from); ?>
                                <td>
                                    <input class="button-secondary action doaction" type="submit" value="Destroy!" name="<?php echo $this->_sections['line']['index']; ?>
"/>
                                </td>
			</tr>
			<?php endfor; endif; ?>
		</tbody>
            </table>
        </form>
    </div>
    <?php else: ?>
    <?php endif; ?>
    <br/><br/><br/>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>zfs name</label>
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
                        <label>snapshot name</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="snapshot_name" id="zfs_name" value=""/>
                    </td>
                </tr>
               
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Create!" name="Submit"/>
        </p>
    </form>
    <br/><br/><br/>
     <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>snapshot name</label>
                    </th>
		    <td>
			    <select name="rollback_name">
				    <?php $_from = $this->_tpl_vars['zfssnapshot']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['snapshot']):
?>
				    <option value = "<?php echo $this->_tpl_vars['snapshot']; ?>
"><?php echo $this->_tpl_vars['snapshot']; ?>
</option>
				    <?php endforeach; endif; unset($_from); ?>
			    </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Rollback!" name="rollback" />
        </p>
    </form>
</div>