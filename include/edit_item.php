<?php
if($_REQUEST['t'] == 'b'){
    $request_t = $_REQUEST['t'];
    $t_update = 'books';
    $t_update_another = 'authors';
    $id_update = $_REQUEST['id'];
    
    $query = "SELECT name FROM authors INNER JOIN links ON links.ID_authors = authors.ID WHERE links.ID_books = '$id_update'";
    
    if( !empty($_REQUEST['del']) ){
	$del = $_REQUEST['del'];
	$query_d = "DELETE FROM links WHERE ID_$t_update_another = '$del' AND ID_$t_update = '$id_update'";
	fn_db_query($query_d);
    }
    
    fn_print_r($_POST);
    
}elseif($_REQUEST['t'] == 'a'){
    $request_t = $_REQUEST['t'];
    $t_update = 'authors';
    $t_update_another = 'books';
    $id_update = $_REQUEST['id'];
    
    $query = "SELECT name FROM books INNER JOIN links ON links.ID_books = books.ID WHERE links.ID_authors = '$id_update'";
    
    if( !empty($_REQUEST['del']) ){
	$del = $_REQUEST['del'];
	$query_d = "DELETE FROM links WHERE ID_$t_update_another = '$del' AND ID_$t_update = '$id_update'";
	fn_db_query($query_d);
    }
}



    $data_update = db_get_array("SELECT * FROM $t_update WHERE $t_update.ID = '$id_update'");
    $query = "SELECT * FROM authors INNER JOIN links ON links.ID_authors = authors.ID WHERE links.ID_books = '$id_update'";
    $parents = db_get_array($query);
    $all_parents = db_get_array("SELECT * FROM $t_update_another");

?>

<div style="margin-top:60px;">
    <form name="edit_item"  method="post" action="" >
	<input type="hidden" name="update[id]" value="<?php echo $id_update;?>"/>
	<input type="text" name="update[name]" value="<?php echo $data_update[0]['name'];?>"/>
	
	<?php
	  if( !empty($all_parents) ){
	    $slector_a = '<select name="add_author_select" style="width:150px;"><option value=""> Select author </option>';
	    //fn_print_r($parents,$all_parents);
	    foreach($all_parents as $key_select => $v_select){
	    $access = true;
		if( !empty($parents) ){
		    foreach($parents as $key_p => $v_p){
			if($v_p['ID'] == $v_select['ID']){
			$access = false;
			break;
			}else{
			$access = true;
			}
		    }
		}
		
		if($access ==  true){
		  $id = $v_select['ID'];
		  $name = $v_select['name'];
		  $slector_a .= "<option value='$id' > $name </option>";
		}
	    }
	    $slector_a .= '</select>';
	    
	    echo $slector_a;
	    
	    if( !empty($parents) ){
		$list = '<table><tr><td>'.$t_update_another.'</td></tr>';
		    foreach($parents as $key_p_ => $v_p_){
		      $list .= '<tr><td><a href="?t='.$request_t.'&amp;id='.$id_update.'&amp;del='.$v_p_['ID'].'">'.$v_p_['name'].'</a>';
		    }
		$list .= '</table>';
		
		echo $list;
		    
	    }
	  }
	  ?>
	
	<input type="submit" name="updated" value="Update"/>
    </form>
</div>