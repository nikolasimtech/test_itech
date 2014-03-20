<?php

$books_count = db_get_field('SELECT COUNT(*) FROM books');
$author_count = db_get_field('SELECT COUNT(*) FROM authors');

  if( !empty($_SESSION['auth_ok']) ){
    $sign_in = 'Admin';
  }else{
    $sign_in = 'Sign in';
  }

?>

<div id="formreferral" style="margin: 12px auto 0px;" class="main">
    <div id="info" style="margin: 12px auto 0px;" class="">
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
    <form name="main_form"  method="post" action="" >
     test
    </form>
    <div style="clear:both;"></div>
</div>