$(document).ready(function(){
	
	var editUserForm = $("#updateTask");
	
	var validator = editUserForm.validate({
		
		rules:{
			fsubject :{ required : true },
            fdes : { required : true },
			dueDate : { required : true },
			solver : { required : true, selected : true}
		},
		messages:{
			fsubject : { required : "This field is required" },
            fdes : { required : "This field is required" },
			dueDate : { required : "This field is required" },
			solver : { required : "This field is required", selected : "Please select atleast one option" }						
		}
	});
});