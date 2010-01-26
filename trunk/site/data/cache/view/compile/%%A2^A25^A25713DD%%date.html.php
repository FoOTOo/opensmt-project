<?php /* Smarty version 2.6.26, created on 2026-06-10 10:48:07
         compiled from element/date.html */ ?>
<div class="admin-panel-wrap">
    <div class="icon32 icon-options-general">
        <br/>
    </div>
    <h2>Date and Time Setup</h2>
    
    <form method="post" action="">
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    <label>Date</label>
                </th>
                <td>
                    <select name="year" id="year" style="width: 75px"></select>
                    <select name="month" id="month" style="width: 50px"></select>
                    <select name="day" id="day" style="width: 50px"></select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Time</label>
                </th>
                <td>
                    <select name="hour">
                        <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=25) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <?php if ($this->_tpl_vars['time'][0] == $this->_sections['customer']['index']): ?>
                            <option value="<?php echo $this->_sections['customer']['index']; ?>
" selected><?php echo $this->_sections['customer']['index']; ?>
</option>
                        <?php else: ?>
                            <option value="<?php echo $this->_sections['customer']['index']; ?>
"><?php echo $this->_sections['customer']['index']; ?>
</option>
                        <?php endif; ?>
                        <?php endfor; endif; ?>
                    </select>
                    :
                    <select name="minute">
                        <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=60) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['customer']['start'] = (int)0;
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
                        <?php if ($this->_tpl_vars['time'][1] == $this->_sections['customer']['index']): ?>
                            <option value="<?php echo $this->_sections['customer']['index']; ?>
" selected><?php echo $this->_sections['customer']['index']; ?>
</option>
                        <?php else: ?>
                            <option value="<?php echo $this->_sections['customer']['index']; ?>
"><?php echo $this->_sections['customer']['index']; ?>
</option>
                        <?php endif; ?>
                        <?php endfor; endif; ?>
                    </select>
                    :
                    <select name="second">
                        <?php unset($this->_sections['customer']);
$this->_sections['customer']['name'] = 'customer';
$this->_sections['customer']['loop'] = is_array($_loop=60) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['customer']['start'] = (int)0;
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
                        <?php if ($this->_tpl_vars['time'][2] == $this->_sections['customer']['index']): ?>
                            <option value="<?php echo $this->_sections['customer']['index']; ?>
" selected><?php echo $this->_sections['customer']['index']; ?>
</option>
                        <?php else: ?>
                            <option value="<?php echo $this->_sections['customer']['index']; ?>
"><?php echo $this->_sections['customer']['index']; ?>
</option>
                        <?php endif; ?>
                        <?php endfor; endif; ?>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <p class="submit">
        <input class="button-primary" type="submit" value="Update"/>
    </p>
    </form>
</div

<script type="text/javascript">
function DateSelector(selYear, selMonth, selDay)
{
    this.selYear = selYear;
    this.selMonth = selMonth;
    this.selDay = selDay;
    this.selYear.Group = this;
    this.selMonth.Group = this;

    if(window.document.all != null)
    {
        this.selYear.attachEvent("onchange", DateSelector.Onchange);
        this.selMonth.attachEvent("onchange", DateSelector.Onchange);
    }
    else
    {
        this.selYear.addEventListener("change", DateSelector.Onchange, false);
        this.selMonth.addEventListener("change", DateSelector.Onchange, false);
    }

    if(arguments.length == 4) 
        this.InitSelector(arguments[3].getFullYear(), arguments[3].getMonth() + 1, arguments[3].getDate());
    else if(arguments.length == 6)
        this.InitSelector(arguments[3], arguments[4], arguments[5]);
    else
    {
        var dt = new Date();
        this.InitSelector(dt.getFullYear(), dt.getMonth() + 1, dt.getDate());
    }
}

DateSelector.prototype.MinYear = 1970;

//DateSelector.prototype.MaxYear = (new Date()).getFullYear();

DateSelector.prototype.MaxYear = 2038;

DateSelector.prototype.InitYearSelect = function()
{
    for(var i = this.MaxYear; i >= this.MinYear; i--)
    {       
        var op = window.document.createElement("OPTION");
        op.value = i;
        op.innerHTML = i;
        this.selYear.appendChild(op);
    }
}

DateSelector.prototype.InitMonthSelect = function()
{
    for(var i = 1; i < 13; i++)
    {
        var op = window.document.createElement("OPTION");
        op.value = i;
        op.innerHTML = i;
        this.selMonth.appendChild(op);
    }
}

DateSelector.DaysInMonth = function(year, month)
{
    var date = new Date(year, month, 0);
    return date.getDate();
}

DateSelector.prototype.InitDaySelect = function()
{
    var year = parseInt(this.selYear.value);
    var month = parseInt(this.selMonth.value);
    var daysInMonth = DateSelector.DaysInMonth(year, month);
    this.selDay.options.length = 0;
    for(var i = 1; i <= daysInMonth ; i++)
    {
        var op = window.document.createElement("OPTION");
        op.value = i;
        op.innerHTML = i;
        this.selDay.appendChild(op);
    }
}

DateSelector.Onchange = function(e)
{
    var selector = window.document.all != null ? e.srcElement : e.target;
    selector.Group.InitDaySelect();
}

DateSelector.prototype.InitSelector = function(year, month, day)
{
    this.selYear.options.length = 0;
    this.selMonth.options.length = 0;
    this.InitYearSelect();
    this.InitMonthSelect();
    this.selYear.selectedIndex = this.MaxYear - year;
    this.selMonth.selectedIndex = month - 1;
    this.InitDaySelect();
    this.selDay.selectedIndex = day - 1;
}
</script>

<script type="text/javascript">
var selYear = window.document.getElementById("year");
var selMonth = window.document.getElementById("month");
var selDay = window.document.getElementById("day");

new DateSelector(selYear, selMonth ,selDay, <?php echo $this->_tpl_vars['year']; ?>
, <?php echo $this->_tpl_vars['month']; ?>
, <?php echo $this->_tpl_vars['day']; ?>
);

</script>