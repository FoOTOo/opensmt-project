<?php /* Smarty version 2.6.26, created on 2010-01-01 21:36:23
         compiled from element/editgroup.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Edit Group</h2>

    <form action="group" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Name</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text"  name="groupname" id="groupname" value="<?php echo $this->_tpl_vars['gname']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Group ID:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="groupid" id="groupid" value="<?php echo $this->_tpl_vars['gid']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Allow Gid Duplicated:</label>
                    </th>
		    <td>
                            <input type = "checkbox" name = "isdup" > Check for allowing duplicated <p>
                    </td>
                </tr>
            </tbody>
        </table>
        <input class="regular-text" type="hidden" readonly="" name="originname" id="originname" value="<?php echo $this->_tpl_vars['gname']; ?>
"/>
        <input class="regular-text" type="hidden" readonly="" name="originid" id="originid" value="<?php echo $this->_tpl_vars['gid']; ?>
"/>
        <p class="submit">
            <input class="button-primary" type="submit" value="Apply Changes" name="groupEdit"/>
        </p>
    </form>
</div>

