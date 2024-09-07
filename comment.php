<?php
include "class_crud.php";
$obj = new Class_crud;
if(isset($_GET['comment'])){
    if(!empty($_GET['comment'])){
	   $response = $obj->insert("comment_reply_tbl" , array("comments"=>$_GET['comment']  , "parent_comment_id"=>$_GET['parent_id'], "date"=>date('Y-m-d h:i:s'))); 
	   if($response != FALSE){
		  echo "Comment sent successful .";exit;
		}
	    else{
	      echo "Comment sent successful .";exit;
	    }	
	}
  }
  
  
?>