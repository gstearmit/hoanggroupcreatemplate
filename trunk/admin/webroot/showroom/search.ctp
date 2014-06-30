<?php $this->Html->addCrumb('Danh mục tin tức', '/#');?>
<?php $this->Html->addCrumb($cat['Category']['name'], '/danh-muc-tin-tuc/'.$cat['Category']['id']);?>
<div class="hot-product list-news">  
     <div class="title"><p>Kết quả tìm kiếm :</p></div>
	 <?php
    echo $this->Help->getData($news,array('image'=>true,'introduction'=>true,'url'=>'chi-tiet-tin'));
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
      
</div><!-- end news---------------------------------------->                

