 <?php if($session->read('lang')==1){?>
<div id="body">
    <div id="content-main"> 
        <div class="list-news">
          <div class="content-main-title">
             <p>Thăm dò ý kiến</p>
           </div>
          <div class="gird-content-main">
              <div class="list-text">
                   <div class="detail">
                    <table>
                <?php 
				
                 foreach($polls AS $new){
                ?>
                 <tr>
                 <td>
                 <?php echo $new['Poll']['name'] ?>
                 </td>
                  &nbsp;&nbsp;
                 <td >
                 <img style="width:<?php echo ($new['Poll']['count']/$count)*800;?>px; height:8px;" src="<?php echo DOMAIN;?>images/poll.png" />
                 
                 </td>
                 </tr>
                <?php }?>
             </table>
                   </div>
                </div>
          </div>
        </div>
   </div>
</div>       
<?php } if($session->read('lang')==2){?>
<div id="body">
    <div id="content-main"> 
        <div class="list-news">
          <div class="content-main-title">
             <p>Poll</p>
           </div>
          <div class="gird-content-main">
              <div class="list-text">
                   <div class="detail">
                    <table>
                <?php 
				
                 foreach($polls AS $new){
                ?>
                 <tr>
                 <td>
                 <?php echo $new['Poll']['name'] ?>
                 </td>
                  &nbsp;&nbsp;
                 <td >
                 <img style="width:<?php echo ($new['Poll']['count']/$count)*800;?>px; height:8px;" src="<?php echo DOMAIN;?>images/poll.png" />
                 
                 </td>
                 </tr>
                <?php }?>
             </table>
                   </div>
                </div>
          </div>
        </div>
   </div>
</div>

<?php }?>

