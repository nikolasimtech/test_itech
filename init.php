<?php
session_start(); 

require('settings.php');
require('functions/db.php');
require('functions/debugs.php');
require('functions/common.php');

if( isset($_POST) ){
    $_SESSION['post'] = $_POST;
}
//fn_print_r($_SESSION);
$connect = fn_db_connect($config['db_host'],$config['db_user'],$config['db_password']);

// Auto install, create db and tables
if( !empty($connect) ){
  $select = fn_db_select($config['db_name']);
  
  if( empty($select) ){
      fn_create_db_and_tables($config['db_name']);
      $select = fn_db_select($config['db_name']); // select again
  }
  if( empty($select) ){
    fn_stop_work();
  }else{
    $tables = array(
      'books' => array(
	  'type' => array(
	    'ID'=> 'mediumint(8) unsigned NOT NULL AUTO_INCREMENT',
	    'name'=> 'varchar(255) NOT NULL DEFAULT ""',
	  ),
	  'key' => 'ID',
      ),
      'authors' => array(
	  'type' => array(
	    'ID'=> 'mediumint(8) unsigned NOT NULL AUTO_INCREMENT',
	    'name'=> 'varchar(255) NOT NULL DEFAULT ""',
	  ),
	  'key' => 'ID',
	  
      ),
      'links' => array(
	  'type' => array(
	      'ID_books'=> 'int(8) NOT NULL',
	      'ID_authors'=> 'int(8) NOT NULL',
	  ),
	  'key' => '',
      ),
    );
    
    fn_tables_exists($tables); // create tables if no exist
  }
    
  if( isset($_POST['auth']) ){
      fn_sign_in($_POST['auth']); // start session
  }
  
  if( isset($_POST['out']) ){
      fn_sign_out($_POST['out']); // end session
  }
  
  if( !empty($_POST) ){
      fn_add_items($_POST);
      fn_delete_items($_POST);
      fn_edit_items($_POST);
  }

  if(isset($_SESSION['post'])){
      $_SESSION['post_old'] = $_SESSION['post'];
  }
  
}else{
  fn_stop_work();
}
//fn_db_select
