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
		<tr id="titles">
        	<td class="tableTd">STT</td>
			<td class="tableTd">Tên hàng</td>
            <td class="tableTd">Mã vạch</td>
			<td class="tableTd">Số lượng</td>
            <td class="tableTd">Giá</td>
          
           
		</tr>
        <?php $stt=1;?>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$stt.'</td>';
			
			echo '<td class="tableTdContent">'.$row['Product']['title'].'</td>';
			echo '<td class="tableTdContent">'.$row['Product']['barcode'].'</td>';
			echo '<td class="tableTdContent">'.$row['Product']['soluong'].'</td>';
			echo '<td class="tableTdContent">'.$row['Product']['purchase_price'].'</td>';
			
			
			echo '</tr>';
			$stt++;
			endforeach;
		?>
</table>

