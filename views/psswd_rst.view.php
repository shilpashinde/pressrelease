<div id="main-wrapper">
     <?php include 'messages.view.php';?>
    <?php if(!@$hide_pwd):?>
    <div id='password'>
        <fieldset>
            <legend>Change Password</legend>
            <form method="post" id="reset_password_form">
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
    <?php else:?>
    <script>
    $(document).ready(function(){
        setTimeout(function(){document.location="index.php"}, 5000);
    });
    </script>
    <?php endif;?>
</div>
<script>
        $(document).ready(function(){
            
            var validator = $("#reset_password_form").validate({
		rules: {
			
			
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
			
			password: {
				required: "Provide a password",
				rangelength: jQuery.format("Enter at least {0} characters")
			},
			password_confirm: {
				required: "Repeat your password",
				minlength: jQuery.format("Enter at least {0} characters"),
				equalTo: "Enter the same password as above"
			}
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