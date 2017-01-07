<?php if (!defined("NO_DIRECT")) die("Direct Access is not allowed"); ?>
<div class="inner-content" id="main-wrapper">
    <?php include 'messages.view.php';?>
    <div class="form-container">
        <h3><?php echo ($isNew)?'Add New':'Edit';?> User</h3>
        <form method="post" id="user_form">
            <table class="form-table">
                <tr>
                    <th><label for='name'>Name<span class="required_star">*</span></label></th>
                    <td>:</td>
                    <td><input type="text" name="name" id="name" value="<?php echo @$row->name;?>" title="name of the user"/></td>
                </tr>
                <?php if($isNew):?>
                <tr>
                    <th><label for='username'>Username<span class="required_star">*</span></label></th>
                    <td>:</td>
                    <td><input type="text" name="username" id="username" value="<?php echo @$row->username;?>" title="Username to access the project"/></td>
                </tr>
                <tr>
                    <th><label for='email'>Email<span class="required_star">*</span></label></th>
                    <td>:</td>
                    <td><input type="text" name="email" id="email" value="<?php echo @$row->email;?>" title="Email address of the user"/></td>
                </tr>
                <?php else:?>
                <tr>
                    <th><label>Username</label></th>
                    <td>:</td>
                    <td><?php echo $row->username;?></td>
                </tr>
                <tr>
                    <th><label>Email</label></th>
                    <td>:</td>
                    <td><?php echo $row->email;?></td>
                </tr>
                <?php endif;?>
                <tr>
                    <th><label for='password'>Password
                        <?php if($isNew):?>
                            <span class="required_star">*</span>
                        <?php endif;?>
                        </label></th>
                    <td>:</td>
                    <td><input type="password" name="password" id="password" title="Leave password field empty if you don't want to change password while editing"/></td>
                </tr>
                <tr>
                    <th><label for='password_confirm'>Confirm Password
                        <?php if($isNew):?>
                            <span class="required_star">*</span>
                        <?php endif;?>
                        </label></th>
                    <td>:</td>
                    <td><input type="password" name="password_confirm" id="password_confirm"/></td>
                </tr>
                <tr>
                    <th><label>City  <span class="required_star">*</span></label></th>
                    <td>:</td>
                    <td><?php echo @$row->city;?> <input type="text" name="city" id="city" value="<?php echo @$row->city;?>" title="City of the user"/></td>
					
                </tr>
				<tr>
                    <th><label>State  <span class="required_star">*</span></label></th>
                    <td>:</td>
                    <td><?php echo @$row->state;?><input type="text" name="state" id="state" value="<?php echo @$row->state;?>" title="State of the user"/></td>
                </tr>
				<tr>
                    <th><label>Country</label></th>
                    <td>:</td>
                    <td><?php echo @$row->country;?><input type="text" name="country" id="country" value="<?php echo @$row->country;?>" title="Country of the user"/></td>
                </tr>
				
				
				
				<tr>
                    <th><label for='is_super_user'>Is Super Admin</label></th>
                    <td>:</td>
                    <td>
                        <input type="checkbox" value="1" name="is_super_user" id="is_super_user"<?php echo (@$row->is_super_user)?' CHECKED="checked"':'';?> title="A Super Administrator can see and manage all projects
                                , users and their permissions and settings"/>
                    </td>
                </tr>
                <tr>
                    <th><label for='status'>Enabled</label></th>
                    <td>:</td>
                    <td>
                        <input type="checkbox" value="1" name="status" id="status" <?php echo (@$row->status)?' CHECKED="checked"':'';?>/>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><input type="submit" class="savebutton" value="Save" name='user_submit'/></td>
                </tr>
            </table>
            <input type='hidden' name='id' id='id' value='<?php echo @$row->id;?>'/>
        </form>
    </div>
    
</div>
<script>
        $(document).ready(function(){
            $(document).tooltip();
            var validator = $("#user_form").validate({
	ignoreTitle: true,	
            rules: {
			
			name: {
				required: true
			},
                        username: {
				required: true,
				minlength: 5,
                                remote:'index.php?q=user&action=username_check'
			},
                        password: {
                            <?php if($isNew):?>
				required: true,
                            <?php endif;?>
				minlength: 5
			},
			password_confirm: {
				<?php if($isNew):?>required: true,
                            <?php endif;?>equalTo: "#password"
			},
                        email: {
				required: true,
				email: true,
                                remote:'index.php?q=user&action=email_check'
			},
			city: {
				required: true
			},
			state: {
				required: true
			},
			
                    },
		messages: {
			username: {
				required: "Provide a password",
				rangelength: jQuery.format("Enter at least {0} characters"),
                                remote: jQuery.format("{0} is already in use")
			},
			password: {
				required: "Provide a password",
				rangelength: jQuery.format("Enter at least {0} characters")
			},
			password_confirm: {
				required: "Repeat your password",
				minlength: jQuery.format("Enter at least {0} characters"),
				equalTo: "Enter the same password as above"
			},
			email: {
				required: "Please enter a valid email address",
				minlength: "Please enter a valid email address",
				remote: jQuery.format("{0} is already in use")
			},
			dateformat: "Choose your preferred dateformat",
			terms: " "
		},
		// the errorPlacement has to take the table layout into account
		
		// specifying a submitHandler prevents the default submit
		
		// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		},
		highlight: function(element, errorClass) {
			$(element).parent().find("." + errorClass).removeClass("checked");
		}
	});
            
        });
        
        </script>
       