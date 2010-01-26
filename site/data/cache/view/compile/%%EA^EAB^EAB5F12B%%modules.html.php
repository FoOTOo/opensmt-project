<?php /* Smarty version 2.6.26, created on 2010-01-01 21:36:51
         compiled from element/modules.html */ ?>
<div class="admin-panel-wrap">
    <div class=" icon-link-manager icon32">
        <br/>
    </div>
    <h2>Modules</h2>
    <div class="metabox-holder poststuff">
        <form method="post" action="post.php" onsubmit="return false;">
            <div class="postbox">
                        <div class="handlediv" title="显示/隐藏">
                            <br/>
                        </div>
                        <h3 class="hndle">
                            <span>Modules</span>
                        </h3>
                        <div class="inside">
                            <div class="inside-body">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th align="left">Id</th>
                                            <th align="left">Loadaddr</th>
                                            <th align="left">Size</th>
                                            <th align="left">Info</th>
                                            <th align="left">Rev</th>
                                            <th align="left">Module Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $_from = $this->_tpl_vars['moduleList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['col']):
?>
                                        <tr>
                                            <td>
                                                <?php echo $this->_tpl_vars['col']['0']; ?>

                                            </td>
                                            <td>
                                                <?php echo $this->_tpl_vars['col']['1']; ?>

                                            </td>
                                            <td>
                                                <?php echo $this->_tpl_vars['col']['2']; ?>

                                            </td>
                                            <td>
                                                <?php echo $this->_tpl_vars['col']['3']; ?>

                                            </td>
                                            <td>
                                                <?php echo $this->_tpl_vars['col']['4']; ?>

                                            </td>
                                            <td>
                                                <?php echo $this->_tpl_vars['col']['5']; ?>

                                            </td>
                                        </tr>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
            <div class="clear"></div>
        </form>
    </div>
</div>