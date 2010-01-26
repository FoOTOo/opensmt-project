<?php /* Smarty version 2.6.26, created on 2026-06-10 09:40:38
         compiled from element/addhgmember.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Add Host Member</h2>
    <form action="default" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Group Name</label>
                    </th>
		    <td>
                        <input class="regular-text" readonly="" type="text" name="group_name" id="group_name" value="<?php echo $this->_tpl_vars['group_name']; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Member Name</label>
                    </th>
		    <td>
                        <input class="regular-text" type="text" name="member_name" id="member_name" value=""/>
                    </td>
                </tr>

            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Add!" name="addhgmember"/>
        </p>
    </form>
</div>