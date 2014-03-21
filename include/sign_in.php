<form name="sign_in"  method="post" action="" >
    <b>Login:</b><br/>
    <input type="text" class="short_input" name="auth[login]" value=""/>
    <br/>
    
    <b>Password:</b><br/>
    <input type="text" class="short_input" name="auth[pass]" value="">
    <br/>
    <input type="submit" class="button" value="Sign in"/>
    
     <?php 
	if(EDIT_OK != 'ok'){
	echo '<br/><input class="short_input" placeholder="Kaptcha" type="text" style="margin-top: 20px;" name="kapcha" />';
	}
      ?>
</form>