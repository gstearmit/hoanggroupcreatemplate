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
			<td class="tableTd">Ngày chứng từ</td>
            <td class="tableTd">Số chứng từ gốc</td>
			<td class="tableTd">Khách hàng</td>
            <td class="tableTd">Chi nhánh</td>
			
			<td class="tableTd">Người bán</td>
            <td class="tableTd">Tổng trị giá</td>
			
          
           
		</tr>
        <?php $stt=1;?>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$stt.'</td>';
			
			echo '<td class="tableTdContent">'.$row['Sale_document']['document_post_date'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document']['internal_document_number'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document']['customer_code'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document']['branch_code'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document']['sale_by'].'</td>';
			echo '<td class="tableTdContent">'.$row['Sale_document']['total_for_payment'].'</td>';
			
			echo '</tr>';
			$stt++;
			endforeach;
		?>
</table>

