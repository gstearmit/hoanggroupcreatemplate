 <div id="content">
 
    <div id="content-left"> 

		<?php echo $this->element('content_left')?>
 
 	</div><!-- end content-left-->
 
 
 
 <div id="content-right">

		 <div id="cr-title">
		 <?php if($session->read('lang')==1){?>
			Khách hàng
		<?php }?>
		 <?php if($session->read('lang')==2){?>
			Customers
		<?php }?>
		 		
		 		
		 		
		 </div>
		 <div id="cr-content">
		
		 	 <table width="100%">
			 		<tr>
						<td class="t-s td-tit" style="width: 50%">Name:</td>
						<td align="left"><?php echo $Guest[0]['Guest']['name']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Phone:</td>
						<td align="left"><?php echo $Guest[0]['Guest']['phone']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Email:</td>
						<td align="left"><?php echo $Guest[0]['Guest']['email']?></td>
					</tr>
				
					<tr>
						<td class="t-s" style="width: 50%">Address:</td>
						<td align="left"><?php echo $Guest[0]['Guest']['address']?></td>
					</tr>
	
					<tr>
						<td class="t-s" style="width: 50%">Thông tin thêm</td>
						<td align="left"><?php echo $Guest[0]['Guest']['content']?></td>
					</tr>

				</table>
		 	</li>
		 	</ul>
		 	
		 
		 </div><!-- End cr-content -->
		 
		
 
 </div><!-- end content-right-->

   </div><!-- end content-->
 