<?php /* Smarty version 2.6.26, created on 2026-06-10 18:24:04
         compiled from element/zfsquery.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>zfs query</h2>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>zfs name</label>
                    </th>
		    <td>
			    <select name="zpool_name">
                                    <option value="">All</option>
				    <?php $_from = $this->_tpl_vars['zfsName']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['zpool']):
?>
				    <option value = "<?php echo $this->_tpl_vars['zpool']; ?>
"><?php echo $this->_tpl_vars['zpool']; ?>
</option>
				    <?php endforeach; endif; unset($_from); ?>
			    </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>recursive</label>
                    </th>
                    <td>
                        <input type="checkbox" name="recursive" value="1" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Type</label>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="hidden">Type</legend>
                            <label title="All">
                                <input type="radio" checked="checked" value="all" name="type"/> All
                            </label>
                            <br/>
                            <label title="filesystem">
                                <input type="radio" value="filesystem" name="type"/> filesystem
                            </label>
                            <br/>
                            <label title="volume">
                                <input type="radio" value="volume" name="type"/> volume
                            </label>
                            <br/>
                            <label title="snapshot">
                                <input type="radio" value="snapshot" name="type"/> snapshot
                            </label>
                            <br/>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Options</label>
                    </th>
                    <td>
                            <label title="name">
                                <input type="checkbox" checked="checked" name="name" value="1" />name
                            </label>&emsp
                            <label title="aclinherit">
                                <input type="checkbox" name="aclinherit" value="1" />aclinherit
                            </label>&emsp
                            <label title="used">
                                <input type="checkbox" name="used" value="1" />used
                            </label>&emsp
                        <br/>
                            <label title="aclmode">
                                <input type="checkbox" name="aclmode" value="1" />aclmode
                            </label>&emsp
                            <label title="atime">
                                <input type="checkbox" name="atime" value="1" />atime
                            </label>&emsp
                            <label title="available">
                                <input type="checkbox" name="available" value="1" />available
                            </label>&emsp
                        <br/>
                            <label title="checksum">
                                <input type="checkbox" name="checksum" value="1" />checksum
                            </label>&emsp
                            <label title="compression">
                                <input type="checkbox" name="compression" value="1" />compression
                            </label>&emsp
                            <label title="compressratio">
                                <input type="checkbox" name="compressratio" value="1" />compressratio
                            </label>&emsp
                        <br/>
                            <label title="creation">
                                <input type="checkbox" name="creation" value="1" />creation
                            </label>&emsp
                            <label title="devices">
                                <input type="checkbox" name="devices" value="1" />devices
                            </label>&emsp
                            <label title="exec">
                                <input type="checkbox" name="exec" value="1" />exec
                            </label>&emsp
                        <br/>
                            <label title="mounted">
                                <input type="checkbox" name="mounted" value="1" />mounted
                            </label>&emsp
                            <label title="mountpoint">
                                <input type="checkbox" name="mountpoint" value="1" />mountpoint
                            </label>&emsp
                            <label title="origin">
                                <input type="checkbox" name="origin" value="1" />origin
                            </label>&emsp
                        <br/>
                            <label title="quota">
                                <input type="checkbox" name="quota" value="1" />quota
                            </label>&emsp
                            <label title="readonly">
                                <input type="checkbox" name="readonly" value="1" />readonly
                            </label>&emsp
                            <label title="recordsize">
                                <input type="checkbox" name="recordsize" value="1" />recordsize
                            </label>&emsp
                        <br/>
                            <label title="referenced">
                                <input type="checkbox" name="referenced" value="1" />referenced
                            </label>&emsp
                            <label title="reservation">
                                <input type="checkbox" name="reservation" value="1" />reservation
                            </label>&emsp
                            <label title="sharenfs">
                                <input type="checkbox" name="sharenfs" value="1" />sharenfs
                            </label>&emsp
                        <br/>
                            <label title="setuid">
                                <input type="checkbox" name="setuid" value="1" />setuid
                            </label>&emsp
                            <label title="snapdir">
                                <input type="checkbox" name="snapdir" value="1" />snapdir
                            </label>&emsp
                            <label title="type">
                                <input type="checkbox" name="type" value="1" />type
                            </label>&emsp
                        <br/>
                            <label title="volsize">
                                <input type="checkbox" name="volsize" value="1" />volsize
                            </label>&emsp
                            <label title="volblocksize">
                                <input type="checkbox" name="volblocksize" value="1" />volblocksize
                            </label>&emsp

                            <label title="zoned">
                                <input type="checkbox" name="zoned" value="1" />zoned
                            </label>&emsp
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Query!" name="Submit"/>
        </p>
    </form>
    <?php if ($this->_tpl_vars['execMessage']): ?>
    <div class="metabox-holder poststuff">
        <form method="post" action="post.php" onsubmit="return false;">
            <div class="postbox">
                        <div class="handlediv" title="显示/隐藏">
                            <br/>
                        </div>
                        <h3 class="hndle">
                            <span>Result</span>
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
</div>