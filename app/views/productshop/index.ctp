
<script language="JavaScript">
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php echo $html->css('classifiedss'); ?>


<div id="main-content">
	 
	 <div class="content-top">
	 <?php echo $this->element('menu_top');?>
	 <div class="content-top-body">
	 
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
			<div id="title-1">Quản lý sản phẩm</div>
			<div style="padding: 20px 10px; font-size:13px; float:left;width:370px;">Tìm kiếm <input type="text" size="30px"/><input type="submit" value="Tìm kiếm"/></div>
			<div style="float:right; width:130px; padding:20px 10px"><input onclick='setVisibility("j_idt187")' type="submit" value=" Thêm sản phẩm "/></div>
			<div style="padding: 10px;">
				<table width="750px" border="0">
					<tr id="title-1">
						<td style="width:7px;">STT</td>
						<td style="width:60px;">Ảnh đại diện</td>
						<td style="width:150px;">Tiêu đề</td>
						<td style="width:25px;">Giá bán</td>
						<td style="width:40px;">Tình trạng</td>
						<td style="width:50px;">Xử lý</td>
					</tr>
					<?php
					
					
					$i = 1; foreach($productshop as $productshop){?>
					<tr>
						<td align="center" style="text-align:center;"><?php echo $i; ?></td>
						<td align="center" style="text-align:center; width:90px;">
                           <div id="img-gian-hang">
				  			<a href="<?php echo DOMAIN;?><?php echo $nameshop[0]['Shop']['name'];?>/<?php echo $productshop['Productshop']['id'];?>/<?php echo $productshop['Productshop']['slug'];?>" target="_blank"><img width="80" height="" src="<?php echo DOMAIN;?><?php echo $productshop['Productshop']['images'];?>"/>
				  			</a>
                            </div>
						</td>
						<td align="center">
						   <p><a href="<?php echo DOMAIN;?><?php echo $nameshop[0]['Shop']['name'];?>/<?php echo $productshop['Productshop']['id'];?>/<?php echo $productshop['Productshop']['slug'];?>" target="_blank"><?php echo $productshop['Productshop']['title'];?></a></p>
							<p>
								<?php $categoryproductchild = $this->requestAction('/comment/getnameproduct/'.$productshop['Productshop']['categoryshop_id']);?>
								<?php foreach($categoryproductchild as $categoryproductchild){?>
								<?php echo $categoryproductchild['Catproduct']['name']; }?>
							</p>
					  </td>
						<td align="center" style="text-align:center;"><?php echo $productshop['Productshop']['price'];?> <?php echo $productshop['Productshop']['money'];?></td>
						<td style="width:150px;">
						   <div style="width: 100%;" class="ui-dt-c">
                            <p style="margin-top: 2px;">-Trong kho: <span style="color: #0078D0;"><?php echo $productshop['Productshop']['number'];?></span></p>
                            <p style="margin-top: 2px;">-Chất lượng:<span style="color: #0078D0;"><?php echo $productshop['Productshop']['quality'];?></span></p>
                            <p style="margin-top: 2px;">-Xuất xứ:<span style="color: #0078D0;"><?php echo $productshop['Productshop']['made'];?></span></p></div>
                        </td> 
						<td align="center" style="text-align:center;"><a href="<?php echo DOMAIN?>sua-san-pham/<?php echo $productshop['Productshop']['id'] ?>"><img src="<?php ?>images/pencil.png"/>Sửa</a><br /><a href="javascript:confirmDelete('<?php echo DOMAIN?>productshop/delete/<?php echo $productshop['Productshop']['id'] ?>')"><img src="<?php ?>images/icon_delete.gif"/>Xóa</a></td>
					</tr>
					<?php $i++; } ?>
					<div style="padding: 10px; width:750px;margin-top: 60px;">Tổng số sản phẩm: <span style="color: red; font-weight:bold"><?php echo ($i - 1); ?></span></div>
				</table>
			</div>
		<script language="JavaScript">
		function setVisibility(div) {
			var div1 = document.getElementById(div)
			if (div1.style.display == 'none') {
				div1.style.display = 'block'
			} else {
				div1.style.display = 'none'
			}
			}
		</script>
		<div id="j_idt187" class="ui-dialog ui-widget ui-corner-all ui-helper-hidden ui-draggable ui-resizable" style="width: 400px; height: auto; display: none; top: 66px; right: 213px;z-index: 1024; border:1px solid #AED0EA; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;">
			<div class="ui-dialog-titlebar ui-widget-header ui-helper-clearfix">
				<div style="width:370px; float:left"><span class="ui-dialog-title">Danh mục sản phẩm trên HOICHOGIARE</span></div>
					<div style="width:4px; float:right"><a href='javascript:setVisibility("j_idt187")'>X</a></div>
				</div>
				<div class="ui-dialog-content ui-widget-content" style="height: 380px; ">
				<span id="catTreeArea">
					<form id="catTreeAreaForm" name="catTreeAreaForm" method="post" action="" enctype="application/x-www-form-urlencoded">
						<input type="hidden" name="catTreeAreaForm" value="catTreeAreaForm"/>
					 
						<div style="padding:5px 0px 10px 0px; ">
							<span class="lbBlue lbBold">Vui lòng chọn danh mục cần đăng sản phẩm.</span>
						</div>
						<div style="height: 350px;width:100%; float: left;overflow:scroll;">
							<div class="ui-tree ui-widget ui-helper-clearfix ui-corner-all ui-tree-selectable" style=" border:1px solid #AED0EA; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;">
								<ul class="ui-helper-reset">
									<?php 
									
									$shop_id=$nameshop[0]['Shop']['id'];
									
									
									$categorygianhang = $this->requestAction('/comment/categorygianhang/'.$shop_id);?>
									<?php foreach($categorygianhang as $categoryproduct){?>
									<li class="ui-tree-parent">
										<div class="ui-tree-node"> 
											<span class="ui-tree-node-label"><a href='javascript:setVisibility("id_<?php echo $categoryproduct['Categoryshop']['id'];?>")'><?php echo $categoryproduct['Categoryshop']['name'];?></a></span> 
										</div>
										
												<ul class="ui-tree-nodes ui-tree-child" id="id_<?php echo $categoryproduct['Categoryshop']['id'];?>">
													<?php $categorygianhangchild = $this->requestAction('/comment/categorygianhangchild/'.$categoryproduct['Categoryshop']['id']);?>
													<?php foreach($categorygianhangchild as $categorygianhangchild){?>
													<li class="ui-tree-item">
														<div class="ui-tree-node" style="margin-left: 10px;"> 
															<span class="ui-tree-node-label"><a href="<?php echo DOMAIN; ?>them-moi-san-pham/<?php echo $categorygianhangchild['Categoryshop']['id'];?>"><?php echo $categorygianhangchild['Categoryshop']['name'];?></a></span> 
														</div> 
													</li>
													<?php } ?>
												</ul>
											</li>  
											<?php //} ?>
										</ul>
									</li>
									<?php } ?>
							   </ul>
							</div> 
						</div> 
					</form>
				</span>
			</div>
		</div>	
	</div>
</div>
	 
	 
	 		
	</div><!-- End content-top-body -->
	</div><!-- End content-top -->
	 
	 
	 </div><!-- ENd main content -->




