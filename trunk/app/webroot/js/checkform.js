jQuery(document).ready(function($) {
	
	$("#myform").validate({
		rules: {
			name: {
				required: true,
				minlength:8
			},
			
			address: {
				required: true,
				minlength:5
			},
			
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},	
			
			email: {
				required: true,
				email: true,
				
			
			},
		
		    namecompany:{
				required: true,
                minlength: 7
			},
              
			shopname:{
				required: true
			},
			
			phone: {
				required: true,
				 minlength: 7,
				 maxlength: 15,
				 number:true
			},
			mobile: {
				required: true,
				 minlength: 7,
				 maxlength: 15
			},
			cmnd: {
				required: true,
				 minlength: 9,
				 maxlength: 9
			},
			
		},
		messages: {
			name: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập tên!</span>",
				minlength: " <br><span style='color:#FF0000; '>Họ tên bao gồm nhỏ nhất 8 ký tự!</span>"
			},
			name: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập tên!</span>",
				minlength: " <br><span style='color:#FF0000; '>Họ tên bao gồm nhỏ nhất 8 ký tự!</span>"
			},
		
			address: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập địa chỉ!</span>",
				minlength: " <br><span style='color:#FF0000;'>Địa chỉ bao gồm ít nhất5 ký tự!</span>"
			},
		
			email: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập vào Email!</span>",
				email: " <br><span style='color:#FF0000; '>Email không đúng!</span>",
				
			},
			password: {
				required: "<br><span style='color:#FF0000; ' >Xin vui lòng nhập password !</span>",
				minlength: "<br><span style='color:#FF0000; ' > Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>"
			},
		
			confirm_password: {
				required: "<br><span style='color:#FF0000;px ' >Xin vui lòng nhập lại password !</span>",
				minlength: "<br><span style='color:#FF0000; ' >Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>",
				equalTo: "<br><span style='color:#FF0000;' > Password không giống ở trên !</span>"
			},
			
				
			mobile: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập số điện thoại cố định!</span>",
				number: "<br><span style='color:#FF0000; '>Số điện thoại bao gồm các số từ 0 - 9!</span>",
				minlength: "<br><span style='color:#FF0000; '>Số điện thoại ít nhất 7 ký tự!</span>",
				maxlength: "<br><span style='color:#FF0000; '>Số điện thoại nhiều nhất 15 ký tự!</span>",
				number: "<br><span style='color:#FF0000; '>Số điện thoại phải là các số 0-9!</span>",
			},
			
			phone: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập số điện thoại!</span>",
				number: "<br><span style='color:#FF0000; '>Số điện thoại bao gồm các số từ 0 - 9!</span>",
				minlength: "<br><span style='color:#FF0000; '>Số điện thoại ít nhất 7 ký tự!</span>",
				maxlength: "<br><span style='color:#FF0000; '>Số điện thoại nhiều nhất 15 ký tự!</span>",
				number: "<br><span style='color:#FF0000; '>Số điện thoại phải là các số 0-9!</span>",
			},
            
            namecompany: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập tên công ty/cửa hàng!</span>",
				
				minlength: "<br><span style='color:#FF0000; '>Tên công ty/cửa hàng ít nhất 7 ký tự!</span>",
			
			},
		
			
		}
	});	
	
	
	$("#myform1").validate({
		rules: {
		
			email1: {
				required: true,
				email: true,
				
			
			}
			,
			password1: {
				required: true,
				minlength: 5
			},
			
			
		
		},
		messages: {
	
			email1: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập vào Email!</span>",
				email: " <br><span style='color:#FF0000; '>Email không đúng!</span>",
				
			},
			password1: {
				required: "<br><span style='color:#FF0000; ' >Xin vui lòng nhập password !</span>",
				minlength: "<br><span style='color:#FF0000; ' > Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>"
			},
			
		
			
		}
	});	
	
	
	
	$("#myform2").validate({
		rules: {
			name: {
				required: true,
				minlength:8
			},
			
			address: {
				required: true,
				minlength:1
			},
			
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},	
			
			email: {
				required: true,
				email: true,
				
			
			},
			security: {
				required: true,
				minlength: 5,
				maxlength:5
			},
		
			shopname:{
				required: true
			},
			
			phone: {
				required: true,
				 minlength: 7,
				 maxlength: 15,
				 number:true
			},
			mobile: {
				required: true,
				 minlength: 7,
				 maxlength: 15
			},
			
			
		},
		messages: {
			name: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập tên!</span>",
				minlength: " <br><span style='color:#FF0000; '>Họ tên bao gồm nhỏ nhất 8 ký tự!</span>"
			},
			name: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập tên!</span>",
				minlength: " <br><span style='color:#FF0000; '>Họ tên bao gồm nhỏ nhất 8 ký tự!</span>"
			},
		
			address: {
				required: " <br><span style='color:#FF0000; padding-left:148px;'>Xin vui lòng nhập địa chỉ!</span>",
				minlength: " <br><span style='color:#FF0000; padding-left:148px;'>Địa chỉ bao gồm ít nhất 1 ký tự!</span>"
			},
		
			email: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập vào Email!</span>",
				email: " <br><span style='color:#FF0000; '>Email không đúng!</span>",
				
			},
			password: {
				required: "<br><span style='color:#FF0000; ' >Xin vui lòng nhập password !</span>",
				minlength: "<br><span style='color:#FF0000; ' > Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>"
			},
			
			confirm_password: {
				required: "<br><span style='color:#FF0000;px ' >Xin vui lòng nhập lại password !</span>",
				minlength: "<br><span style='color:#FF0000; ' >Xin vui lòng nhập password có chiều dài hơn 5 ký tự!</span>",
				equalTo: "<br><span style='color:#FF0000;' > Password không giống ở trên !</span>"
			},
			
			
			
			phone: {
				required: " <br><span style='color:#FF0000; '>Xin vui lòng nhập số điện thoại!</span>",
				number: "<br><span style='color:#FF0000; '>Số điện thoại bao gồm các số từ 0 - 9!</span>",
				minlength: "<br><span style='color:#FF0000; '>Số điện thoại ít nhất 7 ký tự!</span>",
				maxlength: "<br><span style='color:#FF0000; '>Số điện thoại nhiều nhất 15 ký tự!</span>",
				number: "<br><span style='color:#FF0000; '>Số điện thoại phải là các số 0-9!</span>",
			},
		
			
		}
	});	
	
	
	
	
	
});
