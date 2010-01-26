<?php /* Smarty version 2.6.26, created on 2026-06-10 20:18:18
         compiled from element/interfaces.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>interfaces</h2>
    <div class="updated fade" style="background-color: rgb(255, 251, 204);display: none;">
        <p>
            <strong>设置已保存。</strong>
        </p>
    </div>
    <?php $_from = $this->_tpl_vars['interfaces']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['col']):
?>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    <label>name</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['col']['name']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>status</label>
                </th>
                <td>
					<?php echo $this->_tpl_vars['col']['status']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>mtu</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['col']['mtu']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>index</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['col']['index']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>inet</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['col']['inet']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>netmask</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['col']['netmask']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>broadcast</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['col']['broadcast']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>ether</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['col']['ether']; ?>

                </td>
            </tr>
        </tbody>
    </table>
    <hr/>
    <?php endforeach; endif; unset($_from); ?>
</div>