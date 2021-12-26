<?php

namespace App\Http\Traits;


trait MailerTrait {
    
    public function composeEmail($content, $to, $subject, $from = NULL, $cc = NULL, $attachments = array()) {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {

            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'notifications@abraa.com';   //  sender username
            $mail->Password = '<82DXuaG';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom('notifications@abraa.com', 'abraa test');
            $mail->addAddress($to);

            $mail->addReplyTo('notifications@abraa.com', 'abraa tes');

            if(isset($_FILES['emailAttachments'])) {
                for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                }
            }


            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $subject;
            $mail->Body    = $content;

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return back()->with("success", "Email has been sent.");
            }

        } catch (Exception $e) {
             return back()->with('error','Message could not be sent.');
        }
    }

    public function getApproveRfqTemplete(){
        $templete = [];
        $subbject = '';
        $message = '';
    }

}