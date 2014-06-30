<div id="text-news" style="float:left;">
    <div id="view-detail">
         
         <div class="title-news">
              <p>Ngành nghề việc làm và chuyên môn mong muốn trong công việc : </p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    
                    <tr class="td_showtin_le">                      
                       <td align="right">Ngành nghề công việc</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['job'];?></td>                   
                    </tr>
                   
                </table>
                
             </div>
         </div>
         
         <div class="title-news">
              <p>Thông tin cá nhân :  </p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    
                    <tr class="td_showtin_le">                      
                       <td align="right">*Họ và tên </td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['name'];?></td>                   
                    </tr>
                   <tr class="td_showtin_chan">                      
                       <td align="right">*Ngày sinh:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['birthday'];?></td>                   
                    </tr>
                    <tr class="td_showtin_le">                      
                       <td align="right">*Giới tính:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['sex'];?></td>                   
                    </tr>
                   <tr class="td_showtin_chan">                      
                       <td align="right">*Tình trạng hôn nhân:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['maritalstatus'];?></td>                   
                    </tr>
                   <tr class="td_showtin_le">                      
                       <td align="right">*Quốc tịch:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['nationality'];?></td>                   
                    </tr>
                    
                </table>
                
             </div>
         </div>
         
         <div class="title-news">
              <p>Trình độ học vấn :   </p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    
                    <tr class="td_showtin_le">                      
                       <td align="right">*Thông tin học vấn: </td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['educationinfo'];?></td>                   
                    </tr>
                   <tr class="td_showtin_chan">                      
                       <td align="right">*Bằng cấp</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['degree'];?></td>                   
                    </tr>
                    <tr class="td_showtin_le">                      
                       <td align="right">Trình độ ngoại ngữ:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['foreignlanguage'];?></td>                   
                    </tr>
                   <tr class="td_showtin_chan">                      
                       <td align="right">*Kỹ năng:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['skill'];?></td>                   
                    </tr>
                </table>
                
             </div>
         </div>
         
          <div class="title-news">
              <p>Kinh nghiệm làm việc : </p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    
                    <tr class="td_showtin_le">                      
                       <td align="right">Cấp bậc:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['level'];?></td>                   
                    </tr>
                   <tr class="td_showtin_chan">                      
                       <td align="right">Số năm kinh nghiệm:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['experienceyear'];?></td>                   
                    </tr>
                    <tr class="td_showtin_le">                      
                       <td align="right">Công ty làm việc hiện tại:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['workingcompany'];?></td>                   
                    </tr>
                   <tr class="td_showtin_chan">                      
                       <td align="right">Chức danh công việc gần đây nhất</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['recentlyjob'];?></td>                   
                    </tr>
                    <tr class="td_showtin_le">                      
                       <td align="right">Tóm tắt kinh nghiệm:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['experienceinfo'];?></td>                   
                    </tr>
                   <tr class="td_showtin_chan">                      
                       <td align="right">Nhân chứng tham khảo (đồng nghiệp / cấp trên):</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['reference'];?></td>                   
                    </tr>
                    <tr class="td_showtin_le">                      
                       <td align="right">Mô tả công việc lý tưởng:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['idealjob'];?></td>                   
                    </tr>
                </table>
                
             </div>
         </div>
         
         <div class="title-news">
              <p>Thông tin nhu cầu tìm việc :   </p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    
                    <tr class="td_showtin_le">                      
                       <td align="right">*Cần tìm việc:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['title'];?></td>                   
                    </tr>
                   <tr class="td_showtin_chan">                      
                       <td align="right">*Nguyện vọng:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['expectation'];?></td>                   
                    </tr>
                    <tr class="td_showtin_le">                      
                       <td align="right">*Thời gian làm việc:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['workingtime'];?></td>                   
                    </tr>
                   <tr class="td_showtin_chan">                      
                       <td align="right">*Nơi làm việc:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['workplace'];?></td>                   
                    </tr>
                   <tr class="td_showtin_le">                      
                       <td align="right">*Mức lương:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['salary'];?></td>                   
                    </tr>
                    
                </table>
                
             </div>
         </div>
         
         <div class="title-news">
              <p>Thông tin liên lạc : </p>
         </div>
         <div id="detail-text">
            <div class="tin-mua-ban">
               
                <table width="100%" border="0" cellpadding="0" cellspacing="0">                    
                    <tr class="td_showtin_le">                      
                       <td align="right">*Địa chỉ:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['address'];?></td>                   
                    </tr>
                    <tr class="td_showtin_chan">                      
                       <td align="right">*Số điện thoại liên lạc: </td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['phone'];?></td>                   
                    </tr>
                     <tr class="td_showtin_le">                      
                       <td align="right">Địa chỉ email:</td>                         
                       <td align="left"><?php echo $Jobseeker['Jobseeker']['email'];?></td>                   
                    </tr>
                </table>
                
             </div>
         </div>
                   
     </div>
 </div>



