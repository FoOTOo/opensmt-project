<?php /* Smarty version 2.6.26, created on 2026-06-10 20:25:40
         compiled from element/ftpmanagement.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Services | FTP</h2>
    <?php if ($this->_tpl_vars['execMessage']): ?> 
    <div id = "execMessage" class = "updated fade" style = "background-color: rgb(255, 251, 204);">
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
                        <label>File Transfer Protocol</label>
                    </th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>TCP port</label>
                    </th>
		    <td>
				<input class='small-text' type = "text" name="port" id = "port"  value="<?php echo $this->_tpl_vars['oport']; ?>
"> Default is 21.
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Number of clients</label>
                    </th>
		    <td>
			    <input class ='small-text' type = 'text' name = "clients_num" id = "clients_num" value = 5> Maximum number of simultaneous clients.
                    </td>
                </tr>
                <tr valign="top">
		    <th scope="row">
			<label>Max. conn. per IP</label>
                    </th>
		    <td>
			    <input class = 'small-text' type = 'text' name = 'max_conn' id = 'max_conn' value = 2>Maximum number of connections per IP address (0 = unlimited).
                    </td>
                </tr>
                <tr valign="top">
		    <th scope="row">
			<label>Max. login attempts</label>
                    </th>
		    <td>
			    <input class = 'small-text' type = 'text' name = 'max_login' id = 'max_login' value = "<?php echo $this->_tpl_vars['originLogin']; ?>
"> Maximum number of allowed password attempts before disconnection.
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Timeout</label>
                    </th>
		    <td>
				<input class = 'small-text' type = 'text' name = 'timeout' id = 'timeout' value = "<?php echo $this->_tpl_vars['otimeout']; ?>
">Maximum idle time in seconds.
		    </td>
	        </tr>
 		<tr valign = "top">
		    <th scope = "row">
			<label>Permit root login</label>
		    </th>
		    <td>
			    <input type = checkbox name = "permit_root_login"> Specifies whether it is allowed to login as superuser (root) directly. 
		    </td>
	    	</tr>

 		<tr valign = "top">
		    <th scope = "row">
			<label>Anonymous users only</label>
		    </th>
		    <td>
			    <input type = checkbox name = "anonymous_user_only">Only allow anonymous users. Use this on a public FTP site with no remote FTP access to real accounts. 
		    </td>
	    	</tr>

 		<tr valign = "top">
		    <th scope = "row">
			<label>Local users only</label>
		    </th>
		    <td>
			    <input type = checkbox name = "local_user_only"> Only allow authenticated users. Anonymous logins are prohibited. 
		    </td>
	    	</tr>
	    
 		<tr valign = "top">
		    <th scope = "row">
			<label>Banner</label>
		    </th>
		    <td>
				<textarea name = "Banner"><?php echo $this->_tpl_vars['obanners']; ?>
</textarea><br>
			    Greeting banner displayed by FTP when a connection first comes in.
		    </td>
	    	</tr>
            </tbody>
    	</table>
		<input class="regular-text" type = hidden readonly="" name = "originLogin" id = "originLogin" value = "<?php echo $this->_tpl_vars['originLogin']; ?>
"/>
		<input class="regular-text" type = hidden readonly="" name = "obanners" id = "obanners" value = "<?php echo $this->_tpl_vars['obanners']; ?>
"/>
		<input class="regular-text" type = hidden readonly="" name = "otimeout" id = "otimeout" value = "<?php echo $this->_tpl_vars['otimeout']; ?>
"/>
		<input class="regular-text" type = hidden readonly="" name = "oport" id = "oport" value = "<?php echo $this->_tpl_vars['oport']; ?>
"/>
        <p class="submit">
            <input class="button-primary" type="submit" value="Save and Restart" name="Submit"/>
        </p>
    </form>
</div>