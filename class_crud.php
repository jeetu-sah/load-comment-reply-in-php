<?php
include"database.php"; 
class Class_crud extends dbmodel{
 
  public function insert($tablename,$data_item){
	if(!empty($tablename) && !empty($data_item) && is_array($data_item))
	{
	   $colname = implode(",",array_keys($data_item));
	   $colvalue = implode("','",array_values($data_item));
	   //print_r($colvalue);exit;
	   $sql="INSERT INTO ".$tablename."(".$colname.") VALUES ('".$colvalue."')";
	   //echo $sql;exit;
	   $q = $this->db->prepare($sql);
	   $insert = $q->execute();
		 if(!empty($insert)) {
			return TRUE;  
		  }
		  else
		  {
			return FALSE;  
		  }
	}
	else
	{
	  return false;	
	} 
  }	
  
  public function get_data($table , $con , $col){
    $sql = "SELECT ".$col." FROM ".$table." WHERE ".$con;
	$q = $this->db->prepare($sql);
	$stmt = $q->execute();
	$all_comment = $q->fetchAll();
	if( count($all_comment) > 0 ){
	  return $all_comment;
	}
	else{
	 return FALSE; 
	}
  }
  
  public function get_reply_data($table , $con , $col){
    $sql = "SELECT ".$col." FROM ".$table." WHERE ".$con;
	$q = $this->db->prepare($sql);
	$stmt = $q->execute();
	$all_comment = $q->fetchAll();
	$count = $q->rowCount();
	if($count > 0 ){
	  return $all_comment;
	}
	else{
	 return FALSE; 
	}
  }
}
?>