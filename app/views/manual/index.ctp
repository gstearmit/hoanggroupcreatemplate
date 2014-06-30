
<div id="content">

	<div id="content-left"> 

		<?php echo $this->element('content_left')?>
 
 	</div>
	<!-- end content-left-->



	<div id="content-right">
	
		<div id="cr-title">
		<?php if($session->read('lang')==1){?>
			Sách hướng dẫn sử dụng
	
		
		</div>
		<div id="cr-content">
			<table>
		
		 	<?php
				
				foreach ( $Manual as $cat ) {
					?>
				<tr>
					<td class="listproduct_name"><img
						src="<?php echo DOMAIN?>images/bdf.gif" /> 
						<a href="<?php echo DOMAINAD.$cat['Manual']['link']?>"><?php echo $cat['Manual']['title'] ?></a></td>
				</tr>
		 		<?php }?>
		 		</table>
		 		
		 			<?php }?>
		 			
		 			
		 			<?php if($session->read('lang')==2){?>
			Manual
	
		
		</div>
		<div id="cr-content">
			<table>
		
		 	<?php
				
				foreach ( $Manual as $cat ) {
					?>
				<tr>
					<td class="listproduct_name"><img
						src="<?php echo DOMAIN?>images/bdf.gif" /> 
						<a href="<?php echo DOMAINAD.$cat['Manual']['link']?>"><?php echo $cat['Manual']['title_eg'] ?></a></td>
				</tr>
		 		<?php }?>
		 		</table>
		 		
		 			<?php }?>
		 		
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
 