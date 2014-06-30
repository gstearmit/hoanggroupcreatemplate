
<div id="content">

	<div id="content-left"> 

		<?php echo $this->element('content_left')?>
 
 	</div>
	<!-- end content-left-->



	<div id="content-right">
	
		<div id="cr-title">
		<?php if($session->read('lang')==1){?>
			Danh sách khách hàng
		<?php }?>
		
		<?php if($session->read('lang')==2){?>
			Customers list
		<?php }?>
		</div>
		<div id="cr-content">
			<table>
		
		 	<?php
				
				foreach ( $Guest as $cat ) {
					?>
				<tr>
					<td class="listproduct_name"><img
						src="<?php echo DOMAIN?>images/001_59.ico" /> <a
						href="<?php echo DOMAIN?>guest/ctguest/<?php echo $cat['Guest']['id']?>"><?php echo $cat['Guest']['name'] ?></a></td>
				</tr>
		 		<?php }?>
		 		</table>
		 		
		 		
		 		
		 		<div class="pt">
		 			<div class="pt-pagi">
		 		<?php 
		 				
		                echo $paginator->numbers();
		                ?>
		              </div>
		 		</div><!--  End pt -->
		 	
		 	
		 	

		</div>
		<!-- End cr-content -->



	</div>
	<!-- end content-right-->

</div>
<!-- end content-->
 