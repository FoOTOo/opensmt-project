<?php /* Smarty version 2.6.26, created on 2026-06-10 14:05:38
         compiled from element/sshmanagement.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Services|SSH</h2>
    <form action="" method="post">    
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Secure Shell</label>
                    </th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>TCP port</label>
                    </th>
		    <td>
			    <input class='small-text' type = "text" name="port" id = "port"  value="22">  	
			    Alternate TCP port. Default is 22
                    </td>
                </tr>
 		<tr valign = "top">
		    <th scope = "row">
			<label>Permit root login</label>
		    </th>
			<td>
				<?php if ($this->_tpl_vars['opermit_root_login'] == 'yes'): ?>
				<input type = checkbox name = "permit_root_login" checked> Specifies whether it is allowed to login as superuser (root) directly.
				<?php else: ?>
				<input type = checkbox name = "permit_root_login"> Specifies whether it is allowed to login as superuser (root) directly.
				<?php endif; ?>
		    </td>
	    	</tr>

 		<tr valign = "top">
		    <th scope = "row">
			<label>Password authentication</label>
		    </th>
			<td>
				<?php if ($this->_tpl_vars['opassword_authentication'] == 'yes'): ?>
			    <input type = checkbox name = "password_authentication" checked>
				Enable keyboard-interactive authentication.
				<?php else: ?>
				<input type = checkbox name = "password_authentication" >
				Enable keyboard-interactive authentication.
				<?php endif; ?>	
		    </td>
	    	</tr>

 		<tr valign = "top">
		    <th scope = "row">
			<label>TCP forwarding</label>
		    </th>
			<td>
				<?php if ($this->_tpl_vars['otcp_forwarding'] == 'yes'): ?>
				<input type = checkbox name = "tcp_forwarding" checked>
			    Permit to do SSH Tunneling. 
				<?php else: ?>
				<input type = checkbox name = "tcp_forwarding">
				Permit to do SSH Tunneling. 
				<?php endif; ?>
		    </td>
	    	</tr>
	    
 		<tr valign = "top">
		    <th scope = "row">
			<label>Private Key</label>
		    </th>
		    <td>
			    <textarea name = "private_key"></textarea><br></br>
			    Paste a DSA PRIVATE KEY in PEM format here.
		    </td>
	    	</tr>

            </tbody>
		</table>
		<input class = "regular-text" type = "hidden" readonly = "" name = "opermit_root_login" id = "opermit_root_login" value = "<?php echo $this->_tpl_vars['opermit_root_login']; ?>
">
		<input class = "regular-text" type = "hidden" readonly = "" name = "opassword_authentication" id = "opassword_authentication" value = "<?php echo $this->_tpl_vars['opassword_authentication']; ?>
">
		<input class = "regular-text" type = "hidden" readonly = "" name = "otcp_forwarding" id = "otcp_forwarding" value = "<?php echo $this->_tpl_vars['otcp_forwarding']; ?>
">
        <p class="submit">
            <input class="button-primary" type="submit" value="Save and Restart" name="Submit"/>
        </p>
    </form>
</div>