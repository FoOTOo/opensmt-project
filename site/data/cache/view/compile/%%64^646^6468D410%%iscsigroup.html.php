<?php /* Smarty version 2.6.26, created on 2026-06-10 20:53:01
         compiled from element/iscsigroup.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <div class="admin-panel-wrap">
        <h2>Target Group</h2>
        <form class="posts-filter" action="addtgmember" method="post" id="group">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="15%">Group</th>
			<th class="manage-column column-author" style="" scope="col" width="49%">Memeber</th>
                        <th class="manage-column column-author" style="" scope="col" width="12%"></th>
                        <th class="manage-column column-author" style="" scope="col" width="12%"></th>
                        <th class="manage-column column-author" style="" scope="col" width="12%"></th>
                    </tr>
	    	</thead>
		<tbody>
        		<?php $_from = $this->_tpl_vars['myArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['row']):
?>
			<tr>
				<td><?php echo $this->_tpl_vars['k']; ?>
</td>
                                <td class='vtable'>
                                    <select class='formselect' name='tgmember' id='tgmember' size='10' style="height: 50px; width: 450px">
                                        <?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
                                        <option value="<?php echo $this->_tpl_vars['member']; ?>
" ><?php echo $this->_tpl_vars['member']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
				</td>
				<td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['k']; ?>
" value="Add Member" />
	    			</td>
                                <td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['k']; ?>
D" value="Delete Member" onclick="document.getElementById('group').action='default'"/>
	    			</td>
                                <td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['k']; ?>
G" value="Delete Group" onclick="document.getElementById('group').action='default'"/>
	    			</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
            </table>
        </form>
        <form action="addtg" method="post">
        <p class="submit">
            <input class="button-primary" type="submit" value="Add new Target Group" name="addtg" />
        </p>
        </form>
    </div>
    <div class="admin-panel-wrap">
        <h2>Host Group</h2>
        <form class="posts-filter" action="addhgmember" method="post" id="group2">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="15%">Group</th>
			<th class="manage-column column-author" style="" scope="col" width="49%">Memeber</th>
                        <th class="manage-column column-author" style="" scope="col" width="12%"></th>
                        <th class="manage-column column-author" style="" scope="col" width="12%"></th>
                        <th class="manage-column column-author" style="" scope="col" width="12%"></th>
                    </tr>
	    	</thead>
		<tbody>
        		<?php $_from = $this->_tpl_vars['myArray2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['row']):
?>
			<tr>
				<td><?php echo $this->_tpl_vars['k']; ?>
</td>
                                <td class='vtable'>
                                    <select class='formselect' name='hgmember' id='hgmember' size='10' style="height: 50px; width: 450px">
                                        <?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
                                        <option value="<?php echo $this->_tpl_vars['member']; ?>
" ><?php echo $this->_tpl_vars['member']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
				</td>
				<td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['k']; ?>
" value="Add Member" />
	    			</td>
                                <td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['k']; ?>
D" value="Delete Member" onclick="document.getElementById('group2').action='default'"/>
	    			</td>
                                <td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['k']; ?>
G" value="Delete Group" onclick="document.getElementById('group2').action='default'"/>
	    			</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
            </table>
        </form>
        <form action="addhg" method="post">
        <p class="submit">
            <input class="button-primary" type="submit" value="Add new Host Group" name="addhg" />
        </p>
        </form>
    </div>
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
</div>