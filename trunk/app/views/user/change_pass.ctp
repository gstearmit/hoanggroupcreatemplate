<style>
tr{
height:15px;}

#profile_index {
    border: 1px solid #0066FF;
    border-radius: 8px 8px 8px 8px;
    color: #000000;
    font-size: 10pt;
    margin: 10px auto 20px;
    overflow: hidden;
    padding-bottom: 30px;
    width: 98%;
}
#profile_index table input {
    border: 1px solid #22A8E1;
}
#profile_index table a {
    color: #22A8E1;
}
#profile_index table {
    font-size: 12px;
    margin-left: 20px;
}
#profile_index .edit {
    border: medium none;
}

</style>
<div class="main-content">
  <div class="title-main"><p>Tài khoản cá nhân</p></div>
   <div id="text-main">
	<?php echo $form->create(null, array( 'url' => DOMAIN.'user/confirm_pass','type' => 'post')); ?>	
    <div id="profile_index">
    <table>
        <tr><td  style="padding:20px; padding-left:200px;"colspan="2"><h3>Thay đổi Password</h3></td></tr>
        
        <tr>
            <td>Email </td>
            <td >
            
            <?php echo $this->Form->input('User.email',array('label'=>'','value'=>$edit['User']['email'],'readonly'=>'true','style'=>'width:250px;height:25px;'));?>
            </td>
        </tr>
        <tr height="25"></tr>
        <tr>
            <td>Mật khẩu cũ</td>
            <td>
            
            <?php echo $this->Form->input('User.password_old',array('label'=>'','type'=>'password','style'=>'width:250px;height:25px;'));?>
            </td>
        </tr>
        <tr height="25"></tr>
        <tr>
            <td>Mật khẩu mới</td>
            <td>
            
            <?php echo $this->Form->input('User.password',array('label'=>'','type'=>'password','style'=>'width:250px;height:25px;'));?>
            </td>
        </tr>
        <td>
             <?php echo $this->Form->input('User.id',array('label'=>'','value'=>$edit['User']['id'],'typy'=>'hidden'));?>
        </td></tr>
        <tr>
            <td style="padding-left:140px; padding-top:10px;" colspan="2"><input class="edit" type="image" src="<?php echo DOMAIN?>images/bg_edit.png" /></td>
        </tr>
    </table>
    </div>
  <?php echo $form->end(); ?>
 </div>
   </div>