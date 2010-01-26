<?php /* Smarty version 2.6.26, created on 2026-06-10 15:51:37
         compiled from element/zpoolinfo.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>zpool info</h2>
    <div class="admin-panel-wrap">
        <div class="updated fade" style="background-color: rgb(255, 251, 204);">
            <p>The launch of scrubbing may take a few seconds, please wait...</p>
        </div>
        <?php if ($this->_tpl_vars['myArray']): ?>


        <form class="posts-filter" action="" method="post">
            <table class="widefat post fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th class="manage-column column-title" style="" scope="col" width="10%">Name</th>
                        <th class="manage-column column-author" style="" scope="col">Size</th>
                        <th class="manage-column column-author" style="" scope="col">Used</th>
                        <th class="manage-column column-author" style="" scope="col">Avail</th>
                        <th class="manage-column column-author" style="" scope="col">Cap</th>
                        <th class="manage-column column-author" style="" scope="col">Health</th>
                        <th class="manage-column column-author" style="" scope="col">ALTROOT</th>
                        <th class="manage-column column-author" style="" scope="col"></th>
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
" value="Status" />
                        </td>
                        <td>
                            <?php if ($this->_tpl_vars['scrubfinish'][$this->_tpl_vars['k']]): ?>
                            <input class="button-secondary action deaction" type="submit" name="<?php echo $this->_tpl_vars['row'][0]; ?>
S" value="Scrub" />
                            <?php else: ?>
                            <input class="button-secondary action deaction" type="submit" name="<?php echo $this->_tpl_vars['row'][0]; ?>
S" value="Stop Scrub" />
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </tbody>
            </table>

        </form>


        <?php else: ?>
        <?php endif; ?>
        <br/>

        <?php if ($this->_tpl_vars['execMessage']): ?>
        <div class="metabox-holder poststuff">
            <form method="post" action="post.php" onsubmit="return false;">
                <div class="postbox">
                    <div class="handlediv" title="显示/隐藏">
                        <br/>
                    </div>
                    <h3 class="hndle">
                        <span>Status</span>
                    </h3>
                    <div class="inside">
                        <div class="inside-body">
                            <pre id="execMessage"><?php echo $this->_tpl_vars['execMessage']; ?>
</pre>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </form>
        </div>
        <?php else: ?>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['scrubMessage']): ?>
        <div class="metabox-holder poststuff">
            <form method="post" action="post.php" onsubmit="return false;">
                <div class="postbox">
                    <div class="handlediv" title="显示/隐藏">
                        <br/>
                    </div>
                    <h3 class="hndle">
                        <span>Status</span>
                    </h3>
                    <div class="inside">
                        <div class="inside-body">
                            <pre id="scrubMessage"><?php echo $this->_tpl_vars['scrubMessage']; ?>
</pre>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </form>
        </div>
        <?php else: ?>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    function processload() {
        var myHTMLRequest = new Request.HTML({
            onComplete: function(responseTree, responseElements, responseHTML, responseJavaScript){
                $('scrubMessage').set('html',responseHTML);
            }
        }).get('<?php echo $this->_tpl_vars['webUrl']; ?>
/disk/zpool/default/type/ajax');
}
processload.periodical(2000);

</script>