<?php
  function char($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    $str = preg_replace("/(đ|Đ)/", 'd', $str);
    $str = preg_replace("/(B)/", 'b', $str);
	$str = preg_replace("/( - )/", '-', $str);
	$str = preg_replace("/( )/", '-', $str);
	$str = preg_replace("/(  )/", '-', $str);
	$str = preg_replace("/(   )/", '-', $str);
	$str = preg_replace("/(    )/", '-', $str);
    $str = preg_replace("/(C)/", 'c', $str);
    $str = preg_replace("/(G)/", 'g', $str);
    $str = preg_replace("/(L)/", 'l', $str);
    $str = preg_replace("/(M)/", 'm', $str);
    $str = preg_replace("/(N)/", 'n', $str);
    $str = preg_replace("/(H)/", 'h', $str);
    $str = preg_replace("/(T)/", 't', $str);
    $str = preg_replace("/(K)/", 'k', $str);
    $str = preg_replace("/(S)/", 's', $str);
    $str = preg_replace("/(R)/", 'r', $str);
    $str = preg_replace("/(V)/", 'v', $str);
    $str = preg_replace("/(Y)/", 'y', $str);
    $str = preg_replace("/(W)/", 'w', $str);
	
    return trim($str);
}
?>  
<div id="text-news">
    <div id="view-detail">
<?php if(isset($id)){ ?>    
       <?php if(isset($Recruitment)){?>
         <div class="title-news">
              <p>Danh sách tuyển dụng</p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                       <td class="bg_tile_type_new">Vị trí tuyển dụng</td>
                       <td class="bg_tile_type_new">Hạn nộp</td>
                       <td class="bg_tile_type_new">Nhà tuyển dụng</td>
                    </tr>
                    <?php $j=1 ; $i=1; foreach($Recruitment as $Recruitment){ ?>
                    
                    <tr class="<?php if($j%2==0) echo('td_showtin_le'); else echo('td_showtin_chan'); $j++;?>">
                     
                       <td>
                           <a href="<?php echo DOMAIN;?>chi-tiet-tuyen-dung/<?php echo $Recruitment['Recruitment']['id']; ?>/<?php echo char($Recruitment['Recruitment']['title']); ?>" title="<?php echo $Recruitment['Recruitment']['title'];?>" class="vtip" >
					        <?php echo $this->Text->truncate($Recruitment['Recruitment']['title'],50,array('ending' => '...','exact' => true));?>
					      </a>
                        </td>
                       <td align="center"><?php echo $Recruitment['Recruitment']['timelimit'];?></td>
                         
                       <td align="center"><?php echo $Recruitment['Recruitment']['employer'];?></td>
                   
                    </tr>
                   
                    <?php }?>
                </table>
                
             </div>
         </div>
         <?php } else if(isset($Jobseeker)){ ?>
         <div class="title-news">
              <p>Danh sách người tìm việc</p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                       <td class="bg_tile_type_new">Tên người tìm việc</td>
                       <td class="bg_tile_type_new">Số năm kinh nghiệm</td>
                       <td class="bg_tile_type_new">Ngày đăng tin</td>
                    </tr>
                    <?php $j=1 ; $i=1; foreach($Jobseeker as $Jobseeker){ ?>
                    
                    <tr class="<?php if($j%2==0) echo('td_showtin_le'); else echo('td_showtin_chan'); $j++;?>">
                     
                       <td>
                           <a href="<?php echo DOMAIN;?>chi-tiet-nguoi-tim-viec/<?php echo $Jobseeker['Jobseeker']['id']; ?>/<?php echo char($Jobseeker['Jobseeker']['title']); ?>" title="<?php echo $Jobseeker['Jobseeker']['title'];?>" class="vtip" >
					        <?php echo $this->Text->truncate($Jobseeker['Jobseeker']['name'],50,array('ending' => '...','exact' => true));?>
					      </a>
                        </td>
                       <td align="center"><?php echo $Jobseeker['Jobseeker']['experienceyear'];?></td>
                         
                       <td align="center"><?php echo $Jobseeker['Jobseeker']['created'];?></td>
                   
                    </tr>
                   
                    <?php }?>
                </table>
                
             </div>
         </div>
         <?php }?>
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
    <?php } else{?>
    <div class="title-news">
              <p>Tin tuyển dụng mới nhất</p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                       <td class="bg_tile_type_new">Vị trí tuyển dụng</td>
                       <td class="bg_tile_type_new">Hạn nộp</td>
                       <td class="bg_tile_type_new">Nhà tuyển dụng</td>
                    </tr>
                    <?php $j=1 ; $i=1; foreach($Recruitment as $Recruitment){ ?>
                    
                    <tr class="<?php if($j%2==0) echo('td_showtin_le'); else echo('td_showtin_chan'); $j++;?>">
                     
                       <td>
                           <a href="<?php echo DOMAIN;?>chi-tiet-tuyen-dung/<?php echo $Recruitment['Recruitment']['id']; ?>/<?php echo char($Recruitment['Recruitment']['title']); ?>" title="<?php echo $Recruitment['Recruitment']['title'];?>" class="vtip" >
					        <?php echo $this->Text->truncate($Recruitment['Recruitment']['title'],50,array('ending' => '...','exact' => true));?>
					      </a>
                        </td>
                       <td align="center"><?php echo $Recruitment['Recruitment']['timelimit'];?></td>
                         
                       <td align="center"><?php echo $Recruitment['Recruitment']['employer'];?></td>
                   
                    </tr>
                   
                    <?php }?>
                </table>
                <div class="viewall" style="float:right; font-size:14px; font-weight:bold; margin-top:14px; margin-right:20px; display:inline;"><a style="color:red;" href="<?php echo DOMAIN;?>tim-viec-tuyen-dung/1">Xem tất cả</a></div>
             </div>
         </div>
         
         <div class="title-news">
              <p>Tin người tìm việc mới nhất</p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                       <td class="bg_tile_type_new">Tên người tìm việc</td>
                       <td class="bg_tile_type_new">Số năm kinh nghiệm</td>
                       <td class="bg_tile_type_new">Ngày đăng tin</td>
                    </tr>
                    <?php $j=1 ; $i=1; foreach($Jobseeker as $Jobseeker){ ?>
                    
                    <tr class="<?php if($j%2==0) echo('td_showtin_le'); else echo('td_showtin_chan'); $j++;?>">
                     
                       <td>
                           <a href="<?php echo DOMAIN;?>chi-tiet-nguoi-tim-viec/<?php echo $Jobseeker['Jobseeker']['id']; ?>/<?php echo char($Jobseeker['Jobseeker']['title']); ?>" title="<?php echo $Jobseeker['Jobseeker']['title'];?>" class="vtip" >
					        <?php echo $this->Text->truncate($Jobseeker['Jobseeker']['name'],50,array('ending' => '...','exact' => true));?>
					      </a>
                        </td>
                       <td align="center"><?php echo $Jobseeker['Jobseeker']['experienceyear'];?></td>
                         
                       <td align="center"><?php echo $Jobseeker['Jobseeker']['created'];?></td>
                   
                    </tr>
                   
                    <?php }?>
                </table>
                <div class="viewall" style="float:right; font-size:14px; font-weight:bold; margin-top:14px; margin-right:20px; display:inline;"><a style="color:red;" href="<?php echo DOMAIN;?>tim-viec-tuyen-dung/2">Xem tất cả</a></div>
             </div>
         </div>
    
    <?php } ?>
     </div>
 </div>



