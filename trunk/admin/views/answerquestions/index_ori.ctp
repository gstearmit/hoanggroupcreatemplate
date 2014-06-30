<?php //pr($news);die();?>
<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<!--  start page-heading -->
    <div id="page-heading">
      <h1>Tư vấn - Hỏi đáp</h1>
    </div>
    <!-- end page-heading -->
    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
      <tr>
        <th rowspan="3" class="sized"><img src="<?php echo DOMAINAD?>images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
        <th class="topleft"></th>
        <td id="tbl-border-top">&nbsp;</td>
        <th class="topright"></th>
        <th rowspan="3" class="sized"><img src="<?php echo DOMAINAD?>images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
      </tr>
      <tr>
        <td id="tbl-border-left"></td>
        <td><!--  start content-table-inner ...................................................................... START -->
          <div id="content-table-inner">
            <!--  start table-content  --> 
            <div id="table-content">
               <form id="mainform" action="">
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <th class="table-header-repeat line-left minwidth-1"><a href="">Stt</a></th>
                    <th class="table-header-repeat line-left minwidth-1"><?php echo $this->Paginator->sort('Tiêu đề','id');?></th>   
                     <th class="table-header-repeat line-left minwidth-1"><a href="">Nội dung câu hỏi</a></th>     
					  <th class="table-header-repeat line-left minwidth-1"><a href="">Trả Lời</a></th>                 
                    <th class="table-header-repeat line-left"><?php echo $this->Paginator->sort('Ngày đăng tin','created');?></th>
                    <th class="table-header-options line-left"><a href="">Xử lý</a></th>
                  </tr>
				  <?php //pr($answerquestions); die; ?>
                  <?php foreach ($answerquestions as $key =>$value){?>
                  <tr class="alternate-row">
                    <td width="10"><?php $j=$key+1; echo $j;?></td>
                    <td> <a  href="<?php echo $html->url('/answerquestions/view/'.$value['Answerquestion']['id']); ?>"> <?php echo $value['Answerquestion']['title']; ?></a></td>                   
                     <td><?php echo $value['Answerquestion']['content']; ?></td>
					  <td><?php echo $value['Answerquestion']['answer']; ?></td>
					   <td><?php echo date('d-m-Y', strtotime($value['Answerquestion']['created'])); ?></td>
                    
                    <td class="options-width">
					<?php if($value['Answerquestion']['status']==0){?>  
                   	<a href="<?php echo DOMAINAD?>answerquestions/edit/<?php echo $value['Answerquestion']['id'] ?>" title="Trả lời" class="icon-1 info-tooltip"></a>
                    <a href="<?php echo DOMAINAD?>answerquestions/active/<?php echo $value['Answerquestion']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"></a>				 
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>answerquestions/delete/<?php echo $value['Answerquestion']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"></a>
					<?php } else {?>                  
                    <a href="<?php echo DOMAINAD?>answerquestions/edit/<?php echo $value['Answerquestion']['id'] ?>" title="Trả lời" class="icon-1 info-tooltip"></a>
                    <a href="<?php echo DOMAINAD?>answerquestions/close/<?php echo $value['Answerquestion']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"></a>
                   
                    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>answerquestions/delete/<?php echo $value['Answerquestion']['id'] ?>')" title="Xóa" class="icon-2 info-tooltip"></a><?php }?>
                    </td>
                  </tr>
                <?php }?>
                </table>
                <!--  end product-table................................... -->
              </form>
              <div></div>
            </div>
            <!--  end content-table  -->
            <!--  start paging..................................................... -->
            <table border="0" cellpadding="0" cellspacing="0" id="paging-table">
             <tr>
                <td><div class="main">

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
                  <div class="clear"></div></td>
                <td>&nbsp;</td>
              </tr>
            </table>
            <!--  end paging................ -->
            <div class="clear"></div>
          </div>
          <!--  end content-table-inner ............................................END  --></td>
        <td id="tbl-border-right"></td>
      </tr>
      <tr>
        <th class="sized bottomleft"></th>
        <td id="tbl-border-bottom">&nbsp;</td>
        <th class="sized bottomright"></th>
      </tr>
    </table>
    <div class="clear">&nbsp;</div>

