<?php 
App::import('Vendor', 'phpmailer', array('file' => 'phpmailer'.DS.'class.phpmailer.php')); 
class SmtpEmailComponent {
  /**
   * Send email using SMTP Auth by default.
   */
   
 	function smtpmailer($to, $from, $from_name, $subject, $body) { 
	    global $error;
	    $mail = new PHPMailer();  // tạo một đối tượng mới từ class PHPMailer
	    $mail->IsSMTP(); // bật chức năng SMTP
	    $mail->SMTPDebug = 1;  // kiểm tra lỗi : 1 là  hiển thị lỗi và thông báo cho ta biết, 2 = chỉ thông báo lỗi
	    //$mail->SMTPAuth = true;  // bật chức năng đăng nhập vào SMTP này
	    //$mail->SMTPSecure = 'ssl'; // sử dụng giao thức SSL vì gmail bắt buộc dùng cái này
	    //$mail->Host = 'smtp.gmail.com';
	    $mail->Host = '127.0.0.1';
	    //$mail->Port = 465; 
	    $mail->Username = GUSER;  
	    $mail->Password = GPWD;           
	    $mail->SetFrom($from, $from_name);
	    $mail->Subject = $subject;
	    $mail->Body = $body;
	    $mail->IsHTML(true);
	    $mail->CharSet  = 'UTF-8';
	    $mail->AddAddress($to);
	    if(!$mail->Send()) {
	        //$error = 'Gởi mail bị lỗi: '.$mail->ErrorInfo; 
	        return false;
	    } else {
	        //$error = 'thư của bạn đã được gởi đi ';
	        return true;
	    }
	}  
}
?>