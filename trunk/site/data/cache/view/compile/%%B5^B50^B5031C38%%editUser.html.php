<?php /* Smarty version 2.6.26, created on 2009-12-23 17:05:50
         compiled from element/editUser.html */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Edit User Profile</h2>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Username:</label>
                    </th>
                    <td>
                        <input class="regular-text" type="text" name="username" id="username" value="<?php echo $this->_tpl_vars['args'][0]; ?>
"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Stop after sending (and receiving) N packets:</label>
                    </th>
                    <td>
                        <select name="ping_count">
                            <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['customer']['start'] = (int)1;
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
$this->_sections['customer']['step'] = 1;
if ($this->_sections['customer']['start'] < 0)
    $this->_sections['customer']['start'] = max($this->_sections['customer']['step'] > 0 ? 0 : -1, $this->_sections['customer']['loop'] + $this->_sections['customer']['start']);
else
    $this->_sections['customer']['start'] = min($this->_sections['customer']['start'], $this->_sections['customer']['step'] > 0 ? $this->_sections['customer']['loop'] : $this->_sections['customer']['loop']-1);
if ($this->_sections['customer']['show']) {
    $this->_sections['customer']['total'] = min(ceil(($this->_sections['customer']['step'] > 0 ? $this->_sections['customer']['loop'] - $this->_sections['customer']['start'] : $this->_sections['customer']['start']+1)/abs($this->_sections['customer']['step'])), $this->_sections['customer']['max']);
    if ($this->_sections['customer']['total'] == 0)
        $this->_sections['customer']['show'] = false;
} else
    $this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

            for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
                 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
                 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']      = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']       = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
                            <option value="<?php echo $this->_sections['customer']['index']; ?>
"><?php echo $this->_sections['customer']['index']; ?>
次</option>
                            <?php endfor; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Data size</label>
                    </th>
                    <td>
                        <select name="ping_sizeof">
                            <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=10) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['customer']['start'] = (int)2;
$this->_sections['customer']['step'] = ((int)2) == 0 ? 1 : (int)2;
$this->_sections['customer']['show'] = true;
$this->_sections['customer']['max'] = $this->_sections['customer']['loop'];
if ($this->_sections['customer']['start'] < 0)
    $this->_sections['customer']['start'] = max($this->_sections['customer']['step'] > 0 ? 0 : -1, $this->_sections['customer']['loop'] + $this->_sections['customer']['start']);
else
    $this->_sections['customer']['start'] = min($this->_sections['customer']['start'], $this->_sections['customer']['step'] > 0 ? $this->_sections['customer']['loop'] : $this->_sections['customer']['loop']-1);
if ($this->_sections['customer']['show']) {
    $this->_sections['customer']['total'] = min(ceil(($this->_sections['customer']['step'] > 0 ? $this->_sections['customer']['loop'] - $this->_sections['customer']['start'] : $this->_sections['customer']['start']+1)/abs($this->_sections['customer']['step'])), $this->_sections['customer']['max']);
    if ($this->_sections['customer']['total'] == 0)
        $this->_sections['customer']['show'] = false;
} else
    $this->_sections['customer']['total'] = 0;
if ($this->_sections['customer']['show']):

            for ($this->_sections['customer']['index'] = $this->_sections['customer']['start'], $this->_sections['customer']['iteration'] = 1;
                 $this->_sections['customer']['iteration'] <= $this->_sections['customer']['total'];
                 $this->_sections['customer']['index'] += $this->_sections['customer']['step'], $this->_sections['customer']['iteration']++):
$this->_sections['customer']['rownum'] = $this->_sections['customer']['iteration'];
$this->_sections['customer']['index_prev'] = $this->_sections['customer']['index'] - $this->_sections['customer']['step'];
$this->_sections['customer']['index_next'] = $this->_sections['customer']['index'] + $this->_sections['customer']['step'];
$this->_sections['customer']['first']      = ($this->_sections['customer']['iteration'] == 1);
$this->_sections['customer']['last']       = ($this->_sections['customer']['iteration'] == $this->_sections['customer']['total']);
?>
                            <?php $this->assign('size', $this->_sections['customer']['index']*$this->_sections['customer']['index']); ?>
                            <option value="<?php echo $this->_tpl_vars['size']; ?>
"><?php echo $this->_tpl_vars['size']; ?>
kb</option>
                            <?php endfor; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>其它选项</label>
                    </th>
                    <td>
                        <fieldset>
                            <legend class="hidden">其它选项</legend>
                            <label title="其它选项1">
                                <input type="radio" checked="checked" value="其它选项1" name="date_format"/> 其它选项1
                            </label>
                            <br/>
                            <label title="其它选项2">
                                <input type="radio" checked="checked" value="其它选项2" name="date_format"/> 其它选项2
                            </label>
                            <br/>
                            <label title="其它选项3">
                                <input type="radio" checked="checked" value="其它选项3" name="date_format"/> 其它选项3
                            </label>
                            <br/>
                            <label title="其它选项4">
                                <input type="radio" checked="checked" value="其它选项4" name="date_format"/> 其它选项4
                            </label>
                            <br/>
                            <label>
                                <input type="radio" value="\c\u\s\t\o\m" name="date_format"/> 自定义参数：
                            </label>
                            <input type="text" class="text" value="" name="ping_custom"/>
                            <p>
                                <a href="http://codex.wordpress.org/Formatting_Date_and_Time">ping的相关文档</a>
                                。点击访问相关网站
                            </p>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="Ping!" name="Submit"/>
        </p>
    </form>
</div>