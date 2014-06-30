<?php $this->Html->addCrumb('Danh mục tin tức', '/#');?>
<?php $this->Html->addCrumb($cat['Category']['name'], '/danh-muc-tin-tuc/'.$cat['Category']['id']);?>
<style>

#text-main {
    margin: 0 auto;
    overflow: hidden;
    padding-top: 10px;
    width: 98%;
}
#text-main .list-news {
    overflow: hidden;
    padding-bottom: 15px;
    width: 100%;
}
#text-main .list-news .pindex {
    display: block;
    overflow: hidden;
    padding: 5px 0;
    width: 570px;
}
#text-main .list-news img {
    border: 1px solid #E2E2E6;
    border-radius: 4px 4px 4px 4px;
    float: left;
    margin-right: 10px;
    padding: 4px;
}
#text-main .list-news .pindex h2{
	margin-bottom:5px;
	}
#text-main .list-news .pindex h2 a {
    color: #130C05;
	padding-bottom:5px;
    font-size: 13px ;
	text-transform:none !important;
    padding-bottom: 5px;
}
#text-main .list-news .pindex p {
    line-height: 20px;
    text-align: justify;
	font-weight:normal !important;
}
.view_all a {
    color: #EA7724;
    float: right;
    font-size: 13px;
    margin-right: 20px;
    text-decoration: underline;
}
</style>
<div class="main-content22">
       <div id="text-main">
		<?php  foreach($news as $list){?>
             <div class="list-news">
                <img src="<?php echo DOMAINAD;?>/timthumb.php?src=<?php echo $list['News']['images'];?>&amp;h=100&amp;w=130&amp;zc=1"  />
                 <div class="pindex">
                    <h2>
                    <a href="<?php echo DOMAIN.'view/'. $list['News']['id'].'/'. $list['News']['slug'];?>"><?php echo $list['News']['title'];?> </a>
                    </h2>
                     <p>
                      <?php //echo $this->Text->truncate($list['News']['introduction'],200,array('ending' => '...','exact' => false))?>
                      <?php echo $this->Text->truncate(strip_tags($list['News']['introduction']),300,array('ending' => '...','exact' => true))?>
                    </p>Ngày cập nhật : <font color="red"><?php echo date('d-m-Y',strtotime($list['News']['created']));?></font><span class="view_all"><?php echo $html->link('Chi tiết', '/du-an-chi-tiet/'.$list['News']['id']);?></span>
                 </div>                
             </div>
         <?php }?>
      </div>
      <div id="page">
                <?php
                    $paginator->options(array('url' => $this->passedArgs));
                    echo "<span class='page_link '><b>Xem tiếp :</b> &nbsp;";
                    echo $paginator->prev('Back', null, null, array('class' => 'disabled'));echo "&nbsp;&nbsp;&nbsp;";
                    echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
                    echo $paginator->next('Next' , null, null, array('class' => 'disabled'));
                    echo "</span>";
                ?>
            </div>
</div>

