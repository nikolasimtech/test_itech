<?php
    if($params['show_all'] == true){
	$books = db_get_array("SELECT * FROM books");
	$authors = db_get_array("SELECT * FROM authors");
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
		$text = '<tr><td class="grey">';
		if(EDIT_OK == 'ok'){
		$text .= '<span style="float:left;"><input type="checkbox" name="book_'.$book_name['ID'].'" /></span>';
		}
		$text .= $book_name['name'];
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
		$text = '<tr><td class="green">';
		if(EDIT_OK == 'ok'){
		$text .= '<span style="float:left;"><input type="checkbox" name="author_'.$a_name['ID'].'" /></span>';
		}
		$text .= $a_name['name'];
		$text .= '</tr></td>';
		echo $text;
	    }
	}else{
	    echo '<tr><td class="green">no data</tr></td>';
	}
    ?>
    </tbody>
</table>