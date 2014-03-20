<?php
    if( isset($_SESSION['search']) ){
      $params['books'] = $_SESSION['search']['books'];
      $params['author'] = $_SESSION['search']['author'];
      $params['show_all'] = false;
    }else{
      $params['books'] = true;
      $params['author'] = false;
      $params['show_all'] = true;
    }
$param = $_SESSION['params']
?>

<form name="search_form"  method="post" action="" >
    <div>
      Search in:  
      books: <input type="radio" name="check_search" <?php if( !empty($params['books']) ){ echo 'checked="checked"';} ?>/> 
      author: <input type="radio" name="check_search" <?php if( !empty($params['author']) ){ echo 'checked="checked"';}?>/> <br/>
      <input type="text" class="input_search" name="search[q]" value=""><input type="submit" value="search">
    </div>
</form>

<?php

if( $params['show_all'] === true ){
 require('include/show_all_data.php');
}
?>