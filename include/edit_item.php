<?php
if(EDIT_OK == 'ok'){
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

	if( !empty($_POST['update']) ){
	    $upd = $_POST['update'];
	    if( !empty($upd['id']) && !empty($upd['name']) ){
		$query = "UPDATE books SET name = '".$upd['name']."' WHERE ID = '".$upd['id']."';";
		fn_db_query($query);
		if( !empty($upd['add_author_select']) ){
		    $id_l_u = $upd['add_author_select'];
		    $exist = db_get_field("SELECT * FROM links WHERE links.ID_authors = '$id_l_u' AND links.ID_books = '$id_update'");

		    if( empty($exist) ){
			$query = "INSERT INTO links  SET links.ID_books = '$id_update', links.ID_authors = '$id_l_u' ;";
			fn_db_query($query);
		    }
		}
	    }
	}
	
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
	
	if( !empty($_POST['update']) ){
	    $upd = $_POST['update'];
	    if( !empty($upd['id']) && !empty($upd['name']) ){
		$query = "UPDATE authors SET name = '".$upd['name']."' WHERE ID = '".$upd['id']."';";
		fn_db_query($query);
		
		if( !empty($upd['add_author_select']) ){
		    $id_l_u = $upd['add_author_select'];
		    $exist = db_get_field("SELECT * FROM links WHERE links.ID_books = '$id_l_u' AND links.ID_authors = '$id_update'");

		    if( empty($exist) ){
			$query = "INSERT INTO links  SET links.ID_authors = '$id_update', links.ID_books = '$id_l_u' ;";
			fn_db_query($query);
		    }
		}
	    }
	}
    }

}

    $data_update = db_get_array("SELECT * FROM $t_update WHERE $t_update.ID = '$id_update'");
    $query_parents = "SELECT * FROM $t_update_another INNER JOIN links ON links.ID_$t_update_another = $t_update_another.ID WHERE links.ID_$t_update = '$id_update'";
    $parents = db_get_array($query_parents);
    
    
    $all_parents = db_get_array("SELECT * FROM $t_update_another");

?>

<div style="margin-top:80px;">
    <form name="edit_item"  method="post" action="" >
	<input type="hidden" name="update[id]" value="<?php echo $id_update;?>"/>
	<input type="text" name="update[name]" value="<?php echo $data_update[0]['name'];?>" class="button glass icon pink" style="width:200px;"/>
	
	<?php
	  if( !empty($all_parents) ){
	    $slector_a = '<select name="update[add_author_select]" class="button glass icon pink" style="width:200px;"><option value=""> Select item </option>';
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
	    
	    
	  }
	  ?>
	<input type="submit" name="updated" value="Update" class="button orange drop_left glass icon" style="position: relative;width: 150px;margin-left: 50px;" />
	
	 <a style="position: relative;width: 150px;margin-left: 0px;" href="?main" class="button orange drop glass icon">Clouse edit</a>
	 
	<?php
	 if( !empty($all_parents) ){
	    if( !empty($parents) ){
		$list = '<div><br/><span>'.$t_update_another.':</span>';
		    foreach($parents as $key_p_ => $v_p_){
		      $list .= '<span style=" margin-left: 15px;">'.$v_p_['name'].'</span><a class="a_update" href="?t='.$request_t.'&amp;id='.$id_update.'&amp;del='.$v_p_['ID'].'">x</a>';
		    }
		$list .= '</div>  ';
		
		echo $list;
		    
	    }
	 }
	?>
	
    </form>
   
</div>