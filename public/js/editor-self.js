function initUploadPostImage(){

	$("#imageLocalButton").click(function(){
	 	return  $("#imageLocalInput").click();
	});

	changeUploadImage();
}

function changeUploadImage(){
	$("#imageLocalInput").off("change");
	$("#imageLocalInput").on("change", function () {
		uploadPostImage();
	});	
}


function uploadPostImage(){
	var url = $("#imageUploadUrl").val();
	var _token = $("input[name='_token']").val(); 

	$("#imageLocalButton").hide();
	$("#imageLocalLoading").show();

	$.ajaxFileUpload({
		url:url,
		timeout:60000,
		secureuri:false,                       //是否启用安全提交,默认为false 
		fileElementId:["imageLocalInput"],            //文件选择框的id属性
		dataType:"json",//服务器返回的格式,可以是json或xml等
		type : "post",                       
		data:{
			_token : _token

		},
		success:function(data, status ){ 
			if(data.success == true){
				$("#imageUrl").val(data.file_path);
				console.log("true"+data.file_path);
			}
			
			console.log("success");
			console.log("data:"+data)

		},
		error:function(data, status, e ,w){
			console.log("failed");
			console.log("data:"+data);
		},
		
		complete:function(data, status){

			changeUploadImage();
			$("#imageLocalButton").show();
			$("#imageLocalLoading").hide();

			console.log("complete");
			console.log("status:"+status);
		}
		
		
	  
	});
}