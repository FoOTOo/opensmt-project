<?php /* Smarty version 2.6.26, created on 2026-06-09 21:39:52
         compiled from element/lan.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>LAN Setup</h2>
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
                        <label>Hostname:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="nodename" id="nodename" value="<?php echo $this->_tpl_vars['nodename']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>DHCP:</label>
                    </th>
		    <td>
                        <?php if ($this->_tpl_vars['dhcp']): ?>
			    <input type = "checkbox" name = "dhcp" checked>Check for Enable DHCP<p>
                        <?php else: ?>
                            <input type = "checkbox" name = "dhcp" >Check for Enable DHCP<p>
                        <?php endif; ?>
                        <br>
                        Once dhcp is enabled, there is no need to modify the following IP address yourself.
                    </td>
          
                        
          
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>IPv4:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="ipv4" id="ipv4" value="<?php echo $this->_tpl_vars['ipv4']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>IPv4 Netmask:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="mask" id="mask" value="<?php echo $this->_tpl_vars['netmask']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Gateway:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="gateway" id="gateway" value="<?php echo $this->_tpl_vars['gateway']; ?>
"/>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            After change IP address, you need to access OpenSMT GUI with new IP.<br>
            <input class="button-primary" type="submit" value="Save and Restart!" name="Submit"/>
        </p>
    </form>
</div>