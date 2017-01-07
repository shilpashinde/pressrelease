<div id="main-wrapper">
    <?php include 'messages.view.php';?>
    <div id="login-wrapper">
        <form name="reg" action="" method="POST" id='login'>

            <div id='login'>
                <fieldset>
                    <legend>Login</legend>
                    <div>
                        <label id ='lgn'>Username</label> <input type="text" name="usrname" id="usrname" value=""/>
                    </div>
                    <div>
                        <label id = 'lgn'>Password</label><input type="password" name="pass" value="" />
                    </div>
                    <div>
                        <label id = 'lgn'>Remember Me</label><input type="checkbox" name="remember_me" id="remember_me" value="1" />
                    </div>
                    <div>
                        <input type="hidden" name="redirect_url" value="<?php if(isset($_REQUEST['redirect_url']))echo $_REQUEST['redirect_url']; ?>"/>
                        <input type="submit" value="Submit" id='submit' name="login_submit"/>
                    </div>
                    <div>
                        <a href="index.php?q=user&action=reset">Forgot password?</a>
                    </div>
                </fieldset>
            </div>
        </form>
    </div>
</div>