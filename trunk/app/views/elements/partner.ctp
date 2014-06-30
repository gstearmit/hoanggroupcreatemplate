<link type="text/css" href="<?php echo DOMAIN ?>css/partner.css" rel="stylesheet" />


   <?php echo $javascript->link('jquery.carouFredSel-5.1.3-packed.js'); ?>


<script type="text/javascript" language="javascript">
jQuery(function($) {
	$("#foo1").carouFredSel({
        auto: true,
        items               : 2,
        
        direction           : "left",
        scroll : {
        items           : 1,
        effect          : "",
        duration        : 400,                        
        pauseOnHover    : true
        }                  
   });

    $('.caroufredsel_wrapper').css('width','1000px');  
    $('.caroufredsel_wrapper').css('height','93px');  
	
});


    </script>

<link type="text/css" href="<?php echo DOMAIN ?>css/partner.css" rel="stylesheet" />

<div class="doitac">

<div class="box-content ">
                        <div class="list_carousel">
        	
                        <ul id="foo1" >
                         <?php 
                        $row = $this->requestAction ( '/comment/doitac');
                        foreach ($row as $row){
                        ?>
                            <li>
                                <div class="box1">
                                     
                                     <div class="anh_product">    
	                                     <a target="_blank" href="<?php echo $row['Partner']['website']?>">
	                                     <img src="<?php echo DOMAINAD.$row['Partner']['images']?>"/></a>              	
	                                     </div>
                             </div>
                            </li>
                        <?php }?>
                           </div>
                        </ul>
                        </div>

</div>
