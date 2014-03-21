<?php

    if( !empty($_POST['search']['q']) ){
	$params['show_all'] = false;
	
	if($_POST['search']['radio'] == 'b'){
	  $params['books'] = true;
	  $params['author'] = false;
	  
	  $table_select = 'books';
	}else{
	  $params['books'] = false;
	  $params['author'] = true;
	  
	  $table_select = 'authors';
	}
	$q = $params['query'] = $_POST['search']['q'];
	
	$query_s = "SELECT * FROM $table_select WHERE name like '%$q%'";
	$search_rezult = db_get_array($query_s);

    }else{
      $params['books'] = true;
      $params['author'] = false;
      $params['show_all'] = true;
      $q = '';
    }

?>

<form name="search_form"  method="post" action="" >
    <div>
      Search in: 
      <input type="radio" name="search[radio]"  value="b" <?php if( !empty($params['books']) ){ echo 'checked="checked"';} ?>/>  books  
      <input type="radio" name="search[radio]" value="a" <?php if( !empty($params['author']) ){ echo 'checked="checked"';}?>/> author  <br/>
      <input type="text" class="input_search" name="search[q]" value="<?php echo $q;?>" />
      
      <input type="submit" value="search"/>
    </div>
</form>

<?php

if( $params['show_all'] === true ){
    require('include/show_all_data.php');
}else{
    require('include/show_search_data.php');
}
?>