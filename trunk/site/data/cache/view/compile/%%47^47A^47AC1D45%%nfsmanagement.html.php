<?php /* Smarty version 2.6.26, created on 2026-06-10 14:05:41
         compiled from element/nfsmanagement.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Services | NFS</h2>
    <form action="" method="post">    
        <table class="form-table">
			<tbody>
 		<tr valign = "top">
		    <th scope = "row">
			<label>lowest server version</label>
		    </th>
		    <td>
				<input class = 'small-text' type = 'text' name = "nfs_server_versmin" value = "<?php echo $this->_tpl_vars['onfs_server_versmin']; ?>
"><br>
			    Set the lowest version of the nfs server protocol version. Default 2, other values 3 or 4.
		    </td>
	    </tr>
 		<tr valign = "top">
		    <th scope = "row">
			<label>highest server version</label>
		    </th>
		    <td>
				<input class = 'small-text' type = 'text' name = "nfs_server_versmax" value = "<?php echo $this->_tpl_vars['onfs_server_versmax']; ?>
"><br>
			    Set the highest version of the nfs server protocol version. Default 4, other values 2 or 3.
			</td>
		</tr>

 		<tr valign = "top">
		    <th scope = "row">
			<label>lowest client version</label>
		    </th>
		    <td>
				<input class = 'small-text' type = 'text' name = "nfs_client_versmin" value = "<?php echo $this->_tpl_vars['onfs_client_versmin']; ?>
"><br>
			    Set the highest version of the nfs client protocol version. Default 2, other values 3, 4.
			</td>
		</tr>

 		<tr valign = "top">
		    <th scope = "row">
			<label>highest client version</label>
		    </th>
		    <td>
				<input class = 'small-text' type = 'text' name = "nfs_client_versmax" value = "<?php echo $this->_tpl_vars['onfs_client_versmax']; ?>
"><br>
			    Set the highest version of the nfs client protocol version. Default 4, other values 2, 3.
			</td>
		</tr>
        </tbody>
	</table>
	<input class = 'regular-text' type = "hidden" readonly = "" name = "onfs_client_versmax" id = "onfs_client_versmax" value = "<?php echo $this->_tpl_vars['onfs_client_versmax']; ?>
">
	<input class = 'regular-text' type = "hidden" readonly = "" name = "onfs_client_versmin" id = "onfs_client_versmin" value = "<?php echo $this->_tpl_vars['onfs_client_versmin']; ?>
">
	<input class = 'regular-text' type = "hidden" readonly = "" name = "onfs_server_versmin" id = "onfs_server_versmin" value = "<?php echo $this->_tpl_vars['onfs_server_versmin']; ?>
">
	<input class = 'regular-text' type = "hidden" readonly = "" name = "onfs_server_versmax" id = "onfs_server_versmax" value = "<?php echo $this->_tpl_vars['onfs_server_versmax']; ?>
">
	<p class="submit">
            <input class="button-primary" type="submit" value="Save and Restart" name="Submit"/>
        </p>
    </form>
</div>