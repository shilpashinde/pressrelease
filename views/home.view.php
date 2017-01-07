<div id="main-wrapper" >
     <?php include 'messages.view.php';?>

<div class="search">
        <div style="background-color: #602343;padding:5px;color:#ffffff;">Search Press Release</div>
        <form name="search" action="" method="POST">
               
                    <div class="src">
                        <label>News body</label> <input type="text" name="src_body" id="src_body" value="<?php if(isset($_POST['src_body'])) echo $_POST['src_body']?>"/>
                    </div>
                    <div class="src">
                        <label>City</label> <input type="text" name="src_city" id="src_city" value="<?php if(isset($_POST['src_city'])) echo $_POST['src_city']?>"/>
                    </div>
					<div class="src">
                        <label>State</label> <input type="text" name="src_state" id="src_state" value="<?php if(isset($_POST['src_state'])) echo $_POST['src_state']?>"/>
                    </div>
					<div class="src">
                        <label>Country</label> <input type="text" name="src_country" id="src_country" value="<?php if(isset($_POST['src_country'])) echo $_POST['src_country']?>"/>
                    </div>
                    <div class="src" style="float:right;">
                        <input type="hidden" name="redirect_url" value="<?php if(isset($_REQUEST['redirect_url']))echo $_REQUEST['redirect_url']; ?>"/>
                        <input type="submit" value="Search" name="submit"/>
                    </div>

        </form>
    
</div>

<?php foreach ($rows as $row):?>
    <div class="summary">
        <h3>
		<?php if(@$_SESSION['user']['details']->id == $row->created_by || @$_SESSION['user']['details']->is_super_user == 1){?>
		<a href="index.php?q=pressrelease&action=edit&id=<?php echo $row->id; ?>" ><img src="images/edit.png"  alt="edit" height="15" width="15" title="edit"/></a>
		<a href="index.php?q=pressrelease&action=delete&id=<?php echo $row->id; ?>" ><img src="images/delete.png"  alt="delete" height="15" width="15" title="edit"/></a>
		<?php }?>
		<?php echo $row->heading;?>
		</h3>
        <div><?php echo $row->summary;?></div>
        <a href="index.php?q=pressrelease&action=details&id=<?php echo $row->id;?>">Read More &Gt; </a>
    </div>
    <?php endforeach;?>
</div>
