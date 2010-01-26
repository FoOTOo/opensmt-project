<?php /* Smarty version 2.6.26, created on 2026-06-11 07:42:53
         compiled from element/nfs.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <div class="admin-panel-wrap">
        <h2>NFS Share List</h2>
        <form class="posts-filter" action="editnfs" method="post" id="nfsshare">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="30%">Path</th>
						<th class="manage-column column-author" style="" scope="col">Authority</th>
                        <th class="manage-column column-author" style="" scope="col">Network</th>
                        <th class="manage-column column-author" style="" scope="col">Description</th>
                        <th class="manage-column column-author" style="" scope="col"></th>
                        <th class="manage-column column-author" style="" scope="col"></th>
                    </tr>
	    	</thead>
		<tbody>
        		<?php $_from = $this->_tpl_vars['nfsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shareinfo']):
?>
			<tr>
				<td><?php echo $this->_tpl_vars['shareinfo'][0]; ?>
</td>
                                <td><?php echo $this->_tpl_vars['shareinfo'][1]; ?>
</td>
                                <?php if ($this->_tpl_vars['shareinfo'][2]): ?>
                                    <td><?php echo $this->_tpl_vars['shareinfo'][2]; ?>
/<?php echo $this->_tpl_vars['shareinfo'][3]; ?>
</td>
                                <?php else: ?>
                                    <td></td>
                                <?php endif; ?>
                                <td><?php echo $this->_tpl_vars['shareinfo'][4]; ?>
</td>
				<td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['shareinfo'][0]; ?>
" value="Edit" />
	    			</td>
                                <td>
					<input class="button-secondary action doaction" type="submit" name = "<?php echo $this->_tpl_vars['shareinfo'][0]; ?>
D" value="Delete" onclick="document.getElementById('nfsshare').action='nfs'"/>
	    			</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
            </table>

        </form>
        <form action="editnfs" method="post">
        <p class="submit">
            <input class="button-primary" type="submit" value="Add New NFS Share" name="addnfs" />
        </p>
        </form>

    </div>
</div>