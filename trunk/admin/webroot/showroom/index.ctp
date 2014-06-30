<?php $this->Html->addCrumb('Danh mục tin tức', '/#');?>
<?php $this->Html->addCrumb('Tin công ty', '/danh-muc-tin-tuc/125');?>
<div class="hot-product" style="margin-top:0px;"><!-- begin hot product---------------------------------------> 
            <div class="title"><p>Tin công ty</p></div>
            <div class="info list-news">
            
                 <?php
                echo $this->Help->getData($news,array('image'=>true,'introduction'=>true));
                 ?> 
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
</div>  <!-- end hot product----------------------------------------> 
