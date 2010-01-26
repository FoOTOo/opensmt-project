<?php /* Smarty version 2.6.26, created on 2026-06-10 14:05:39
         compiled from element/smbmanagement.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <div class="admin-panel-wrap">
    <h2>Services | CIFS/SMB | Settings </h2>
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
    <form class="posts-filter" action="" method="post">
        <table class="form-table">
            <tbody>
 		<tr valign = "top">
		    <th scope = "row">
			<label>NetBIOS name</label>
		    </th>
		    <td>
                        <input class = 'regular-text' type = 'text' name = "netbios" value = "<?php echo $this->_tpl_vars['originNetbios']; ?>
">
		    </td>
	    	</tr>
                <tr valign = "top">
		    <th scope = "row">
			<label>Workgroup</label>
		    </th>
		    <td>
                        <input class = 'regular-text' type = 'text' name = "workgroup" value = "<?php echo $this->_tpl_vars['originWorkgroup']; ?>
"><br>
		    </td>
	    	</tr>
 		<tr valign="top">
                    <th scope="row">
                        <label>Security</label>
                    </th>
		    <td>
			<select name = "security">
			    <option value = 'user'>user</option>
			    <option value = 'share'>share</option>
			</select>
                    </td>
                </tr>

                <tr valign = "top">
		    <th scope = "row">
		        <label>Unix charset</label>
		    </th>
		    <td>
			    <select name = "unixCharset">
                                <?php $_from = $this->_tpl_vars['unixcharset']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ucs']):
?>
                                <?php if ($this->_tpl_vars['ucs'] == $this->_tpl_vars['originUnixcharset']): ?>
                                <option value="<?php echo $this->_tpl_vars['ucs']; ?>
" selected><?php echo $this->_tpl_vars['ucs']; ?>
</option>
                                <?php else: ?>
                                <option value="<?php echo $this->_tpl_vars['ucs']; ?>
"><?php echo $this->_tpl_vars['ucs']; ?>
</option>
                                <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
      			    </select>
		    </td>
	    	</tr>

                <tr valign = "top">
		    <th scope = "row">
		        <label>Dos charset</label>
		    </th>
		    <td>
			    <select name = "dosCharset">
                                <?php $_from = $this->_tpl_vars['doscharset']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dcs']):
?>
                                <?php if ($this->_tpl_vars['ucs'] == $this->_tpl_vars['originDoscharset']): ?>
                                <option value="<?php echo $this->_tpl_vars['dcs']; ?>
" selected><?php echo $this->_tpl_vars['dcs']; ?>
</option>
                                <?php else: ?>
                                <option value="<?php echo $this->_tpl_vars['dcs']; ?>
"><?php echo $this->_tpl_vars['dcs']; ?>
</option>
                                <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
      			    </select>
		    </td>
	    	</tr>
                
                <tr valign = "top">
		    <th scope = "row">
		        <label>Display charset</label>
		    </th>
		    <td>
			    <select name = "displayCharset">
                                <?php $_from = $this->_tpl_vars['displaycharset']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discs']):
?>
                                <?php if ($this->_tpl_vars['ucs'] == $this->_tpl_vars['originDisplaycharset']): ?>
                                <option value="<?php echo $this->_tpl_vars['discs']; ?>
" selected><?php echo $this->_tpl_vars['discs']; ?>
</option>
                                <?php else: ?>
                                <option value="<?php echo $this->_tpl_vars['discs']; ?>
"><?php echo $this->_tpl_vars['discs']; ?>
</option>
                                <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
      			    </select>
		    </td>
	    	</tr>
                
                <tr valign = "top">
		    <th scope = "row">
			<label>Guest account</label>
		    </th>
		    <td>
                        <input class = 'regular-text' type = 'text' name = "guestAccount" value = "<?php echo $this->_tpl_vars['originGuestaccount']; ?>
">
		    </td>
	    	</tr>
            </tbody>
        </table>
        <input class="regular-text" type="hidden" readonly="" name="originNetbios" id="originNetbios" value="<?php echo $this->_tpl_vars['originNetbios']; ?>
"/>
        <input class="regular-text" type="hidden" readonly="" name="originWorkgroup" id="originWorkgroup" value="<?php echo $this->_tpl_vars['originWorkgroup']; ?>
"/>
        <input class="regular-text" type="hidden" readonly="" name="originSecurity" id="originSecurity" value="<?php echo $this->_tpl_vars['originSecurity']; ?>
"/>
        <input class="regular-text" type="hidden" readonly="" name="originUnixcharset" id="originUnixcharset" value="<?php echo $this->_tpl_vars['originUnixcharset']; ?>
"/>
        <input class="regular-text" type="hidden" readonly="" name="originDoscharset" id="originDoscharset" value="<?php echo $this->_tpl_vars['originDoscharset']; ?>
"/>
        <input class="regular-text" type="hidden" readonly="" name="originDisplaycharset" id="originDisplaycharset" value="<?php echo $this->_tpl_vars['originDisplaycharset']; ?>
"/>
        <input class="regular-text" type="hidden" readonly="" name="originGuestaccount" id="originGuestaccount" value="<?php echo $this->_tpl_vars['originGuestaccount']; ?>
"/>
        <p class="submit">
            <input class="button-primary" type="submit" value="Save and Restart!" name="Submit"/>
        </p>
    </form>
    </div>
</div>