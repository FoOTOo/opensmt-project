<?php /* Smarty version 2.6.26, created on 2026-06-11 11:55:46
         compiled from snippet/login.html */ ?>
<div class="content">
    <div class="innercontent">

        <div id="admin-panel">
            <div class="form-panel">
                <div class="login" id="login">
                    <h1>
                        <a title="openSMT" href="javascript:;">openSMT</a>
                    </h1>
                    <?php if ($this->_tpl_vars['systemError']): ?>
                    <div class="updated fade">
                        <p class="system-error">
                            <?php echo $this->_tpl_vars['systemError']; ?>

                        </p>
                    </div>
                    <?php endif; ?>
                    <form action="<?php echo $this->_tpl_vars['webUrl']; ?>
/auth/login/" method="post">
                        <p>
                            <label>
                                User
                                <br/>
                                <input id="user-login" class="input" type="text" tabindex="10" value="" name="log" />
                            </label>
                        </p>
                        <p>
                            <label>
                                Password
                                <br/>
                                <input id="user-pass" class="input" type="password" tabindex="20" value="" name="pwd" />
                            </label>
                        </p>
                        <p class="forgetmenot">
                            <label>
                                <input id="rememberme" type="checkbox" tabindex="90" value="forever" name="rememberme"/>
                                Remember me
                            </label>
                        </p>
                        <p class="submit">
                            <input id="submit" type="submit" tabindex="100" value="Login" name="submit"/>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>