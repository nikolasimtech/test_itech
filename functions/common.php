<?php


function fn_stop_work(){
    echo 'Connect no TRUE, check settings please. Thank you.';
    exit;
}

function fn_sign_in($data){
    if( isset($data['login']) && isset($data['pass']) ){
	 if( $data['login'] == ADMIN_LOGIN && $data['pass'] == ADMIN_PASSWORD && $_POST['kapcha'] == $_SESSION['rand_code']){
	    $_SESSION['auth_ok'] = true;
	 }
    }
}

function fn_add_items($items){

  if( !empty($items['add_author']) ){
      $name = htmlspecialchars($items['add_author']);
      
      $exist = db_get_field("SELECT * FROM authors WHERE authors.name = '$name'");
   
      if( empty($exist) && !empty($items['add_book_select']) ){
	  $query = "INSERT INTO authors  SET authors.name = '$name' ;";
	  $r = fn_db_query($query);
	  
	  fn_links_insert('authors', $items['add_book_select'], $name, $r);
	  
      }else{
	  $_SESSION['errors']['add_author'] = $name;
      }
  }
  
  if( !empty($items['add_book']) ){
      $name = htmlspecialchars($items['add_book']);

      $exist = db_get_field("SELECT * FROM books WHERE books.name = '$name'");
       
      if( empty($exist) && !empty($items['add_author_select']) ){
	  $query = "INSERT INTO books  SET books.name = '$name' ;";
	  $r = fn_db_query($query);
	  
	  fn_links_insert('books', $items['add_author_select'], $name, $r);
      }else{
	  $_SESSION['errors']['add_books'] = $name;
      }
  }
}
function fn_links_insert($table, $link_data,$name, $r){
    if( !empty($link_data) && !empty($r) ){
	$id_now = db_get_field("SELECT ID FROM $table WHERE $table.name = '$name'");
	if( $table == 'books' ){
	  $query = "INSERT INTO links  SET links.ID_books = '$id_now', links.ID_authors = '$link_data' ;";
	}elseif( $table == 'authors' ){
	  $query = "INSERT INTO links  SET links.ID_authors = '$id_now', links.ID_books = '$link_data' ;"; 
	}
	fn_db_query($query);
    }
}

function fn_delete_items($data){
  if( isset($data['delete'])){
      if( !empty($data['author']) ){
	  $query = "delete FROM authors  WHERE";
	  $count = count($data['author']);
	  $i = 0;
	  foreach($data['author'] as $key => $val){
	      $i = $i + 1;
	      $query .= " authors.ID = '$key'";
	      if($i != $count){
		$query .= ' OR ';
	      }
	  }
	  $query .= ';';
	  fn_db_query($query);
	  fn_delete_links($data['author'], 'authors',$count);
      }
      
      if( !empty($data['book']) ){
	  $query = "delete FROM books  WHERE";
	  $count = count($data['book']);
	  $i = 0;
	  foreach($data['book'] as $key => $val){
	      $i = $i + 1;
	      $query .= " books.ID = '$key'";
	      if($i != $count){
		$query .= ' OR ';
	      }
	  }
	  $query .= ';';
	  
	 // fn_print_r($query);
	  fn_db_query($query);
	  fn_delete_links($data['book'], 'books',$count);
      }
      
      fn_refound_post_data();
  }
}
function fn_delete_links($data, $table,$count){
    $query = "delete FROM links  WHERE";
    $i = 0;
    foreach($data as $key => $val){
	$i = $i + 1;
	$query .= " links.ID_$table = '$key'";
	if($i != $count){
	  $query .= ' OR ';
	}
    }
    $query .= ';';

    fn_db_query($query);
}

function fn_edit_items( $data ){

}

function fn_refound_post_data(){

    if( isset($_SESSION['post_old']) ){
      unset($_POST);
      $_POST = $_SESSION['post_old'];
      $_SESSION['post'] = $_SESSION['post_old'];
      unset($_SESSION['post_old']);
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