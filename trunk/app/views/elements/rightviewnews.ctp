<?php echo $html->css('theme'); ?>
<div id="title-news-raovat" style="border-radius: 6px 6px 6px 6px;">
    <div class="title-raovat">
	     <p>Tin rao vặt mới nhất</p>
	</div>
	<div class="content-news-raovat">
	   <div class="center-raovat">
	       <table width="100%" id="nav">
                 <?php $newsraovatother = $this->requestAction('/comment/newsraovatother');?>
                 <?php foreach($newsraovatother as $newsraovatother){?>
                  <tr>
                    <td width="22%" valign="top" align="left" style="padding-bottom:10px;">
                      <div style="width: 50px; height:50px; float:left;  border: 1px solid lightgrey;">
                        <a href="<?php echo DOMAIN;?>rao-vat/chi-tiet-tin-rao-vat/<?php echo $newsraovatother['Classifiedss']['id']; ?>" style="font-size: 12px;" title="<?php echo $newsraovatother['Classifiedss']['title']; ?>">
                         <?php if($newsraovatother['Classifiedss']['images']){?>
                            <img height="50" width="50" alt="<?php echo $newsraovatother['Classifiedss']['title']; ?>" src="<?php echo DOMAINAD;?><?php echo $newsraovatother['Classifiedss']['images']; ?>">
                        <?php }else{?>
                            <img width="50" height="50" src="<?php echo DOMAIN;?>images/no_prod_image.gif"/>
                        <?php }?>
                        </a>	
                       </div>
                    </td>
                    <td valign="top" align="left">
                        <a href="<?php echo DOMAIN;?>rao-vat/chi-tiet-tin-rao-vat/<?php echo $newsraovatother['Classifiedss']['id']; ?>" style="font-size: 12px;" title="<?php echo $newsraovatother['Classifiedss']['title']; ?>"><?php echo $this->Text->truncate($newsraovatother['Classifiedss']['title'],80,array('ending' => '...','exact' => true));?></a> 
                        <p class="lbRed lbBold" style="color:#F00;">Giá: <?php echo $newsraovatother['Classifiedss']['price']; ?></p>
                    </td>
                </tr>
                <?php }?>
            </table>
	   </div>
	</div>


</div>