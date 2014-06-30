<div class="title_top_news_detail"><p>Dịch vụ</p></div>    
<div class="news">
		
        <?php //echo $this->Help->getHotNews(array('category_id'=>121,'image'=>true,'introduction'=>true));
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
