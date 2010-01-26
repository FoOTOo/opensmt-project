<?php /* Smarty version 2.6.26, created on 2026-06-11 11:55:58
         compiled from element/diskinfo.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <?php if ($this->_tpl_vars['myArray']): ?>
    <div class="admin-panel-wrap">
        <h2>disk info</h2>
        <form class="posts-filter" action="" method="get">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="20%">Disk Name</th>
			<th class="manage-column column-author" style="" scope="col">Model</th>
                        <th class="manage-column column-author" style="" scope="col">Serial No</th>
                        <th class="manage-column column-author" style="" scope="col">Size</th>
                    </tr>
	    	</thead>
		<tbody>
        		<?php $_from = $this->_tpl_vars['myArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
			<tr>
				<?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['col']):
?>
				<td><?php echo $this->_tpl_vars['col']; ?>
</td>
				<?php endforeach; endif; unset($_from); ?>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</tbody>
            </table>
            
        </form>

    </div>
    <?php else: ?>
    <?php endif; ?>
</div>