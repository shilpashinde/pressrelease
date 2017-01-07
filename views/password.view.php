<div id="main-wrapper">
     <?php include 'messages.view.php';?>
    <div id='password'>
        <fieldset>
            <legend>Change Password</legend>
            <form method="post" action="index.php?q=user&action=password" id="change_password_form">
                <div>
                    <label>Enter Current Password<span class="required_star">*</span></label><input type="password" name="password_old" id="password_old" value="" />
                </div>
                <div>
                    <label>Enter New Password<span class="required_star">*</span></label><input type="password" name="password" id="password_new" value="" />
                </div>
                <div>
                    <label>Confirm New Password<span class="required_star">*</span></label><input type="password" name="password_confirm" value="" />
                </div>
                <div>
                    <input type="submit" name="password_submit" class="savebutton" value="Save"/>
                </div>
            </form>


        </fieldset>
    </div>
</div>
<script>
        $(document).ready(function(){
            
            var validator = $("#change_password_form").validate({
		rules: {
			
			password_old: {
				required: true
			},
                        password: {
				required: true,
				minlength: 5
			},
			password_confirm: {
				required: true,
				equalTo: "#password_new"
			}
                    },
		messages: {
			password_old: {
				required: "Provide a password",
				rangelength: jQuery.format("Enter at least {0} characters")
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
		
		// specifying a submitHandler prevents the default submit, good for the demo
		
		// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		},
		highlight: function(element, errorClass) {
			$(element).parent().next().find("." + errorClass).removeClass("checked");
		}
	});
            
        });
        
        </script>