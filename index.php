<?php include "class_crud.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Comment and reply process using PHP and Ajax</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<style>
body{ background: #fafafa;}
.widget-area.blank {
background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
-webkit-box-shadow: none;
-moz-box-shadow: none;
-ms-box-shadow: none;
-o-box-shadow: none;
box-shadow: none;
}
body .no-padding {
padding: 0;
}
.widget-area {
background-color: #fff;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
-ms-border-radius: 4px;
-o-border-radius: 4px;
border-radius: 4px;
-webkit-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
-moz-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
-ms-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
-o-box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
box-shadow: 0 0 16px rgba(0, 0, 0, 0.05);
float: left;
margin-top: 30px;
padding: 25px 30px;
position: relative;
width: 100%;
}
.status-upload {
background: none repeat scroll 0 0 #f5f5f5;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
-ms-border-radius: 4px;
-o-border-radius: 4px;
border-radius: 4px;
float: left;
width: 100%;
}
.status-upload form {
float: left;
width: 100%;
}
.status-upload form textarea {
background: none repeat scroll 0 0 #fff;
border: medium none;
-webkit-border-radius: 4px 4px 0 0;
-moz-border-radius: 4px 4px 0 0;
-ms-border-radius: 4px 4px 0 0;
-o-border-radius: 4px 4px 0 0;
border-radius: 4px 4px 0 0;
color: #777777;
float: left;
font-family: Lato;
font-size: 14px;
height: 142px;
letter-spacing: 0.3px;
padding: 20px;
width: 100%;
resize:vertical;
outline:none;
border: 1px solid #F2F2F2;
}

.status-upload ul {
float: left;
list-style: none outside none;
margin: 0;
padding: 0 0 0 15px;
width: auto;
}
.status-upload ul > li {
float: left;
}
.status-upload ul > li > a {
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
-ms-border-radius: 4px;
-o-border-radius: 4px;
border-radius: 4px;
color: #777777;
float: left;
font-size: 14px;
height: 30px;
line-height: 30px;
margin: 10px 0 10px 10px;
text-align: center;
-webkit-transition: all 0.4s ease 0s;
-moz-transition: all 0.4s ease 0s;
-ms-transition: all 0.4s ease 0s;
-o-transition: all 0.4s ease 0s;
transition: all 0.4s ease 0s;
width: 30px;
cursor: pointer;
}
.status-upload ul > li > a:hover {
background: none repeat scroll 0 0 #606060;
color: #fff;
}
.status-upload form button {
border: medium none;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
-ms-border-radius: 4px;
-o-border-radius: 4px;
border-radius: 4px;
color: #fff;
float: right;
font-family: Lato;
font-size: 14px;
letter-spacing: 0.3px;
margin-right: 9px;
margin-top: 9px;
padding: 6px 15px;
}
.dropdown > a > span.green:before {
border-left-color: #2dcb73;
}
.status-upload form button > i {
margin-right: 7px;
}
</style>
 <div id="get_comment"></div>
<script>
    $(document).ready(function(){
    $("[data-toggle=tooltip]").tooltip();
});
    </script>
<script>
$(document).ready(function(e) {
  $(document).on('click','#comment_btn',function(){
    var comment = $('#comment_blog').val();
	var parent_id = $('#parent_id').val();
	$.ajax({
      url: "comment.php",
      type: "GET",           
      data: {comment:comment , parent_id:parent_id},
      success: function(response){
		 location.reload();
		 //$('#all_commet').load(document.URL + ' #all_commet');
		 //alert(response);
		 //$("#state").html(res);
		}
       });
  });   
});
</script>
<script>
$(document).ready(function(e) {
    $("#get_comment").load("get_comment.php", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
           // alert("External content loaded successfully!");
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
});
</script>
<script>
$(document).ready(function(e) {
  $(document).on('click','.comment_reply_child',function(){
   //var comment_box_id = $(this).parent().parent().parent().parent().parent().parent().find('.commentdiv').data('commentdivid'); 
   alert(comment_box_id);
	 var comment_reply_parent =  this.id;
	 var reply_box_count = $(".message_box").length;
	 var html_content =  '<div class="message_box">'+
	                     '<input type="hidden" name="parent_id" id="parent_id" value="'+ comment_reply_parent +'"  />'+
						 '<textarea style="margin-top:5px;" placeholder="What are you doing right now?" id="comment_blog" class="form-control"></textarea>'+ 
						 '<button style="margin-top:5px;" type="button" class="btn btn-success green" id="comment_btn" name="comment_btn"><i class="fa fa-share"></i> Share</button>'+
		                 '</div>'; 
	 if( reply_box_count < 1 ){
		 $(this).next('.reply_box').append(html_content);
	   }
	 else{
		  $('.message_box').remove();
		  $(this).next('.reply_box').append(html_content);
	   }  
	 //$("#parent_id").val(comment_reply_parent);
  });	
 
});
</script>
</body>
</html>