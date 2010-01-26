<?php /* Smarty version 2.6.26, created on 2026-06-10 08:39:10
         compiled from element/rsync.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <div class="admin-panel-wrap">
        <h2>Rsync List</h2>
        <form class="posts-filter" action="editrsync" method="post" id="rsync">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="10%">Name</th>
                        <th class="manage-column column-author" style="" scope="col" width="20%">Comment</th>
			<th class="manage-column column-author" style="" scope="col" width="20%">path</th>
			<th class="manage-column column-author" style="" scope="col"></th>
                        <th class="manage-column column-author" style="" scope="col"></th>
                    </tr>
	    	</thead>
		<tbody>
        		<?php $_from = $this->_tpl_vars['rsyncSection']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sharename'] => $this->_tpl_vars['shareinfo']):
?>
			<tr>
				<td><?php echo $this->_tpl_vars['sharename']; ?>
</td>
                                <td><?php echo $this->_tpl_vars['shareinfo'][$this->_tpl_vars['comm']]; ?>
</td>
                                <td><?php echo $this->_tpl_vars['shareinfo'][$this->_tpl_vars['pa']]; ?>
</td>
				<td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['sharename']; ?>
" value="edit" />
	    			</td>
                                <td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['sharename']; ?>
D" value="delete" onclick="document.getElementById('rsync').action='default'"/>
	    			</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
            </table>
        </form>
        <form action="editrsync" method="post">
        <p class="submit">
            <input class="button-primary" type="submit" value="New Rsync" name="addRsync" />
        </p>
        </form>
    </div>
</div>