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
		$text .= '<span style="float:left;"><input type="checkbox" name="'. $name_checkbox .'['. $name_s['ID'] .']" /></span>';
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

<?php
    if(EDIT_OK == 'ok' && NO_REZULT == false){
	echo '</form>';
    }
?>
