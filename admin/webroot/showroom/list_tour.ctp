<div class="tour">                
                 <div id="info">
                   <div class="title"><p><?php echo $cat['Category']['name'];?></p></div>
                      <ul>
                      <?php foreach($news as $n){ ?>
                          <li>
                              <a href="<?php echo DOMAIN;?>chi-tiet-tin/<?php echo $n['News']['id'];?>"><img class="image" src="<?php echo DOMAINAD;?><?php echo $n['News']['images'];?>" /></a>
                              <img class="hot-tour" src="<?php echo DOMAIN;?>images/hot-tour.png" />
                              <a href="<?php echo DOMAIN;?>chi-tiet-tin/<?php echo $n['News']['id'];?>"><h2><?php echo $n['News']['title'];?></h2></a>
                              <p style="color:#555555; font-size:12px; margin-bottom:3px;"><?php echo $n['News']['time'];?></p>
                              <p style="color:#019605; font-weight:bold; margin-bottom:6px;"><?php echo $n['News']['price'];?></p>
                             <a href="<?php echo DOMAIN;?>chi-tiet-tin/<?php echo $n['News']['id'];?>"><img src="<?php echo DOMAIN;?>images/bt-chitiet.jpg" /></a>
                          </li>
                          <?php } ?> 
                      </ul>
                       <div id='link_page'>
						<?php
                        $paginator->options(array('url' => $this->passedArgs));
                        echo "<span class='page_link'><b>Trang :</b> &nbsp;";
                        echo $paginator->prev('Về trước');echo "&nbsp;&nbsp;&nbsp;";
                        echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
                        echo $paginator->next('Tiếp theo');
                        echo "</span>";
                        ?>
                     </div>	 
                 </div>
 </div><!-- end tour---------------------------------------->