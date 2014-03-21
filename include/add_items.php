<?php
    $books_add = db_get_array("SELECT * FROM books");
    $authors_add = db_get_array("SELECT * FROM authors");
?>

<div style="float:left; margin-left:50px;">
    <form name="add_books"  method="post" action="">
      <input type="text" name="add_book" class="short_input" value=""/>
	  <?php
	  if( !empty($authors_add) ){
	    $slector_a = '<select name="add_author_select" style="width:150px;"><option value=""> Select author </option>';
	    foreach($authors_add as $key_select => $v_select){
		$id = $v_select['ID'];
		$name = $v_select['name'];
		$slector_a .= "<option value='$id' > $name </option>";
	    }
	    $slector_a .= '</select>';
	    
	    echo $slector_a;
	  }
	  ?>
 
      <input type="submit" value="+ Add Book"/>
    </form>

    <form name="add_author"  method="post" action="" >
     <input type="text" name="add_author"  class="short_input" value="" />
     
      <?php
      if( !empty($books_add) ){
	$slector_a = '<select name="add_book_select" style="width:150px;"><option value=""> Select book </option>';
	foreach($books_add as $key_select_ => $v_select_){
	    $id = $v_select_['ID'];
	    $name = $v_select_['name'];
	    $slector_a .= "<option value='$id' > $name </option>";
	}
	$slector_a .= '</select>';
	
	echo $slector_a;
      }
      ?>
	  
     <input type="submit" value="+ Add Author"/>
    </form>
</div>