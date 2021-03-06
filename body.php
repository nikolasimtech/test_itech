<?php

$books_count = db_get_field('SELECT COUNT(*) FROM books');
$author_count = db_get_field('SELECT COUNT(*) FROM authors');

  if( !empty($_SESSION['auth_ok']) ){
    define('EDIT_OK', 'ok');
    $sign_in = 'Admin';
  }else{
    define('EDIT_OK', 'no');
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
	  
	  <?php 
	      if(EDIT_OK == 'ok'){
		require('include/add_items.php');
	      }else{
		$image_kaptcha = '  <span style="position: absolute;top: 20px;">Image for verification</span>  <img src="captcha.php" style="height: 40px;
    margin-left: 206px;
    margin-top: 21px;
    position: absolute;
    top: -6px;
    width: 100px;"/>';
		echo $image_kaptcha;
	      }
	  ?>

	  <div class="auth">
	    <b>
		<?php if(EDIT_OK == 'ok'){
			require('include/out.php');
		      }else{
			require('include/sign_in.php');
		      }
		?>
	    </b>
	  </div>
    </div>

    <div style="float: left; width: 100%;">
    
    <?php //if(EDIT_OK == 'ok'){
	    require('include/search.php');
	 //}else{
	   // require('include/no_search.php');
	 // }
    ?>
   
     </div>
    <div style="clear:both;"></div>
</div>