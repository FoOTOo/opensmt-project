<?php /* Smarty version 2.6.26, created on 2026-06-10 17:57:42
         compiled from element/httpmanagement.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Services|Webserver</h2>
    <form action="" method="post">    
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Protocol</label>
                    </th>
		    <td>
			<select name = "protocol">
			    <option value = 'HTTP'>HTTP</option>
			    <option value = 'HTTPS'>HTTPS</option>
			</select>
                    </td>
                </tr>
 		<tr valign = "top">
		    <th scope = "row">
			<label>Port</label>
		    </th>
		    <td>
				<input class = 'small-text' type = 'text' name = "port" value = "<?php echo $this->_tpl_vars['oport']; ?>
">
			    <br></br>
			    TCP port to bind the server to.
		    </td>
	    	</tr>

 		<tr valign = "top">
		    <th scope = "row">
			<label>Document root</label>
		    </th>
		    <td>
				<input class = 'regular-text' type = 'text' name = "document_root" id ="document_root" value = "<?php echo $this->_tpl_vars['odocument_root']; ?>
"><br></br>
		    </td>
	    	</tr>

 		<tr valign = "top">
		    <th scope = "row">
			<label>Authentication</label>
		    </th>
		    <td>
			    <input type = checkbox name = "authentication"><br></br>
			    Enable authentication.<br></br>
			    Give only local users access to the web page.
		    </td>
	    	</tr>
	    
 		<tr valign = "top">
		    <th scope = "row">
			<label>Directory listing</label>
		    </th>
		    <td>
			    <input type = checkbox name = "directory_listing"><br></br>
			    Enable directory listing.<br></br>
			    A directory listing is generated if a directory is requested and no index-file (index.php, index.html, index.htm or default.htm) was found in that directory.
		    </td>
	    	</tr>
            </tbody>
		</table>
		<input class = 'regular-text' type = "hidden" readonly = "" name = "oport" id = "oport" value = "<?php echo $this->_tpl_vars['oport']; ?>
">
		<input class = 'regular-text' type = "hidden" readonly = "" name = "odocument_root" id = "odocument_root" value = "<?php echo $this->_tpl_vars['odocument_root']; ?>
">
        <p class="submit">
            <input class="button-primary" type="submit" value="Save and Restart" name="Submit"/>
        </p>
    </form>
</div>
<script type="text/javascript">
    selElement = 'document_root';
    selPath = document.getElementById('document_root').getAttribute("value")
    if (selPath == '') selPath = '/'
    $('document_root').addEvent('click',function(){
        window.open("<?php echo $this->_tpl_vars['webUrl']; ?>
/file/browser/dir/?dir="+selPath, 'strWindowName', 'strWindowFeatures');
    })
</script>