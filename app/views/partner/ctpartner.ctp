 <div id="content">
 
    <div id="content-left"> 

		<?php echo $this->element('content_left')?>
 
 	</div><!-- end content-left-->
 
 
 
 <div id="content-right">
 
		 <?php if($session->read('lang')==1){?>
		 <div id="cr-title">
		 		Đối tác
		 		
		 </div>
		 <div id="cr-content">
		
		 	 <table width="100%">
			 		<tr>
						<td class="t-s td-tit" style="width: 50%">Name:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['name']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Phone:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['phone']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Email:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['email']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Website:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['website']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Fax</td>
						<td align="left"><?php echo $Partner[0]['Partner']['fax']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Address:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['address']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Logo:</td>
						<td align="left"><img class="logo-im" src="<?php echo DOMAINAD.$Partner[0]['Partner']['images']?>"/></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Giới thiệu</td>
						<td align="left"><?php echo $Partner[0]['Partner']['content']?></td>
					</tr>

				</table>
		 	</li>
		 	</ul>
		 	
		 
		 </div><!-- End cr-content -->
		 
		  <?php }if($session->read('lang')==2){?>
		 <div id="cr-title">
		 		Partner
		 		
		 </div>
		 <div id="cr-content">
				 
			 <table width="100%">
			 		<tr>
						<td class="t-s td-tit" style="width: 50%">Name:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['name_eg']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Phone:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['phone']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Email:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['email']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Website:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['website']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Fax</td>
						<td align="left"><?php echo $Partner[0]['Partner']['fax']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Address:</td>
						<td align="left"><?php echo $Partner[0]['Partner']['address']?></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">Logo:</td>
						<td align="left"><img class="logo-im" src="<?php echo DOMAINAD.$Partner[0]['Partner']['images']?>"/></td>
					</tr>
					<tr>
						<td class="t-s" style="width: 50%">About</td>
						<td align="left"><?php echo $Partner[0]['Partner']['content']?></td>
					</tr>

				</table>
		 	
		 
		 	</li>
		 	</ul>
		 	
		 
		 </div><!-- End cr-content -->
		 <?php }?>

 
 </div><!-- end content-right-->

   </div><!-- end content-->
 