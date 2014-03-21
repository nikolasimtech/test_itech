<?php
  if( $params['author'] == true ){
      $titles_s = 'Authors';
      $name_checkbox = 'author';
  }else{
      $titles_s = 'Books';
      $name_checkbox = 'book';
  }
  if( !defined("NO_REZULT") ){
      define('NO_REZULT', false);
  }
  
  if(EDIT_OK == 'ok' && NO_REZULT == false){
      require('include/edit_delete.php');
  }else{
      echo '<div style="margin-top: 60px;">';
  }
?>



<table class="features-table" style="width:100%!important;float: left;">
    <thead>
      <tr>
	<td>
	    <?php echo $titles_s; ?>
	    
	    <span style="float:right;"><a href="" style="text-decoration:none;">X</a></span>
	</td>
      </tr>
    </thead>
    <tbody>
    <?php
	if( !empty($search_rezult) ){
	    foreach($search_rezult as $key_s => $name_s){
	    
	    $id_n = $name_s['ID'];
	    if($name_checkbox == 'author'){
	      $query = "SELECT name FROM books INNER JOIN links ON links.ID_books = books.ID WHERE links.ID_authors = '$id_n'";
	    }elseif($name_checkbox == 'book'){
	      $query = "SELECT name FROM authors INNER JOIN links ON links.ID_authors = authors.ID WHERE links.ID_books = '$id_n'";
	    }
	    $parents = db_get_array($query);

		$text = '<tr><td class="grey">';
		if(EDIT_OK == 'ok'){
		$text .= '<span style="float:left;"><input type="checkbox" name="'. $name_checkbox .'['. $name_s['ID'] .']" /></span>';
		}
		$text .= $name_s['name'];
		if( !empty($parents) ){
		    $text .= '<br/><span class="small_inform">'.$titles_s.':';
			foreach($parents as $k => $a){
			   $text .= ' '.$a['name'].' '; 
			}
		    $text .= '</span>';
		}
		
		if(EDIT_OK == 'ok'){
		    if($name_checkbox == 'book'){
			$t = 'b';
		    }elseif($name_checkbox == 'author'){
			$t = 'a';
		    }
		$text .= '<span style="float:right;"> <a href="?t='.$t.'&amp;id='.$id_n.'" target="_blank" >Edit</a></span>';
		}
		$text .= '</tr></td>';
		echo $text;
	    }
	}else{
	    echo '<tr><td class="grey">no data</tr></td>';
	}
    ?>
    </tbody>
</table>

<?php
    if(EDIT_OK == 'ok' && NO_REZULT == false){
	echo '</form>';
    }else{
      echo '</div>';
  }
?>
