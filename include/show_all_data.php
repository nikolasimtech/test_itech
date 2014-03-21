<?php
    if($params['show_all'] == true){
	$books = db_get_array("SELECT * FROM books");
	$authors = db_get_array("SELECT * FROM authors");
    }
    if( !defined("NO_REZULT") ){
      define('NO_REZULT', false);
    }
    if(EDIT_OK == 'ok' && NO_REZULT == false){
	if( !empty($_REQUEST['t']) && !empty($_REQUEST['id'])){
	    require('include/edit_item.php');
	}else{
	    require('include/edit_delete.php');
	}
    }
?>

<table class="features-table" style="float:left;">
    <thead>
      <tr>
	<td>
	Books
	</td>
      </tr>
    </thead>
    <tbody>
    <?php
	if( !empty($books) ){
	    foreach($books as $key_ => $book_name){
	    
	    $id_n = $book_name['ID'];
	    $query = "SELECT name FROM authors INNER JOIN links ON links.ID_authors = authors.ID WHERE links.ID_books = '$id_n'";
	    $parents = db_get_array($query);
		$text = '<tr><td class="grey">';
		if(EDIT_OK == 'ok'){
		$text .= '<span style="float:left;"><input type="checkbox" name="book['.$book_name['ID'].']" /></span>';
		}
		$text .= $book_name['name'];
		if( !empty($parents) ){
		    $text .= '<br/><span class="small_inform">Author(s):';
			foreach($parents as $k => $a){
			   $text .= ' '.$a['name'].' '; 
			}
		    $text .= '</span>';
		}
		
		if(EDIT_OK == 'ok'){
		$text .= '<span style="float:right;"> <a href="?t=b&amp;id='.$id_n.'" target="_blank" >Edit </a></span>';
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

<table class="features-table" style="float:right;">
    <thead>
      <tr>
	<td>
	Authors
	</td>
      </tr>
    </thead>
    <tbody>
    <?php
	if( !empty($authors) ){
	    
	    foreach($authors as $key_a => $a_name){
	    $id_n = $a_name['ID'];
	    $query = "SELECT name FROM books INNER JOIN links ON links.ID_books = books.ID WHERE links.ID_authors = '$id_n'";
	    $parents = db_get_array($query);
		$text = '<tr><td class="green">';
		if(EDIT_OK == 'ok'){
		$text .= '<span style="float:left;"><input type="checkbox" name="author['.$a_name['ID'].']" /></span>';
		}
		$text .= $a_name['name'];
		if( !empty($parents) ){
		    $text .= '<br/><span class="small_inform">Book(s):';
			foreach($parents as $k => $a){
			   $text .= ' '.$a['name'].' '; 
			}
		    $text .= '</span>';
		}
		if(EDIT_OK == 'ok'){
		$text .= '<span style="float:right;"> <a href="?t=a&amp;id='.$id_n.'" target="_blank" >Edit </a></span>';
		}
		$text .= '</tr></td>';
		echo $text;
	    }
	}else{
	    echo '<tr><td class="green">no data</tr></td>';
	}
    ?>
    </tbody>
</table>
<?php
    if(EDIT_OK == 'ok' && NO_REZULT == false){
	if( !empty($_REQUEST['t']) && !empty($_REQUEST['id'])){
	
	}else{
	    echo '</form>';
	}
	
    }
?>