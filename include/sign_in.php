<form name="sign_in"  method="post" action="" >
<div style="text-align:center;">
    <b>Login:</b><br/>
    <input type="text" class="short_input button"  style="width:130px;" name="auth[login]" value="admin"/>
    <br/>
    
    <b>Password:</b><br/>
    <input type="text" class="short_input button" name="auth[pass]" style="width:130px;" value="admin">
    <br/>
   
    
     <?php 
	if(EDIT_OK != 'ok'){
	echo '<br/>Enter code please<br/><input class="short_input " placeholder="Kaptcha" type="text" style="width:130px;margin-top: 20px;" name="kapcha" /><br/><br/>';
	}
      ?>
      
       <input type="submit" class="button orange shield xl glossy icon" value="Sign in"/>
</div>
</form>