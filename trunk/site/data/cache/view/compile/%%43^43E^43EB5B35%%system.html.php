<?php /* Smarty version 2.6.26, created on 2026-06-11 12:03:17
         compiled from element/system.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>System</h2>
    
    <form method="get" action="">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    <label>Hostname</label>
                </th>
                <td>
                   <?php echo $this->_tpl_vars['Auto_Hostname']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Version</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_Version']; ?>

                   
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>OS Version</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_OS_Version']; ?>

                  
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Platform</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_Platform']; ?>

                   
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>System Time</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_System_Time']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Uptime</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_Uptime']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Load Average</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_Load_Average']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>CPU Temperature</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_CPU_Temperature']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>CPU Frequency</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_CPU_Frequency']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>CPU Usage</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_CPU_Usage']; ?>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Memory Usage</label>
                </th>
                <td>
                    <?php echo $this->_tpl_vars['Auto_Memory_Usage']; ?>

                </td>
            </tr>
        </tbody>
    </table>
    <p class="submit">
        <input class="button-primary" type="submit" value="refresh" />
    </p>
    </form>
</div>