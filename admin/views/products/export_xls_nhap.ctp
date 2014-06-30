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
			<td colspan="6" style="text-align:center; font-weight:bold;">
				Hóa đơn mua hàng - <?php echo date('d/m/Y');?> 
			</td>
		</tr>
		<tr id="titles">
        	<td class="tableTd">STT</td>
			<td class="tableTd">Ngày chứng từ</td>
            <td class="tableTd">Số chứng từ</td>
			<td class="tableTd">Nhà cung cấp</td>
            <td class="tableTd">Chi nhánh</td>
			
          
           
		</tr>
        <?php $stt=1;?>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$stt.'</td>';
			
			echo '<td class="tableTdContent">'.$row['Purchasing_document']['document_post_date'].'</td>';
			echo '<td class="tableTdContent">'.$row['Purchasing_document']['internal_document_number'].'</td>';
			echo '<td class="tableTdContent">'.$row['Purchasing_document']['supplier_code'].'</td>';
			echo '<td class="tableTdContent">'.$row['Purchasing_document']['branch_code'].'</td>';
			
			
			echo '</tr>';
			$stt++;
			endforeach;
		?>
</table>

