   <div id="main">
      <div class="title_top_news_detail"><p>Đặt mua</p></div>
       <div id="text-main">
          <p>
                       <?php echo $form->create(null, array( 'url' => DOMAIN.'contacts/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'myForm','id'=>'check_form')); ?> 

          <table width="500" class="table" border="1" cellpadding="0" cellspacing="0">
                 <tr>
                    <td>STT</td>
                   <!-- <td>Ảnh sản phẩm</td>-->
                    <td>Tên sả phẩm</td>
                    <td>Số lượng</td>
                    <!--<td>Giá</td>
                    <td>Thành tiền</td>-->
                    <td>Hãng sản xuất</td>
                    <td>Xử lý</td>
                 </tr>
                  <?php $i=0; foreach ($payments as $payment){ $j = $i + 1 ;?>
                   <?php echo $form->create(null, array( 'url' => DOMAIN.'buy_carts/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>
                   <tr style="line-height:30px;">
                     <td><?php echo $j;?></td>
                     <td>
					 <?php echo $payment['Cart']['title'];?>
                     <input type="hidden" value="<?php echo $payment['Cart']['title'];?>" name="name_product" />
                     </td>
                     <td><?php echo $payment['Cart']['number'];?>
                      <input type="hidden" value="<?php echo $payment['Cart']['number'];?>" name="number" />
                      </td>
                    <!-- <td><?php //echo $payment['Cart']['price'];?>
                     <input type="hidden" value="<?php //echo $payment['Cart']['price'];?>" name="price" />
                     </td>
                     <td><?php //$cost=$payment['Cart']['price'] * $payment['Cart']['number']; echo $cost;?>
                     <input type="hidden" value="<?php //$cost=$payment['Cart']['price'] * $payment['Cart']['number']; echo $cost;?>" name="cost" />
                     </td>-->
                     <td><?php echo $payment['Cart']['producer'];?>
                      <input type="hidden" value="<?php echo $payment['Cart']['producer'];?>" name="producer" />
                     </td>
                     <td><a href="<?php echo DOMAIN?>buy_carts/delete/<?php echo $payment['Cart']['id'];?>">Xóa</a></td>
                   </tr>
                   
                    
                 <?php echo $form->end(); ?>
                 <?php }?>
               </table>
               <h3 style="margin-top:10px;" class="line">Thông tin khách hàng </h3>
             <div id="contact_detail">
                <p>Tên của bạn <span style="color:#F00;">*</span><br>
                    <?php echo $form->input('Contact.name',array( 'label' => '','class'=>'validate[required]','id'=>'send_contact'));?>
                 </p>
                <p>Địa chỉ thư điện tử của bạn <span style="color:#F00;">*</span><br>
                    <?php echo $form->input('Contact.email',array( 'label' => '','class'=>'validate[required,custom[email]]','id'=>'send_contact'));?>
                </p>
                <p>Địa chỉ <span style="color:#F00;">*</span><br>
                    <?php echo $form->input('Contact.address',array( 'label' => '','class'=>'validate[required]','id'=>'send_contact'));?>
                 </p>
                 <p>Điện thoại <span style="color:#F00;">*</span><br>
                   <?php echo $form->input('Contact.phone',array( 'label' => '','class'=>'validate[required,custom[telephone]]','id'=>'send_contact'));?>
                  </p>
                <p>Tên Công ty<br>
                   <?php echo $form->input('Contact.name-company',array( 'label' => '','id'=>'send_contact'));?>
                 </p>
                <p>Tiêu đề <span style="color:#F00;">*</span><br>
                    <?php echo $form->input('Contact.title',array( 'label' => '','class'=>'validate[required]','id'=>'send_contact'));?>
                 </p>
                <p>Thông điệp của bạn<span style="color:#F00;">*</span><br>
                  <?php echo $form->textarea('Contact.detail',array( 'label' => '','class'=>'validate[required]','id'=>'textarea'));?>
                 </p>
                <p>
                  </p><div id="lienheleft">Mã bảo Vệ<span style="color:#F00;">*</span></div>
                    <td><?php echo $form->input('Contact.code',array( 'label' => '','style'=>'float:left; ','class'=>'validate[required]'));?> &nbsp;&nbsp;&nbsp;<img alt="" id="captcha" src="<?php echo DOMAIN?>contacts/create_image" /></td>
                
                <p><?php echo $form->submit('Gửi', array('style'=>'margin-left:100px;')); ?></p>
           <?php echo $form->end(); ?>
        </div>
          </p>
       </div>
   </div>
 <!--end-->


