<?php


function fn_stop_work(){
    echo 'Connect no TRUE, check settings please. Thank you.';
    exit;
}

function fn_sign_in($data){
    if( isset($data['login']) && isset($data['pass']) ){
	 if( $data['login'] == ADMIN_LOGIN && $data['pass'] == ADMIN_PASSWORD ){
	    //return fn_start_session();
	    $_SESSION['auth_ok'] = true;
	 }
    }
}

function fn_add_items($items){

  if( !empty($items['add_author']) ){
      $name = htmlspecialchars($items['add_author']);
      
      $exist = db_get_field("SELECT * FROM authors WHERE authors.name = '$name'");
   
      if( empty($exist) ){
	  $query = "INSERT INTO authors  SET authors.name = '$name' ;";
	  fn_db_query($query);
      }else{
	  $_SESSION['errors']['add_author'] = $name;
      }
  }
  
  if( !empty($items['add_book']) ){
      $name = htmlspecialchars($items['add_book']);

      $exist = db_get_field("SELECT * FROM books WHERE books.name = '$name'");
       
      if( empty($exist) ){
	  $query = "INSERT INTO books  SET books.name = '$name' ;";
	  fn_db_query($query);
      }else{
	  $_SESSION['errors']['add_books'] = $name;
      }
  }
}

function fn_sign_out($data){
    unset($_SESSION);
    fn_end_session();   
}

function fn_start_session(){
    if ( session_id() ) {
	return true;
    } else {
	return session_start();
    } 
    
}

function fn_end_session(){
    if ( session_id() ) {
	setcookie(session_name(), session_id(), time()-60*60*24);
	session_unset();
	session_destroy();
    }
}