<?php /* Smarty version 2.6.26, created on 2026-06-10 18:04:11
         compiled from element/browserdir.html */ ?>
<script type="text/javascript">
    function selectDir(dir){
        var selElement = window.opener.window.selElement;
        
        window.opener.document.getElementById(selElement).value = dir;
        window.close();
    }
</script>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>

    <h2>Select Dir</h2>
    <table class="form-table">
        <tbody>
            <?php $_from = $this->_tpl_vars['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['col']):
?>
            <tr valign="top">
                <th scope="row" align="left" width="*">
                    <a href="<?php echo $this->_tpl_vars['webUrl']; ?>
/file/browser/dir/?dir=<?php echo $this->_tpl_vars['col']; ?>
"><?php echo $this->_tpl_vars['k']; ?>
</a>
                </th>
                <td width="20%">
                    <button onclick="return selectDir('<?php echo $this->_tpl_vars['col']; ?>
');">Select</button>
                </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
</div>