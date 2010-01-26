<?php /* Smarty version 2.6.26, created on 2026-06-10 18:25:50
         compiled from element/zfsmanage.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>zfs manage</h2>
    <?php if ($this->_tpl_vars['myArray']): ?>
    <div class="admin-panel-wrap">

        <form class="posts-filter" action="zfsedit" method="post" id="zfsmanage">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="30%">Name</th>
			<th class="manage-column column-author" style="" scope="col" width="25%">MOUNTPOINT</th>
			<th class="manage-column column-author" style="" scope="col">SHARE</th>
			<th class="manage-column column-author" style="" scope="col">QUOTA</th>
			<th class="manage-column column-author" style="" scope="col">RESERVATION</th>
			<th class="manage-column column-author" style="" scope="col"></th>
                    </tr>
	    	</thead>
		<tbody>
        		<?php $_from = $this->_tpl_vars['myArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['row']):
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
" value="edit" />
	    			</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
            </table>

        </form>

    </div>
    <?php else: ?>
    <?php endif; ?>
</div>