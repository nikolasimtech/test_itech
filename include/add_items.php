<?php
    $books_add = db_get_array("SELECT * FROM books");
    $authors_add = db_get_array("SELECT * FROM authors");
?>

<div id="add_items_show" class="add_items_show" onclick="fn_show_add_items();">
    <span>+ Add item</span>
</div>

<div class="add_items" id="add_items" style="display:none;">
    <b><span class="closer" onclick="fn_hide_add_items();" style="">X</span></b>
     <span style="color:white;">Add book or author:</span>
    <form name="add_books"  method="post" action="" style="text-align: center;">
      <input type="text" name="add_book" class="short_input button glossy" value="" style="width:100px;"/>
	  <?php
	    $slector_a = '<select name="add_author_select" style="width:250px;" class="short_input button glossy" ><option value=""> Select author </option>';
	    if( !empty($authors_add) ){
		foreach($authors_add as $key_select => $v_select){
		    $id = $v_select['ID'];
		    $name = $v_select['name'];
		    $slector_a .= "<option value='$id' > $name </option>";
		}
	    }
	    $slector_a .= '</select>';
	    echo $slector_a;
	  ?>
      <input type="submit" value="+ Add Book" class="button orange glossy" style="width: 200px;"/>
    </form>

    <form name="add_author"  method="post" action="" style="text-align: center;">
     <input type="text" name="add_author"  class="short_input button glossy" value="" style="width:100px;" />
     
      <?php
	$slector_a = '<select name="add_book_select" style="width:250px;" class="short_input button glossy"><option value=""> Select book </option>';
	if( !empty($books_add) ){
	    foreach($books_add as $key_select_ => $v_select_){
		$id = $v_select_['ID'];
		$name = $v_select_['name'];
		$slector_a .= "<option value='$id' > $name </option>";
	    }
	}
	$slector_a .= '</select>';
	
	echo $slector_a;
      ?>
     <input type="submit" value="+ Add Author" class="button orange glossy" style="width: 200px;"/>
    </form>
</div>


