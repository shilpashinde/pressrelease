<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>Home</title>
        <link type="text/css" rel="stylesheet" href="css/colorbox.css"/>
        <link type="text/css" rel="stylesheet" href="css/jquery-ui-1.10.3.custom.css"/>
        <link type="text/css" rel="stylesheet" href="css/jqpagination.css"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"/>
        
        <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="js/jquery.jqpagination.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        
    </head>
    <body>
    <nav id="topNav">
        <div class="menu-wrapper">
            <div class="heading">
                
                <div class="title"><a href="index.php">Press Releases</a></div>
				
            </div>
            
            <?php if (strtolower(@$_GET['q']) != "login"): ?>
                <ul class="usr">
                    <li> <a >Welcome&nbsp;<?php echo isset($_SESSION['user']) ? $_SESSION['user']['details']->name : "Guest"; ?></a>
                        <?php if (isset($_SESSION['user'])): ?>
                            <ul>
                                <li><a title="Change Password" href="index.php?q=user&action=password">Change Password</a></li>
                                <li><a title="Change Password" href="index.php?q=pressrelease&action=edit">Add New Press Release</a></li>
                                <?php if($_SESSION['user']['details']->is_super_user):?>
                                <li><a href="index.php?q=user">Manage Users</a></li>
                                <?php endif;?>
                            </ul>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if (isset($_SESSION['user'])): ?>
                            <a title="logout" href="index.php?q=login&action=logout">Logout</a>
                        <?php elseif (strtolower(@$_GET['q']) != "login"): ?>
                            <a title="logout" href="index.php?q=login">Log In</a>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php endif; ?>
            <div style="clear:both"/>
        </div>

    </nav>
	
	
	<script>
	$(document).ready(function(){
            $(document).tooltip();
            var validator = $("#search_form").validate({
	ignoreTitle: true,	
            rules: {
			
			search: {
				required: true
			},
          },
		},
		
	});
            
        });
	</script>