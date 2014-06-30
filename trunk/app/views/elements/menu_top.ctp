<!-- Mega-menu -->
<script type='text/javascript' src='<?php echo DOMAIN ?>js/jquery.hoverIntent.minified.js'></script>
<script type='text/javascript' src='<?php echo DOMAIN ?>js/jquery.dcmegamenu.1.3.3.js'></script>
<link href="<?php echo DOMAIN ?>css/dcmegamenu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DOMAIN ?>css/skins/white.css" rel="stylesheet" type="text/css" />

<script>
$(document).ready(function(){
$('#mega-menu').dcMegaMenu({
		rowItems: '5',
		speed: 'fast',
		effect: 'fade'
	});
	});
</script>
<!-- End Mega-menu -->

<div class="white" >  
       <ul id="mega-menu" class="mega-menu">
<?php 
    $li='';
    $li=$this->Session->read('li');
?>
<?php $catproduct =$this->requestAction('comment/catproduct');
        foreach($catproduct as $row)
            {
             ?>
      <li  class="<?php if($row['Catproduct']['id']==$li) echo "lichon";?>">
      <a style="color:#6B6B6B" href="<?php echo DOMAIN?>danh-muc-san-pham/<?php echo $row['Catproduct']['id'] ?>"><?php echo $row['Catproduct']['name']?>  
          <span style="color:#A8A8A8">
            (<?php $sl=$this->requestAction('comment/get_soluong/'.$row['Catproduct']['id']); echo $sl;?>)
         </span>
     </a>
         <?php $cap2 =$this->requestAction('comment/submenuproduct/'.$row['Catproduct']['id']);
                        $i=0;
                        $ok=0;
                        foreach($cap2 as $cap2)
                            { 
                                $i++;
                                        if($i==1)
                                         { 
                                            $ok=1;
                            ?>
                                  <ul>
                                   <?php }?>

                                 <li> 
                                    <a href="<?php echo DOMAIN?>danh-muc-san-pham/<?php echo $cap2['Catproduct']['id']?>">
                                    <?php echo $cap2['Catproduct']['name'];?>
                                                                        
                                     <span style="color:#A8A8A8">(<?php $sl=$this->requestAction('comment/get_soluong/'.$cap2['Catproduct']['id']); echo $sl;?>)</span>
                                     </a>
                                     <?php $cap3 =$this->requestAction('comment/submenuproduct/'.$cap2['Catproduct']['id']);																	                           $j=0;$ok1=0;
                                            foreach($cap3 as $cap3)
                                                { 
                                                                 $j++;
                                                                 if($j==1) 
                                                                    { $ok1=1;
                                               ?>
                                                                    <ul>
                                                              <?php } ?>
                                                           <li>
                                                                <a href="<?php echo DOMAIN?>danh-muc-san-pham/<?php echo $cap3['Catproduct']['id']?>">
                                                                      <?php echo $cap3['Catproduct']['name'];?>
                                                                 <span style="color:#A8A8A8">(<?php $sl=$this->requestAction('comment/get_soluong/'.$cap3['Catproduct']['id']); echo $sl;?>)</span>
                                                                 </a>
                                                             </li>
                                         <?php }

                                          if($ok1==1) 
                                            {?>
                                                </ul>
                                      <?php }?>
                                                                    
                                                         </li>
                                                        

                    <?php  } if ($ok==1) 
                                {     ?>

                                </ul>
                          <?php }?>
                                        
                                        </li>
      <?php }  ?>
    </ul> <!-- id="mega-menu" class="mega-menu" --->
</div>







        
        
