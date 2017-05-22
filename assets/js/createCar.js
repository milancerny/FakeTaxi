$(document).ready(function(){
	
	var createCarForm = $("#createCar");
	
	var validator = createCarForm.validate({
		
		rules: {
			carType :{ required : true },
            carSubType : { required : true },
			ecv : { required : true },
            vin : { required : true },
            totalKm : { required : true },
            color : { required : true }
		},
		messages: {
			carType : { required : "This field is required" },
            carSubType : { required : "This field is required" },
			ecv : { required : "This field is required" },
            vin : { required : "This field is required" },
            totalKm : { required : "This field is required" },
            color : { required : "This field is required" }			
		}
	});
});