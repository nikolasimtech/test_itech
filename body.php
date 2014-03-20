<?php

$books_count = db_get_field('SELECT COUNT(*) FROM books');
$author_count = db_get_field('SELECT COUNT(*) FROM authors');

  if( !empty($_SESSION['auth_ok']) ){
    $sign_in = 'Admin';
  }else{
    $sign_in = 'Sign in';
  }

?>

<div style="margin: 12px auto 0px;" class="main">
    <div style="margin: 12px auto 0px;" class="">
	  <div class="title">
	    <b>General:</b>
	    <span class="padding_left">Books: <?php echo $books_count;?>  item(s)</span>
	    <span class="padding_left">Authors: <?php echo $author_count;?>  item(s)</span>
	  </div>
	  <div class="auth">
	    <b>
		<?php if($sign_in === 'Admin'){
			require('include/out.php');
		      }else{
			require('include/sign_in.php');
		      }
		?>
	    </b>
	  </div>
    </div>

    <div style="float: left; width: 100%;">
    
    <?php if($sign_in === 'Admin'){
	    require('include/search.php');
	  }else{
	    require('include/no_search.php');
	  }
    ?>
   
     </div>
    <div style="clear:both;"></div>
</div>