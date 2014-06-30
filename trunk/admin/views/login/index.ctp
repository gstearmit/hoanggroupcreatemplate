<div id="login-inner">
 <?php echo $form->create(null, array( 'url' => DOMAINAD.'login/login','type' => 'post')); ?>	
				
    <div class="notification information png_bg">
    </div>
    
    <p>
        <label>Username</label>
        <?php echo $form->input('User.name',array( 'label' => '','class'=>'text-input'));?>
    </p>
    <div class="clear"></div>
    <p>
        <label>Password</label>
       <?php echo $form->input('User.password',array( 'label' => '','type'=>'password','class'=>'text-input'));?>
    </p>
    <div class="clear"></div>
    <p id="remember-password">
       <!-- <input type="checkbox" />Remember me-->
    </p>
    <div class="clear"></div>
    <p>
        <input class="button" type="submit" value="Sign In" />
    </p>
    
 <?php echo $form->end(); ?>	
 </div>