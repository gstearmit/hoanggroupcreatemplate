 <?php echo $form->create(null, array( 'url' => DOMAINAD.'settings/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
<table>
    <tr>
        <td>Tên công ty</td>
        <td><?php echo $form->input('Setting.name',array('label' => '','style'=>'width:600px;height:25px;'));?>  </td>
    </tr>
    <tr>
        <td>Địa chỉ</td>
        <td><?php echo $form->input('Setting.address',array('label' => '','style'=>'width:600px;height:25px;'));?>  </td>
    </tr>
    <tr>
        <td>Điện thoai</td>
        <td><?php echo $form->input('Setting.phone',array('label' => '','style'=>'width:600px;height:25px;'));?>  </td>
    </tr>
    <tr>
        <td>Di động</td>
        <td><?php echo $form->input('Setting.mobile',array('label' => '','style'=>'width:600px;height:25px;'));?>  </td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $form->input('Setting.email',array('label' => '','style'=>'width:600px;height:25px;'));?>  </td>
    </tr>
    <tr>
        <td>Từ khóa (SEO)</td>
        <td><?php echo $form->input('Setting.keyword',array('label' => '','cols'=>72,'rows'=>3));?>  </td>
    </tr>
    <tr>
        <td>Mô tả (SEO)</td>
        <td><?php echo $form->input('Setting.description',array('label' => '','cols'=>72,'rows'=>5));?>  </td>
    </tr>
        
</table>
<?php echo $form->input('Setting.id',array('label' => '','type'=>'hidden'));?>
<input type="submit" class="submit-login" value="Submit"  />	
<?php echo $form->end(); ?>