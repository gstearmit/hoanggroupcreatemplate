			<div class="video">
					<div class="video-title">
	            		
	            			<h2>VIDEO</h2></div><!-- ENd title -->
	            			
	            			<div class="video-bd">
	            				<?php 
	            			$row=$this->requestAction('comment/videos');
	            			foreach ($row as $row){
	            				?>
	            				
                        <embed width="100%" height="100%" type="application/x-shockwave-flash" src="<?php echo DOMAIN?>images/mediaplayer.swf" style="" id="playlist" name="playlist" quality="high" allowfullscreen="true" wmode="transparent" flashvars="file=<?php echo DOMAINAD.$row['Video']['video']?>&amp;displayheight=100%&amp;width=100%&amp;height=100%&amp;">
                        
   <?php }?>
	            			</div><!-- End video-body -->
	            			
	         </div><!-- End video -->			