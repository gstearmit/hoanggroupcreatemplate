<script>
	$(document).ready(function(){
		$('.tigia ul li').click(function(){
			
			var id = $(this).attr('nam');
			$('.tb').removeClass('active');
			$('.tb').addClass('noactive');
			$(this).addClass('active');
			//$('.bg-active').addClass('bg-active');
			$('.nd-tigia').hide();
			$('#nd-'+id).show();
			});
		
	});

	</script>
	
	
	  <?php if($session->read('lang')==1) {?>

	
<div class="tigia">
			            			<ul style="overflow:hidden;">
			            				<li nam="1" class="active tb" style="width:80px;height:26px;float:left;text-align:center;padding-top:10px;color:#65390d;font-weight:bold;"> GIÁ VÀNG</li>
			            				<li nam="2" class="noactive tb" style="width:68px;height:26px;float:left; margin-left:2px;text-align:center;padding-top:10px;color:#65390d;font-weight:bold;"> TỶ GIÁ</li>
			            			</ul>
			            			
			            			<div class="nd-tigia" id="nd-1"> 
			            				<p style="color:#65390d; font-weight:bold;text-align:left;margin-top:10px; padding-left:10px;">Giá vàng 9999</p>
			            				<p style="text-align:right;margin-bottom:5px;color:#65390d;">ĐVT: tr.đ/lượng</p>

                                            <table width="99%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody>
                                                <tr>
                                                    <td class="style38"><script src="http://www.vnexpress.net/service/Gold_Content.js" language="javascript"></script>
<table width="99%" cellspacing="0" cellpadding="2" bordercolor="#cdaf7a" border="1" style="border-collapse: collapse">
<tbody>
<tr>
<td style="background:#f1e1bf;">Mua </td><td style="background:#f1e1bf;">Bán</td>

</tr>
<tr>
<td align="center"><script language="javascript">document.write(vGoldSjcBuy);</script></td>
<td align="center"><script language="javascript">document.write(vGoldSjcSell);</script></td>
</tr>
</tbody>
</table>



</td>
                                                </tr>
                                                <tr>
                                                    <td height="20" class="style39"><em>(Nguồn: Cty PCS)</em></td>
                                                </tr>
                                        
                                 </tbody></table>
                                         </td>
                                    </tr>
                                 </tbody></table>                                                                                     

			            			</div><!-- ENd nd-1 -->
			            			
			            			<div class="nd-tigia" id="nd-2">
			            			
			            			   <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody
                                                <tr>
                                                    <td class="style38">
                                            <script src="http://www.vnexpress.net/Service/Forex_Content.js" language="javascript"></script>
<div style="height:231px; border:0; overflow:auto">
<table width="99%" cellspacing="0" cellpadding="2" bordercolor="#cdaf7a" border="1" style="border-collapse: collapse">
<tbody>
<tr>
<td class="td1"><script language="javascript">document.write(vForexs[0]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[0]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[1]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[1]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[2]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[2]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[3]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[3]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[4]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[4]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[5]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[5]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[6]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[6]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[7]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[7]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[8]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[8]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[9]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[9]);</script></td>
</tr>



</tbody>
</table>
</div>
</td>
                                    </tr>

                                </tbody></table>

            
			            			
			            			</div><!-- End nd-2 -->
	            				
	            			
	            			</div><!-- End tigia -->
	            			
	            			<?php }?>
	            			
	            			
	            				  <?php if($session->read('lang')==2) {?>

	
<div class="tigia">
			            			<ul style="overflow:hidden;">
			            				<li nam="1" class="active tb" style="width:80px;height:26px;float:left;text-align:center;padding-top:10px;color:#65390d;font-weight:bold;"> GOLD</li>
			            				<li nam="2" class="noactive tb" style="width:68px;height:26px;float:left; margin-left:2px;text-align:center;padding-top:10px;color:#65390d;font-weight:bold;"> RATE</li>
			            			</ul>
			            			
			            			<div class="nd-tigia" id="nd-1"> 
			            				<p style="color:#65390d; font-weight:bold;text-align:left;margin-top:10px; padding-left:10px;">Gold 9999</p>
			            				<p style="text-align:right;margin-bottom:5px;color:#65390d;">ĐVT: tr.đ/lượng</p>

                                            <table width="99%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody>
                                                <tr>
                                                    <td class="style38"><script src="http://www.vnexpress.net/service/Gold_Content.js" language="javascript"></script>
<table width="99%" cellspacing="0" cellpadding="2" bordercolor="#cdaf7a" border="1" style="border-collapse: collapse">
<tbody>
<tr>
<td style="background:#f1e1bf;">Buy </td><td style="background:#f1e1bf;">Sell</td>

</tr>
<tr>
<td align="center"><script language="javascript">document.write(vGoldSjcBuy);</script></td>
<td align="center"><script language="javascript">document.write(vGoldSjcSell);</script></td>
</tr>
</tbody>
</table>



</td>
                                                </tr>
                                                <tr>
                                                    <td height="20" class="style39"><em>(Source: Cty PCS)</em></td>
                                                </tr>
                                        
                                 </tbody></table>
                                         </td>
                                    </tr>
                                 </tbody></table>                                                                                     

			            			</div><!-- ENd nd-1 -->
			            			
			            			<div class="nd-tigia" id="nd-2">
			            			
			            			   <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                <tbody
                                                <tr>
                                                    <td class="style38">
                                            <script src="http://www.vnexpress.net/Service/Forex_Content.js" language="javascript"></script>
<div style="height:231px; border:0; overflow:auto">
<table width="99%" cellspacing="0" cellpadding="2" bordercolor="#cdaf7a" border="1" style="border-collapse: collapse">
<tbody>
<tr>
<td class="td1"><script language="javascript">document.write(vForexs[0]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[0]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[1]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[1]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[2]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[2]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[3]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[3]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[4]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[4]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[5]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[5]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[6]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[6]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[7]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[7]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[8]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[8]);</script></td>
</tr>



<tr>
<td class="td1"><script language="javascript">document.write(vForexs[9]);</script></td>
<td align="center"><script language="javascript">document.write(vCosts[9]);</script></td>
</tr>



</tbody>
</table>
</div>
</td>
                                    </tr>

                                </tbody></table>

            
			            			
			            			</div><!-- End nd-2 -->
	            				
	            			
	            			</div><!-- End tigia -->
	            			
	            			<?php }?>