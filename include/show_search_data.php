<?php
  if( $params['author'] == true ){
      $titles_s = 'Authors';
  }else{
      $titles_s = 'Books';
  }
?>


<table class="features-table" style="width:100%!important;">
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
		$text = '<tr><td class="grey">';
		if(EDIT_OK == 'ok'){
		$text .= '<span style="float:left;"><input type="checkbox" name="book_'.$name_s['ID'].'" /></span>';
		}
		$text .= $name_s['name'];
		$text .= '</tr></td>';
		echo $text;
	    }
	}else{
	    echo '<tr><td class="grey">no data</tr></td>';
	}
    ?>
    </tbody>
</table>