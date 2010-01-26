<?php /* Smarty version 2.6.26, created on 2026-06-10 14:05:31
         compiled from element/status.html */ ?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<div class = "admin-panel-wrap">
	<div class = "icon32 icon-options-general">
		<br/>
	</div>
	<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<h2>Services | Status</h2>
  	<body>
		<form action = "" method = "post">
		<table class = "form-table">
			<tbody>
				<tr valign = "top">
					<th scope = "row">
						<label> Service </label>
					</th>
					<th scope = "row">
						<label> Setting </label>
					</th>
					<th scope = "row">
						<label> Status </label>
					</th>
					<th scope = "row">
						<label> Enable/Disable </label>
					</th>
				</tr>
				<tr valign = "top">
					<th scope = "row">
						<label> CIFS/SMB </label>
					</th>
					<td>
						<a href = "../default/smbmanagement">Setting</a>
					</td>
					<?php if ($this->_tpl_vars['osmbstatus'] == 'on'): ?>
					<td> Enabled </td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'smbenable' value = "Disable"></td>
					<?php else: ?>
					<td>Disabled</td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'smbenable' value = "Enable"></td>
					<?php endif; ?>
				</tr>
				<tr valign = "top">
					<th scope = "row">
						<label> FTP </label>
					</th>
					<td>
						<a href = "../default/ftpmanagement">Setting</a>
					</td>
					<?php if ($this->_tpl_vars['oftpstatus'] == 'on'): ?>
					<td> Enabled </td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'ftpenable' value = "Disable"></td>
					<?php else: ?>
					<td>Disabled</td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'ftpenable' value = "Enable"></td>
					<?php endif; ?>
				</tr>
				<tr valign = "top">
					<th scope = "row">
						<label> SSH </label>
					</th>
					<td>
						<a href = "../default/sshmanagement">Setting</a>
					</td>
					<?php if ($this->_tpl_vars['osshstatus'] == 'on'): ?>
					<td> Enabled </td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'sshenable' value = "Disable"></td>
					<?php else: ?>
					<td>Disabled</td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'sshenable' value = "Enable"></td>
					<?php endif; ?>
				</tr>
				<tr valign = "top">
					<th scope = "row">
						<label> NFS </label>
					</th>
					<td>
						<a href = "../default/nfsmanagement">Setting</a>
					</td>
					<?php if ($this->_tpl_vars['onfsstatus'] == 'on'): ?>
					<td> Enabled </td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'nfsenable' value = "Disable"></td>
					<?php else: ?>
					<td>Disabled</td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'nfsenable' value = "Enable"></td>
					<?php endif; ?>
				</tr>
                                <tr valign = "top">
					<th scope = "row">
						<label> Rsync </label>
					</th>
					<td>
						<a href = "../default/rsyncmanagement">Setting</a>
					</td>
					<?php if ($this->_tpl_vars['orsyncdstatus'] == 'on'): ?>
					<td> Enabled </td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'rsyncdenable' value = "Disable"></td>
					<?php else: ?>
					<td>Disabled</td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'rsyncdenable' value = "Enable"></td>
					<?php endif; ?>
				</tr>
				<tr valign = "top">
					<th scope = "row">
						<label> Webserver </label>
					</th>
					<td>
						<a href = "../default/httpmanagement">Setting</a>
					</td>
					<?php if ($this->_tpl_vars['ohttpstatus'] == 'on'): ?>
					<td> Enabled </td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'httpenable' value = "Disable"></td>
					<?php else: ?>
					<td>Disabled</td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'httpenable' value = "Enable"></td>
					<?php endif; ?>
				</tr>
				<tr valign = "top">
					<th scope = "row">
						<label> ISCSI/Target </label>
					</th>
					<td>----
					</td>
					<?php if ($this->_tpl_vars['otargetstatus'] == 'on'): ?>
					<td> Enabled </td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'targetenable' value = "Disable"></td>
					<?php else: ?>
					<td>Disabled</td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'targetenable' value = "Enable"></td>
					<?php endif; ?>
				</tr>
				<tr valign = "top">
					<th scope = "row">
						<label> System/STMF </label>
					</th>
					<td>
						----
					</td>
					<?php if ($this->_tpl_vars['ostmfstatus'] == 'on'): ?>
					<td> Enabled </td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'stmfenable' value = "Disable"></td>
					<?php else: ?>
					<td>Disabled</td>
					<td><input class = 'button-secondary action doaction' type = "submit" name = 'stmfenable' value = "Enable"></td>
					<?php endif; ?>
				</tr>

			</tbody>
		</table>
		<input class = "regular-text" type = "hidden" readonly = "" name = "oftpstatus" id = "oftpstatus" value = "<?php echo $this->_tpl_vars['oftpstatus']; ?>
">
		<input class = "regular-text" type = "hidden" readonly = "" name = "osmbstatus" id = "osmbstatus" value = "<?php echo $this->_tpl_vars['osmbstatus']; ?>
">
		<input class = "regular-text" type = "hidden" readonly = "" name = "osshstatus" id = "osshstatus" value = "<?php echo $this->_tpl_vars['osshstatus']; ?>
">
		<input class = "regular-text" type = "hidden" readonly = "" name = "ohttpstatus" id = "ohttpstatus" value = "<?php echo $this->_tpl_vars['ohttpstatus']; ?>
">
		<input class = "regular-text" type = "hidden" readonly = "" name = "onfsstatus" id = "onfsstatus" value = "<?php echo $this->_tpl_vars['onfsstatus']; ?>
">
		<input class = "regular-text" type = "hidden" readonly = "" name = "otargetstatus" id = "otargetstatus" value = "<?php echo $this->_tpl_vars['otargetstatus']; ?>
">
		<input class = "regular-text" type = "hidden" readonly = "" name = "ostmfstatus" id = "ostmfstatus" value = "<?php echo $this->_tpl_vars['ostmfstatus']; ?>
">
                <input class = "regular-text" type = "hidden" readonly = "" name = "orsyncdstatus" id = "orsyncdstatus" value = "<?php echo $this->_tpl_vars['orsyncdstatus']; ?>
">
		</form>

  </body>
</div>