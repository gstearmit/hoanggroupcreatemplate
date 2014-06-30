 <?php if($session->read('lang')==1){?>
<div class="title-content">
   <p>Đối tác</p>
</div>
<div class="list-text">
   <div class="text-main">
     <ul>
      <?php foreach($Partners as $Partner){ ?>
        <li>
           <a target="_blank" href="<?php echo $Partner['Partner']['website'];?>"><img class="anh" src="<?php echo DOMAINAD;?><?php echo $Partner['Partner']['images'];?>" /></a>
           <div class="pindex">
            <p><b style="color:#000;">Tên công ty :</b> <a target="_blank" href="<?php echo $Partner['Partner']['website'];?>"><?php echo $Partner['Partner']['name'];?></a></p>
            <p><b style="color:#000;">Điện thoại :</b> <?php echo $Partner['Partner']['phone'];?></p>
            <p><b style="color:#000;">Địa chỉ : </b><?php echo $Partner['Partner']['address'];?></p>
            <p><b style="color:#000;">Website :</b> <?php echo $Partner['Partner']['website'];?></p>
           </div>
        </li>
       <?php }?>
     </ul>
</div>
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
<?php } if($session->read('lang')==2){?>
<div class="title-content">
   <p>Partners</p>
</div>
<div class="list-text">
   <div class="text-main">
     <ul>
      <?php foreach($Partners as $Partner){ ?>
        <li>
           <a target="_blank" href="<?php echo $Partner['Partner']['website'];?>"><img class="anh" src="<?php echo DOMAINAD;?><?php echo $Partner['Partner']['images'];?>" /></a>
           <div class="pindex">
            <p><b style="color:#000;">Company :</b> <a target="_blank" href="<?php echo $Partner['Partner']['website'];?>"><?php echo $Partner['Partner']['name'];?></a></p>
            <p><b style="color:#000;">Phone :</b> <?php echo $Partner['Partner']['phone'];?></p>
            <p><b style="color:#000;">Address : </b><?php echo $Partner['Partner']['address'];?></p>
            <p><b style="color:#000;">Website :</b> <?php echo $Partner['Partner']['website'];?></p>
           </div>
        </li>
       <?php }?>
     </ul>
</div>
   <div id='link_page'>
      <?php
            $paginator->options(array('url' => $this->passedArgs));
            echo "<span class='page_link'><b>Page :</b> &nbsp;";
            echo $paginator->prev('Back');echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->next('Next');
            echo "</span>";
        ?>
    </div>
</div>
<?php }?>
