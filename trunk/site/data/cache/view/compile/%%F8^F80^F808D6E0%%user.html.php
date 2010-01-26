<?php /* Smarty version 2.6.26, created on 2026-06-10 20:19:25
         compiled from element/user.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <?php if ($this->_tpl_vars['users']): ?>
    <div class="admin-panel-wrap">
        <h2>Users List</h2>
        <form class="posts-filter" action="edituser" method="post" id="user">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="10%">Username</th>
			<th class="manage-column column-author" style="" scope="col" width="8%">Uid</th>
			<th class="manage-column column-author" style="" scope="col" width="8%">Gid</th>
			<th class="manage-column column-author" style="" scope="col">Comment</th>
			<th class="manage-column column-author" style="" scope="col">homeDir</th>
			<th class="manage-column column-author" style="" scope="col">Shell</th>
                        <th class="manage-column column-author" style="" scope="col"></th>
                        <th class="manage-column column-author" style="" scope="col"></th>
                    </tr>
	    	</thead>
		<tbody>
        		<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
			<tr>
				<?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['col']):
?>
				<td><?php echo $this->_tpl_vars['col']; ?>
</td>
				<?php endforeach; endif; unset($_from); ?>
				<td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['row'][0]; ?>
" value="Edit" />
	    			</td>
                                <td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['row'][0]; ?>
D" value="Delete" onclick="document.getElementById('user').action='user'"/>
	    			</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
            </table>
        
        </form>

        <form action="edituser" method="post">
        <p class="submit">
            <input class="button-primary" type="submit" value="Add New User" name="adduser" />
        </p>
        </form>

    </div>
    <?php else: ?>
    <?php endif; ?>
</div>