 <?php if($session->read('lang')==1){?>
<div class="news">
            	<div class="news-title"><p>Tin tức</p></div><!--End news-title-->
                <div class="news-body" style="margin-top:10px; margin-bottom:10px;">
                	<ul>
                    
                          
                    <marquee height="210" loop="infinite" behavior="scroll" direction="up" scrollamount="1" scrolldelay="30" onmouseover="this.stop()" onmouseout="this.start()">
                          <?php $new=$this->requestAction('comment/tinmoi');
                          		foreach ($new as $row){
                          ?>                      	
                                        
                    	<li><p class="news-p"><a href="<?php echo DOMAIN?>news/ctnews/<?php echo $row['News']['id'];?>"><?php echo $row['News']['title'];?></a></p></li>
                    	<?php }?>
                     
                 
                       </marquee>
                	</ul>
                </div><!--End news-body-->
            </div><!--End news-->
            
            
            
            <div class="news">
            
               <?php $cap1=$this->requestAction('menuleft/cap1/74');
                          		foreach ($cap1 as $row){
                          ?>                      	
                              
            
            	<div class="news-title"><p><?php echo $row['Catproduct']['name']?></p></div><!--End news-title-->
                <div class="news-body">
                
                        <div id="firstpane" class="menu_list">
                        <?php
                        $cap2=$this->requestAction('menuleft/submenuproduct/'.$row['Catproduct']['id']);
                        foreach ($cap2 as $cap2){
                        ?>
                        
                                <p class="menu_head">
                                <?php echo  $cap2['Catproduct']['name'] ?>
                                
                                </p>
                                
                       
                                
                                <div class="menu_body">
                                           <?php
                        $cap3=$this->requestAction('menuleft/getproduct/'.$cap2['Catproduct']['id']);
                        foreach ($cap3 as $cap3){
                        ?>
                                <a href="<?php echo DOMAIN?>product/index/<?php echo $cap3['Product']['id']?>"><?php echo $cap3['Product']['title'];?></a>
                             
                            
                                <?php }?>
                                    </div>
                                <?php }?>
                        </div>
                        <?php }?>

                </div><!--End news-body-->
            </div><!--End news-->
            
            
            <div class="news">
            
               <?php $cap1=$this->requestAction('menuleft/cap1/72');
                          		foreach ($cap1 as $row){
                          ?>                      	
                              
            
            	<div class="news-title"><p><?php echo $row['Catproduct']['name']?></p></div><!--End news-title-->
                <div class="news-body">
                
                        <div id="firstpane" class="menu_list">
                        <?php
                        $cap2=$this->requestAction('menuleft/submenuproduct/'.$row['Catproduct']['id']);
                        foreach ($cap2 as $cap2){
                        ?>
                        
                                <p class="menu_head">
                               
                                <?php echo  $cap2['Catproduct']['name'] ?>
                                
                                </p>
                                
                                <div class="menu_body">
                                           <?php
                        $cap3=$this->requestAction('menuleft/getproduct/'.$cap2['Catproduct']['id']);
                        foreach ($cap3 as $cap3){
                        ?>
                                   <a href="<?php echo DOMAIN?>product/index/<?php echo $cap3['Product']['id']?>"><?php echo $cap3['Product']['title'];?></a>
                            
                            
                                <?php }?>
                                    </div>
                                <?php }?>
                        </div>
                        <?php }?>

                </div><!--End news-body-->
            </div><!--End news-->
            
            
              
            <div class="news">
            
               <?php $cap1=$this->requestAction('menuleft/cap1/71');
                          		foreach ($cap1 as $row){
                          ?>                      	
            	<div class="news-title"><p><?php echo $row['Catproduct']['name']?></p></div><!--End news-title-->
                <div class="news-body">
                
                        <div id="firstpane" class="menu_list">
                        <?php
                        $cap2=$this->requestAction('menuleft/submenuproduct/'.$row['Catproduct']['id']);
                        foreach ($cap2 as $cap2){
                        ?>
                        
                                <p class="menu_head">  
                                <?php echo  $cap2['Catproduct']['name'] ?>
                                </p>
                                <div class="menu_body">
                                           <?php
                        $cap3=$this->requestAction('menuleft/getproduct/'.$cap2['Catproduct']['id']);
                        foreach ($cap3 as $cap3){
                        ?>
                                   <a href="<?php echo DOMAIN?>product/index/<?php echo $cap3['Product']['id']?>"><?php echo $cap3['Product']['title'];?></a>
                            
                                <?php }?>
                                    </div>
                                <?php }?>
                        </div>
                        <?php }?>

                </div><!--End news-body-->
            </div><!--End news-->
            
                <div class="news">
            	<div class="news-title"><p>Hỗ trợ trực tuyến</p></div><!--End news-title-->
                <div class="help-body">
          
            
                	<ul>
                    
                    <?php
                        $help=$this->requestAction('comment/helpsonline');
                        foreach ($help as $help){
                        ?>
                                                	
                                        
                    	<li style="height:50px;">
                              <a href="skype:<?php echo $help['Helps']['skype'] ?>?chat" style="float:left">
                           		<img src="<?php echo DOMAIN?>images/skype.png" style="border: none;" width="20" height="20" />
                            </a>
                        	<p class="name-help"><?php echo $help['Helps']['name'] ?></p>
                            <p class="tel"><?php echo $help['Helps']['sdt'] ?></p>
                        </li>
                        
                     <?php }?>
                    
                	</ul>



                </div><!--End news-body-->
            </div><!--End news-->
            
               <div class="news">
            	<div class="news-title"><p>Thời tiết</p></div><!--End news-title-->
                <div class="help-body">
                	<p align="center"><embed title="Free Online Weather for WordPress, Blogspot, Blogger, Drupal, TypePad, MySpace, Facebook, Bebo, Piczo, Xanga, Freewebs, Netvibes, Pageflakes, iGoogle and other blogs and web pages" src="http://www.weatherlet.com/weather.swf?locid=VMXX0006&unit=m" quality="high" wmode="transparent" bgcolor="#CC00CC" width="184" height="76" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /><br>

                </div><!--End news-body-->
            </div><!--End news-->
            
           
            
  <?php }?>          
            

            
            
             <?php if($session->read('lang')==2){?>
<div class="news">
            	<div class="news-title"><p>News</p></div><!--End news-title-->
                <div class="news-body" style="margin-top:10px; margin-bottom:10px;">
                	<ul>
                    
                          
                    <marquee height="210" loop="infinite" behavior="scroll" direction="up" scrollamount="1" scrolldelay="30" onmouseover="this.stop()" onmouseout="this.start()">
                          <?php $new=$this->requestAction('comment/tinmoi');
                          		foreach ($new as $row){
                          ?>                      	
                                        
                    	<li><p class="news-p"><a href="<?php echo DOMAIN?>news/ctnews/<?php echo $row['News']['id'];?>"><?php echo $row['News']['title_eg'];?></a></p></li>
                    	<?php }?>
                     
                 
                       </marquee>
                	</ul>
                </div><!--End news-body-->
            </div><!--End news-->
            
            
            
            <div class="news">
            
               <?php $cap1=$this->requestAction('menuleft/cap1/74');
                          		foreach ($cap1 as $row){
                          ?>                      	
                              
            
            	<div class="news-title"><p><?php echo $row['Catproduct']['name_eg']?></p></div><!--End news-title-->
                <div class="news-body">
                
                        <div id="firstpane" class="menu_list">
                        <?php
                        $cap2=$this->requestAction('menuleft/submenuproduct/'.$row['Catproduct']['id']);
                        foreach ($cap2 as $cap2){
                        ?>
                        
                                <p class="menu_head">
                                <?php echo  $cap2['Catproduct']['name_eg'] ?>
                                
                                </p>
                                
                       
                                
                                <div class="menu_body">
                                           <?php
                        $cap3=$this->requestAction('menuleft/getproduct/'.$cap2['Catproduct']['id']);
                        foreach ($cap3 as $cap3){
                        ?>
                                <a href="<?php echo DOMAIN?>product/index/<?php echo $cap3['Product']['id']?>"><?php echo $cap3['Product']['title_eg'];?></a>
                             
                            
                                <?php }?>
                                    </div>
                                <?php }?>
                        </div>
                        <?php }?>

                </div><!--End news-body-->
            </div><!--End news-->
            
            
            <div class="news">
            
               <?php $cap1=$this->requestAction('menuleft/cap1/72');
                          		foreach ($cap1 as $row){
                          ?>                      	
                              
            
            	<div class="news-title"><p><?php echo $row['Catproduct']['name_eg']?></p></div><!--End news-title-->
                <div class="news-body">
                
                        <div id="firstpane" class="menu_list">
                        <?php
                        $cap2=$this->requestAction('menuleft/submenuproduct/'.$row['Catproduct']['id']);
                        foreach ($cap2 as $cap2){
                        ?>
                        
                                <p class="menu_head">
                               
                                <?php echo  $cap2['Catproduct']['name_eg'] ?>
                                
                                </p>
                                
                                <div class="menu_body">
                                           <?php
                        $cap3=$this->requestAction('menuleft/getproduct/'.$cap2['Catproduct']['id']);
                        foreach ($cap3 as $cap3){
                        ?>
                                   <a href="<?php echo DOMAIN?>product/index/<?php echo $cap3['Product']['id']?>"><?php echo $cap3['Product']['title_eg'];?></a>
                            
                            
                                <?php }?>
                                    </div>
                                <?php }?>
                        </div>
                        <?php }?>

                </div><!--End news-body-->
            </div><!--End news-->
            
            
              
            <div class="news">
            
               <?php $cap1=$this->requestAction('menuleft/cap1/71');
                          		foreach ($cap1 as $row){
                          ?>                      	
            	<div class="news-title"><p><?php echo $row['Catproduct']['name_eg']?></p></div><!--End news-title-->
                <div class="news-body">
                
                        <div id="firstpane" class="menu_list">
                        <?php
                        $cap2=$this->requestAction('menuleft/submenuproduct/'.$row['Catproduct']['id']);
                        foreach ($cap2 as $cap2){
                        ?>
                        
                                <p class="menu_head">  
                                <?php echo  $cap2['Catproduct']['name_eg'] ?>
                                </p>
                                <div class="menu_body">
                                           <?php
                        $cap3=$this->requestAction('menuleft/getproduct/'.$cap2['Catproduct']['id']);
                        foreach ($cap3 as $cap3){
                        ?>
                                   <a href="<?php echo DOMAIN?>product/index/<?php echo $cap3['Product']['id']?>"><?php echo $cap3['Product']['title_eg'];?></a>
                            
                                <?php }?>
                                    </div>
                                <?php }?>
                        </div>
                        <?php }?>

                </div><!--End news-body-->
            </div><!--End news-->
            
                <div class="news">
            	<div class="news-title"><p>online support</p></div><!--End news-title-->
                <div class="help-body">
          
            
                	<ul>
                    
                    <?php
                        $help=$this->requestAction('comment/helpsonline');
                        foreach ($help as $help){
                        ?>
                                                	
                                        
                    	<li style="height:50px;">
                              <a href="skype:<?php echo $help['Helps']['skype'] ?>?chat" style="float:left">
                           		<img src="<?php echo DOMAIN?>images/skype.png" style="border: none;" width="20" height="20" />
                            </a>
                        	<p class="name-help"><?php echo $help['Helps']['name'] ?></p>
                            <p class="tel"><?php echo $help['Helps']['sdt'] ?></p>
                        </li>
                        
                     <?php }?>
                    
                	</ul>



                </div><!--End news-body-->
            </div><!--End news-->
            
            
            <div class="news">
            	<div class="news-title"><p>Weather</p></div><!--End news-title-->
                <div class="help-body">
                	<p align="center"><embed title="Free Online Weather for WordPress, Blogspot, Blogger, Drupal, TypePad, MySpace, Facebook, Bebo, Piczo, Xanga, Freewebs, Netvibes, Pageflakes, iGoogle and other blogs and web pages" src="http://www.weatherlet.com/weather.swf?locid=VMXX0006&unit=m" quality="high" wmode="transparent" bgcolor="#CC00CC" width="184" height="76" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /><br>

                </div><!--End news-body-->
            </div><!--End news-->
  <?php }?>          
            