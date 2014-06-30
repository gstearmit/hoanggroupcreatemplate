<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
     <?php echo $form->create(null, array( 'url' => DOMAINAD.'login/login','type' => 'post')); ?>	
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Tên đăng nhập</th>
			<td><?php echo $form->input('User.name',array( 'label' => '','class'=>'login-inp'));?></td>
		</tr>
		<tr>
			<th>Mật khẩu </th>
			<td><?php echo $form->input('User.password',array( 'label' => '','type'=>'password','class'=>'login-inp'));?></td>
		</tr>
		<tr>
			<th></th>
		  <td valign="top"><label for="login-check"> <?php //echo $this->Html->link('Quên mật khẩu', array('controller' => 'login', 'action' => 'password')); ?></label></td>
		</tr>
		<tr>
			<th></th>
			<td><input style="margin-left: 14px;margin-top: 5px;" type="submit" class="submit-login"  /></td>
		</tr>
		</table>
        <?php echo $form->end(); ?>	
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	
 </div>