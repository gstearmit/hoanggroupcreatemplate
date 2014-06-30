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
			<td colspan="6"> THÔNG TIN ĐẶT HÀNG</td>
		</tr>
		<tr id="titles">
        	<td class="tableTd">STT</td>
			<td class="tableTd">Tên khách hàng</td>
            <td class="tableTd">Địa chỉ</td>
			<td class="tableTd">Số điện thoại</td>
            <td class="tableTd">Số hóa đơn</td>
			<td class="tableTd">Ngày</td>
          
           
		</tr>
        <?php $stt=1;?>		
		<?php foreach($rows as $row):
		
			echo '<tr>';
			echo '<td class="tableTdContent">'.$stt.'</td>';
			
			echo '<td class="tableTdContent">'.$row['Order']['name'].'</td>';
			echo '<td class="tableTdContent">'.$row['Order']['address'].'</td>';
			echo '<td class="tableTdContent">'.$row['Order']['phone'].'</td>';
			echo '<td class="tableTdContent">SHDTT-'.$row['Order']['id'].'</td>';
			echo '<td class="tableTdContent">'.date('d-m-Y',strtotime($row['Order']['created'])).'</td>';
			
			
			echo '</tr>';
			$stt++;
			endforeach;
		?>
</table>

