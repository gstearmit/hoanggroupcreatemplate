<?php 
/*
$sangurl = $_SERVER['REQUEST_URI'];
$url = explode("/", $sangurl);
$url_shop=$url[2];
*/
?>
<div class="wrapper_right"><?php ?>
   <div class="right_module">
        <div class="title_module">
            <div class="left_icon"></div>
            <div class="title"><span>Tim kiếm</span></div>
            <div class="right_icon"></div>
        </div>
        <div class="content_module">
            <div class="support">
            <table width="100%">
                <tr>
                  <form action="<?php echo DOMAIN;?><?php echo $url_shop;?>/search" method="post">
                    <td align="left" width="15%" valign="top" rowspan="10">
                        <input id="input-search" type="text" name="search_name" />
                    </td>
                    <td align="left" valign="top">
                        <input type="submit" name="" value=" Tìm " />
                    </td>
                    </form>
                </tr>
            </table>
               	   
            </div>
        </div>
    </div>
    <div class="right_module">
        <div class="title_module">
            <div class="left_icon"></div>
            <div class="title"><span>Thông tin liên hệ</span></div>
            <div class="right_icon"></div>
        </div>
        <div class="content_module">
            <div class="support">
             <?php
				    $helponline = $this->requestAction('/'.$url_shop.'/helponline');
					$i=0; foreach($helponline as $helponline) {
                 ?>
            <table width="100%">
                <tr>
                    <td align="left" width="15%" valign="top" rowspan="10">
                        <span class="gn-icon_fax"></span>
                    </td>
                    <td align="left" valign="top"><?php echo $helponline['Userscms']['phone'];?>
                        &nbsp;<br>
                    </td>
                </tr>
            </table>
            <?php }?>
            <table width="100%">
               <?php
				    $helponline = $this->requestAction('/'.$url_shop.'/helponline');
					$i=0; foreach($helponline as $helponline) {
                 ?>
                <tr>
                    <td align="left" width="100%" valign="top">
                    <span class="nav">
                        <a href="ymsgr:sendim?<?php echo $helponline['Userscms']['yahoo'];?>&amp;m=Xin chào, <?php echo $helponline['Userscms']['name'];?>" title="Hỗ trợ online" style="margin-left: 5px;"><img style="margin-right: 8px;" src="http://opi.yahoo.com/online?u=<?php echo $helponline['Userscms']['yahoo'];?>&amp;m=g&amp;t=5&amp;l=us">
                        Hỗ trợ online			
                        </a>
                    </span>
                    </td>
                </tr>
                <?php }?>
            </table>
               	   
            </div>
        </div>
    </div>
    <div class="right_module">
        <div class="title_module">
            <div class="left_icon"></div>
            <div class="title"><span>Rao vặt mới nhất</span></div>
            <div class="right_icon"></div>
        </div>
        <div class="content_module">
            <div class="rao_vat_new">
                <ul>
                  <?php 
				    $raovatnews = $this->requestAction('/'.$url_shop.'/raovatnews');
				     foreach($raovatnews as $raovatnews) {
				  ?>
                   
                    <li>
                        <a href=""><img src="<?php echo DOMAINAD;?><?php echo $raovatnews['Classifiedss']['images'];?>" /></a>
                        <p><a href="<?php echo DOMAIN;?><?php echo $url_shop;?>/chi_thiet_raovat/<?php echo $raovatnews['Classifiedss']['id'];?>"><?php echo $raovatnews['Classifiedss']['title'];?></a></p>
                        <p class="date"><?php echo $raovatnews['Classifiedss']['created'];?></p>
                    </li>
                   <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>