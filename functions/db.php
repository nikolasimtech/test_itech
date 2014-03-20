<?php

function fn_db_connect($db_host, $db_user, $db_password){
	$db_conn = mysql_connect($db_host, $db_user, $db_password);
	define('CONNECT_TRUE', $db_conn);
	
	return $db_conn;
}

function fn_db_select($db_name){
	if (@mysql_select_db($db_name, CONNECT_TRUE)) {
		return CONNECT_TRUE;
	}

	return false;
}

function fn_db_create($db_name){
	return fn_db_query("CREATE DATABASE IF NOT EXISTS `$db_name`");
}

function fn_table_create($table_name = '', $fields = array(), $key = ''){
    if( !empty($table_name) && !empty($fields) ){
	$query = 'CREATE TABLE '.$table_name .' (';

	$count = count($fields);
	$i = 0;
	foreach($fields as $field => $type){
	  $i = $i + 1;
	  $query .= ' '. $field . ' ' . $type;
	    if( empty($key) && $i == $count ) {
	      // no need symbol ','
	    } else {
	      $query .= ',';
	    }
	}

	if( !empty($key) ){
	  $query .= ' PRIMARY KEY (`'.$key.'`)';
	}

	$query .= ') ENGINE=MyISAM DEFAULT CHARSET=utf8';

	return fn_db_query($query);
    }
}

function fn_db_query($query){
    $result = mysql_query($query, CONNECT_TRUE);
}

function fn_create_db_and_tables($name){
    fn_db_create($config['db_name']); // create db if no exist
}

function fn_tables_exists($tables){

    foreach($tables as $table_name => $v){
      fn_table_create( $table_name, $v['type'], $v['key'] );// create table if no exist
    }

}