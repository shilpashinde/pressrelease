<div id="main-wrapper">
     <?php include 'messages.view.php';?>
    <div class="details">
        <form method="POST" id="press_edit">
            <div class="field">
                <label for="heading">Heading<span class="required_star">*</span></label>
                <input type="text" name="heading" id="heading" value="<?php echo @$row->heading;?>" size="60"/>
            </div>
            <div class="field">
                <label for="summary">Summary<span class="required_star">*</span></label>
                <textarea name="summary" id="summary" rows="10" cols="120"><?php echo @$row->summary;?></textarea>
            </div>
            <div class="field">
                <label for="body">News Body<span class="required_star">*</span></label>
                <textarea name="body" id="body" rows="10" cols="120"><?php echo @$row->body;?></textarea>
            </div>
			<div class="field">
                <label for="company">Company<span class="required_star">*</span></label>
                <select name="company" id="company">
                    <option value="">--Select--</option>
                    <?php foreach ($companies as $com):?>
                    <option value="<?php echo $com->id;?>" <?php  echo ($com->id==@$row->company)?' SELECTED="SELECTED"':'';?>><?php echo $com->name;?></option>
                    <?php endforeach;?>
					<option value="O">Other Company</option>
                </select>
            </div>
			
            <div class="field new_company" >
                <label for="company">Company Name<span class="required_star">*</span></label>
                <input type="text" name="company_name" id="company_name" value="<?php echo @$row->name;?>" size="60"/><span class="company_lbl" id="com_name" style="hidden" >This field is required</span>
            </div>
			<div class="field new_company">
                <label for="company">Company Email<span class="required_star">*</span></label>
                  <input type="text" name="company_email" id="company_email" value="<?php echo @$row->email;?>" size="60"/><span class="company_lbl" id="com_email">This field is required</span>
				  
            </div>
			
            <div class="field">
                <label for="release_date">Release Date<span class="required_star">*</span></label>
                <input type="text" name="release_date" id="release_date" value="<?php echo @$row->release_date;?>" size="20"/>
            </div>
            <div class="field">
                <label>&nbsp;</label>
                <input type="hidden" name="id" value="id" value="<?php echo @$row->id;?>"/>
                <input type="submit" value="Save" name="save_press" class="savebutton"/>
            </div>
        </form>
        
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#release_date").datepicker();
		$("#com_name").hide();
        $("#com_email").hide();
		$(".new_company").hide();
		
        $("#press_edit").validate({
            rules:{
              heading:"required",
              summary:"required",
              body:"required",
              company:"required",
			  release_date:"required",
			 
            }
        });
		
		$("#company").change(function(){
			if($("#company").val() == "O"){
			 $(".new_company").show();
			}
		})
		$("#press_edit").submit(function(){
		var flag = 0;
		if($("#company").val() == "O"){
			if($("#company_name").val() == "" ){
			$("#company_name").addClass("error");
			$("#com_name").show();
			flag = 1;
			}
		    if($("#company_email").val() == "" ){
			$("#company_email").addClass("error");
			$("#com_email").show();
			flag = 1;
			}
			if($("#company_email").val() != "" ){
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			  if( !emailReg.test( $("#company_email").val() ) ) {
				$("#com_email").show();
				$("#com_email").text("invalid email");
				$("#com_email").addClass("company_lbl");
				flag = 1;
			  } 
			}
		}
		if(flag == 1) return false;
		});
		$("#company_name").keyup(function(){
		$("#com_name").hide();
		$("#company_name").removeClass("error");
		});
		$("#company_email").keyup(function(){
		$("#com_email").hide();
		$("#company_email").removeClass("error");
		});
    })
    </script>