<?php /* Smarty version 2.6.26, created on 2026-06-11 07:40:43
         compiled from element/samba.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <?php if ($this->_tpl_vars['smbshare']): ?>
    <div class="admin-panel-wrap">
        <h2>Samba Share List</h2>
        <form class="posts-filter" action="editsamba" method="post" id="samba">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="30%">Path</th>
			<th class="manage-column column-author" style="" scope="col">Name</th>
                        <th class="manage-column column-author" style="" scope="col" width="25%">Comment</th>
                        <th class="manage-column column-author" style="" scope="col" width="15%">Browseable</th>
                        <th class="manage-column column-author" style="" scope="col"></th>
                        <th class="manage-column column-author" style="" scope="col"></th>
                    </tr>
	    	</thead>
		<tbody>
        		<?php $_from = $this->_tpl_vars['smbshare']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sharename'] => $this->_tpl_vars['shareinfo']):
?>
			<tr>
				<td><?php echo $this->_tpl_vars['shareinfo'][$this->_tpl_vars['pa']]; ?>
</td>
                                <td><?php echo $this->_tpl_vars['sharename']; ?>
</td>
                                <td><?php echo $this->_tpl_vars['shareinfo'][$this->_tpl_vars['comm']]; ?>
</td>
                                <td><?php echo $this->_tpl_vars['shareinfo'][$this->_tpl_vars['browse']]; ?>
</td>
				<td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['sharename']; ?>
" value="Edit" />
	    			</td>
                                <td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['sharename']; ?>
D" value="Delete" onclick="document.getElementById('samba').action='samba'"/>
	    			</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
            </table>

        </form>
        <form action="editsamba" method="post">
        <p class="submit">
            <input class="button-primary" type="submit" value="Add New Samba Share" name="addsamba" />
        </p>
        </form>
    </div>
    <?php else: ?>
    <?php endif; ?>
</div>