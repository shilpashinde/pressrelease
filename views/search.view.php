<div id="main-wrapper" >
 <div class="search">
  
        <form name="search" action="" method="POST">
               
                    <div>
                        <label>News body</label> <input type="text" name="src_body" id="src_body" value="<?php if(isset($_POST['src_body'])) echo $_POST['src_body']?>"/>
                    </div>
                    <div>
                        <label>City</label> <input type="text" name="src_city" id="src_city" value="<?php if(isset($_POST['src_city'])) echo $_POST['src_city']?>"/>
                    </div>
					<div>
                        <label>State</label> <input type="text" name="src_state" id="src_state" value="<?php if(isset($_POST['src_state'])) echo $_POST['src_state']?>"/>
                    </div>
					<div>
                        <label>Country</label> <input type="text" name="src_country" id="src_country" value="<?php if(isset($_POST['src_country'])) echo $_POST['src_country']?>"/>
                    </div>
                    <div style="float:right;">
                        <input type="hidden" name="redirect_url" value="<?php if(isset($_REQUEST['redirect_url']))echo $_REQUEST['redirect_url']; ?>"/>
                        <input type="submit" value="Search" name="submit"/>
                    </div>

        </form>
    
</div>
</div>