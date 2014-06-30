<?php $this->Html->addCrumb('Danh mục tin tức', '/#');?>
<?php $this->Html->addCrumb($views['Category']['name'], '/danh-muc-tin-tuc/'.$views['Category']['id']);?>
<?php $this->Html->addCrumb($views['News']['title'], '/news/view/'.$views['News']['id']);?>
<div class="hot-product"><!-- begin hot product--------------------------------------->             
            <div class="info">
                <div class="ct-news">
                    <div class="noidung">
					<?php echo $views['News']['content'];?>
                    </div>
                    <hr size="1" style="margin-top:10px;" />
                </div>
                <div class="news-next">
                 <h3>Tin liên quan</h3>
                    <ul>
                    <?php foreach($news as $ne){ ?>
                        <li><a href="<?php echo DOMAIN.'chi-tiet-tin/'; echo $ne['News']['id'];?>"><?php echo $ne['News']['title'];?> (<?php echo date('d-m',strtotime($ne['News']['created']));?>)</a></li>
                       <?php } ?>  
                    </ul>
                </div>
            </div>        
        </div>  <!-- end hot product----------------------------------------> 