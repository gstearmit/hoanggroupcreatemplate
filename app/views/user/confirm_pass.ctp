<style>
tr{
height:15px;}
tr td input{
height:25px; }
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
#profile_index table {
    font-size: 12px;
    margin-left: 20px;
}
#profile_index table input {
    border: 1px solid #22A8E1;
}

</style>
<div id="main">
    <div id="content">
       <div class="title"><h1>Thông tin cá nhân</h1></div>
       <div id="text-main">
       <?php echo $form->create(null, array( 'url' => DOMAIN.'user/change_pass','type' => 'post')); ?>	
       	 <div id="profile_index">
        <table>
            <tr><td  style="padding:20px; padding-left:200px;"colspan="2"><h3>Thay đổi Password</h3></td></tr>
            
            <tr>
                <td>Email </td>
                <td >
                
                <?php
                 echo $email;
                 echo $this->Form->input('User.email',array('label'=>'','type'=>'hidden','value'=>$email,'readonly'=>'true','style'=>'width:250px;height:25px;'));?>
                </td>
            </tr>
            <tr height="25"></tr>
            <tr>
                <td>Mật khẩu cũ</td>
                <td>
                
                <?php 
                if($password_old==''){
                echo $this->Form->input('User.password_old',array('label'=>'','type'=>'hidden','value'=>$password_old,'style'=>'width:250px;height:25px;'));	
                }
                if($password_old!=''){
                echo '*********';
                echo $this->Form->input('User.password_old',array('label'=>'','type'=>'hidden','value'=>$password_old,'style'=>'width:250px;height:25px;'));
                }?>
                </td>
            </tr>
            <tr height="25"></tr>
            <tr>
                <td>Mật khẩu</td>
                <td>
                
                <?php
                if($password=='') {
                    echo $this->Form->input('User.password_new',array('label'=>'','type'=>'hidden','value'=>$password,'style'=>'width:250px;height:25px;'));
                }
                if($password!=''){
                echo '*********';
                echo $this->Form->input('User.password_new',array('label'=>'','type'=>'hidden','value'=>$password,'style'=>'width:250px;height:25px;'));
                }
                ?>
                </td>
            </tr>
            <td>
                 <?php echo $this->Form->input('User.id',array('label'=>'','value'=>$id,'type'=>'hidden'));?>
            </td></tr>
            <tr>
                <td style="padding-left:200px; padding-top:20px;" colspan="2">
                 <input class="submit" style=" cursor:pointer; width:55px; -moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 5px 5px 5px 5px;background:#FFFFFF;"type="submit"  value="Sửa" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class="submit" style=" cursor:pointer; margin:-left:20px; width:55px; -moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 5px 5px 5px 5px;background:#FFFFFF;" type="button" name = "" value="Trở lại" onclick ="history.go(-1);" />        </td>
            </tr>
        </table>
        </div>
       <?php echo $form->end(); ?>
     </div>
</div>