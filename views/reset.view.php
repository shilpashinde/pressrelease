<div id="main-wrapper">
    <?php include 'messages.view.php'; ?>
    <div id='password'>
        <form method="post" id="reset_password_form">
            <table class="form-table">
                <tr>
                    <td><label for="email">Email<span class="required_star">*</span></label></td>
                    <td><input type="text" id="email" name="email" size="60"/></td>
                    <td><input type="submit" name="reset_submit" class="savebutton" value="Reset"/></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
        $(document).ready(function(){
            
            var validator = $("#reset_password_form").validate({
		rules: {
			
			email: {
				required: true,
                                email:true
			}
                    },
		messages: {
			email: "Please enter a valid email address"
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