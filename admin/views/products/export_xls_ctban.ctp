<STYLE type="text/css">
	.tableTd {
	   	border-width: 0.5pt; 
		border: solid; 
		font:Arial;
	}
	.tableTdContent{
		border-width: 0.5pt; 
		border: solid;
		font:Arial;
	}
	#titles{
		font-weight: bolder;
	}
   
</STYLE>
<table>
		<tr>
			<td colspan="7" style="text-align:center; font-weight:bold;">
				Chi tiết hóa đơn bán hàng - <?php echo date('d/m/Y');?> 
			</td>
		</tr>
		<tr id="titles">
        	<td class="tableTd">STT</td>
			<td class="tableTd">Nhóm</td>
            <td class="tableTd">Sản phẩm</td>
			<td class="tableTd">Số lượng</td>
            <td class="tableTd">Đơn giá</td>
			<td class="tableTd">Tổng sau triết khấu</td>
			<td class="tableTd">Bán bởi</td>
          
           
		</tr>
        <?php $stt=1;?>		
		<?php foreach($Sale_document_item as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$stt.'</td>';
			
			echo '<td class="tableTdContent">'.$row['Sale_document_item']['parnert_code_out'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document_item']['product_code'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document_item']['total_unit'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document_item']['unit_price'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document_item']['total_value_after_tax'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document_item']['update_by'].'</td>';
			
			echo '</tr>';
			$stt++;
			endforeach;
		?>
</table>

