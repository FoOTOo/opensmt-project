<?php /* Smarty version 2.6.26, created on 2026-06-10 15:52:09
         compiled from element/zpoolio.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Pool IO</h2>
    <?php if ($this->_tpl_vars['execMessage']): ?>
    <div id="execMessage" class="updated fade" style="background-color: rgb(255, 251, 204);">
        <?php unset($this->_sections['line']);
$this->_sections['line']['name'] = 'line';
$this->_sections['line']['loop'] = is_array($_loop=$this->_tpl_vars['execMessage']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['line']['show'] = true;
$this->_sections['line']['max'] = $this->_sections['line']['loop'];
$this->_sections['line']['step'] = 1;
$this->_sections['line']['start'] = $this->_sections['line']['step'] > 0 ? 0 : $this->_sections['line']['loop']-1;
if ($this->_sections['line']['show']) {
    $this->_sections['line']['total'] = $this->_sections['line']['loop'];
    if ($this->_sections['line']['total'] == 0)
        $this->_sections['line']['show'] = false;
} else
    $this->_sections['line']['total'] = 0;
if ($this->_sections['line']['show']):

            for ($this->_sections['line']['index'] = $this->_sections['line']['start'], $this->_sections['line']['iteration'] = 1;
                 $this->_sections['line']['iteration'] <= $this->_sections['line']['total'];
                 $this->_sections['line']['index'] += $this->_sections['line']['step'], $this->_sections['line']['iteration']++):
$this->_sections['line']['rownum'] = $this->_sections['line']['iteration'];
$this->_sections['line']['index_prev'] = $this->_sections['line']['index'] - $this->_sections['line']['step'];
$this->_sections['line']['index_next'] = $this->_sections['line']['index'] + $this->_sections['line']['step'];
$this->_sections['line']['first']      = ($this->_sections['line']['iteration'] == 1);
$this->_sections['line']['last']       = ($this->_sections['line']['iteration'] == $this->_sections['line']['total']);
?>
        <pre>
            <strong><?php echo $this->_tpl_vars['execMessage'][$this->_sections['line']['index']]; ?>
</strong>
        </pre>
        <?php endfor; endif; ?>
    </div>
    <?php else: ?>
    <?php endif; ?>
    <form action="" method="post">    
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Pool Name</label>
                    </th>
                     <td>
			    <select name="poolName">
                                    <option value="">All</option>
				    <?php $_from = $this->_tpl_vars['zpoolName']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
                        <label>Per Time</label>
                    </th>
                    <td>
                        <select name="perTime">
                            <option value=""></option>
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
</option>
                            <?php endfor; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Times</label>
                    </th>
                    <td>
                        <select name="times">
                            <option value=""></option>
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
                        <label>Virtual Device</label>
                    </th>
                    <td>
                        <input type="checkbox" name="vdevice" value="1" />
                    </td>
                </tr>
                
            </tbody>
        </table>
        <p class="submit">
            <input class="button-primary" type="submit" value="See!" name="Submit"/>
        </p>
    </form>
</div>