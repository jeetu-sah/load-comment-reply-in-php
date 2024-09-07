<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<style>
/*font Awesome http://fontawesome.io*/
@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
/*Comment List styles*/
.comment-list .row {
  margin-bottom: 0px;
}
.comment-list .panel .panel-heading {
  padding: 4px 15px;
  position: absolute;
  border:none;
  /*Panel-heading border radius*/
  border-top-right-radius:0px;
  top: 1px;
}
.comment-list .panel .panel-heading.right {
  border-right-width: 0px;
  /*Panel-heading border radius*/
  border-top-left-radius:0px;
  right: 16px;
}
.comment-list .panel .panel-heading .panel-body {
  padding-top: 6px;
}
.comment-list figcaption {
  /*For wrapping text in thumbnail*/
  word-wrap: break-word;
}
/* Portrait tablets and medium desktops */
@media (min-width: 768px) {
  .comment-list .arrow:after, .comment-list .arrow:before {
    content: "";
    position: absolute;
    width: 0;
    height: 0;
    border-style: solid;
    border-color: transparent;
  }
  .comment-list .panel.arrow.left:after, .comment-list .panel.arrow.left:before {
    border-left: 0;
  }
  /*****Left Arrow*****/
  /*Outline effect style*/
  .comment-list .panel.arrow.left:before {
    left: 0px;
    top: 30px;
    /*Use boarder color of panel*/
    border-right-color: inherit;
    border-width: 16px;
  }
  /*Background color effect*/
  .comment-list .panel.arrow.left:after {
    left: 1px;
    top: 31px;
    /*Change for different outline color*/
    border-right-color: #FFFFFF;
    border-width: 15px;
  }
  /*****Right Arrow*****/
  /*Outline effect style*/
  .comment-list .panel.arrow.right:before {
    right: -16px;
    top: 30px;
    /*Use boarder color of panel*/
    border-left-color: inherit;
    border-width: 16px;
  }
  /*Background color effect*/
  .comment-list .panel.arrow.right:after {
    right: -14px;
    top: 31px;
    /*Change for different outline color*/
    border-left-color: #FFFFFF;
    border-width: 15px;
  }
}
.comment-list .comment-post {
  margin-top: 6px;
}
</style>
<?php
include "class_crud.php";
$obj = new Class_crud;
$con = "parent_comment_id = '0' ORDER BY date DESC";
//$result = $obj->get_data("comment_reply_tbl" , $con , "*");
?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2 class="page-header">Comments</h2>
        <section class="comment-list">
          <?php
		    $result_response = '';
			$result = $obj->get_data("comment_reply_tbl" , $con , "*");
			if($result != FALSE){
			   foreach( $result as $row_comment ){
				  $result_response .= output_print($row_comment);
				   //$cp_id = $row_comment['comment_id'];
				   //$con_2 = "parent_comment_id = $cp_id";
				   //$result_2 = $obj->get_data("comment_reply_tbl" , $con_2 , "*");
				    $result_response .= get_comment_reply($obj , $row_comment['comment_id']);
				 }
			 } 
			echo $result_response; 
		  ?>
          
<?php
function get_comment_reply($obj , $parent_id = NULL , $margin_left =  NULL){
   $result = array();
   $result_response = '';
   $con_2 = "parent_comment_id = '$parent_id' ORDER BY date DESC";
   $result = $obj->get_reply_data("comment_reply_tbl" , $con_2 , "*");
   //echo "<pre>";
   //print_r($result); 
   if($parent_id == 0){
	   $margin_left = 0;
	 }
   else{
	 if( $result != FALSE){
		$margin_left = $margin_left + 40; 
		foreach($result as $row_comment){
		    $result_response .= output_print($row_comment , $margin_left);
			$result_response .= get_comment_reply($obj , $row_comment['comment_id'] , $margin_left);
		} 
		
	 }
	}	 
   return $result_response;
}


function output_print($row_comment , $margin = NULL){
   $output = '';
   $output .= '<div class="commentdiv" style="margin-left:'.$margin.'px;" data-commentdivid="post_comment'. $row_comment["comment_id"].'" id="post_comment'. $row_comment["comment_id"].'">
               <article class="row">
                                <div class="col-md-2 col-sm-2 hidden-xs">
								 <figure class="thumbnail">
									<img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
								 </figure>
                               </div>
                               <div class="col-md-10 col-sm-10">
                                <div class="panel panel-default arrow left">
                                 <div class="panel-body">
								  <header class="text-left">
									<time class="comment-date" datetime="16-12-2014 01:05">
									 <i class="fa fa-clock-o"></i>
									  '. $row_comment["date"].'</time>
								  </header>
								  <div class="comment-post">
									<p>'. $row_comment["comments"] .' </p>
								  </div>
                                  <a id="' .$row_comment['comment_id'] .'" class=" comment_reply_child btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a>
								  <span class="reply_box"></span>
                </div>
              </div>
            </div>
                  </article>
				  </div>';
				  	
  return  $output;
}
?>          
        </section>
    </div>
  </div>
</div>
