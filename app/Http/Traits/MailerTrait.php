<?php

namespace App\Http\Traits;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

trait MailerTrait {
    
    public function sendEmail($message, $to, $subject, $from = NULL, $cc = NULL, $attachments = array()) {
        
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        $displyName = 'Abraa';
        if($from != ''){
            switch($from){
                case "rfq@abraa.com":
                    $displyName = "Abraa.com Wholesale RFQ";
                break;
                case "members@abraa.com":
                case "memberships@abraa.com":
                    $displyName = "Abraa Memberships";
                break;
                case "sales@abraa.com": 
                    $displyName = "Abraa Sales Team";
                break;
                case "support@abraa.com": 
                    $displyName = "Abraa Support Team";
                break;
            }
        }
        $contact = (!$from) ? "notifications@abraa.com" : $from;

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

            $mail->setFrom($contact, $displyName);
            $mail->addAddress($to);

            $mail->addReplyTo($contact);

            if(isset($_FILES['emailAttachments'])) {
                for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
                    $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
                }
            }


            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $subject;
            $body = html_entity_decode($message);
            $body = '' . $body . ''; 
            $mail->Body    = $body;

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return back()->with("success", "Email has been sent.");
            }

        } catch (Exception $e) {
            print($e); dd();
             return back()->with('error','Message could not be sent.');
        }
    }

    // get general email templete
    public function getEmailTemplete($content){
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html>
            <head>
            <!-- If you delete this meta tag, Half Life 3 will never be released. -->
            <meta name="viewport" content="width=device-width" />

            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Dubai List</title>
                
            </head>
            
            <body bgcolor="#f4f7fa" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
            <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background:#f4f7fa; width: 100%; margin: 0px; padding: 0px; width: 100%; height: 100%;">
                <tr>
                    <td align="center" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="605" id="emailContainer">
                            <tr>
                                <td align="center" valign="top" style="padding: 0px;">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailHeader" style="padding-top:85px; padding-bottom: 20px;">
                                        <tr>
                                            <td align="center" valign="top" style="padding: 0px;">
                                                <a target="_blank" href="https://www.abraa.com/"><img src="https://www.abraa.com/assets/img/abraaLogo.png" style="width: 163px; height: 47px;"></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="padding: 0px;">
                                    <div style="width: 100%;  background:#FFF; padding: 10px; border-radius: 20px; -webkit-border-radius: 20px;">
                                    <!-- content area -->
                                    ' . $content . '
                                    <!-- end of content area -->
                                    </div> 
                                    </td>
                            </tr>
                            <tr >
                                <td align="center" valign="top" style="padding:0px;">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailFooter">
                                        <tr>
                                            <td align="center" valign="top" style="padding:0px;">
                                                <img src="https://www.abraa.com/assets/email/footer-bg.png" style="width:602px; height:55px;">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr >
                                <td align="center" valign="top" style="padding:0px;">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailFooter2">
                                        <tr>
                                            <td align="center" valign="top" style="padding:0px; text-align: center;;">
                                                <a href="https://www.facebook.com/AbraaGlobal/" target="_blank" style="width:31px; height:32px; padding-right:18px;"><img src="https://www.abraa.com/assets/email/fb.png" style="width:31px; height:32px;"></a>
                                                <a href="https://www.youtube.com/channel/UCX1FJSUjwDYFXXrz-7zzZyw" target="_blank" style="width:31px; height:32px; padding-right:18px;"><img src="https://www.abraa.com/assets/email/youtube.png" style="width:31px; height:32px;"></a>
                                                <a href="https://www.instagram.com/abraaglobal/" target="_blank" style="width:31px; height:32px; padding-right:18px;"><img src="https://www.abraa.com/assets/email/ins.png" style="width:31px; height:32px;"></a>
                                                <a href="https://twitter.com/abraaglobal/" target="_blank" style="width:31px; height:32px; padding-right:18px;"><img src="https://www.abraa.com/assets/email/tw.png" style="width:31px; height:32px;"></a>
                                                <a href="https://www.linkedin.com/company/13336456" target="_blank" style="width:31px; height:32px; padding-right:18px;"><img src="https://www.abraa.com/assets/email/linkedin.png" style="width:31px; height:32px;"></a>
                                                <a href="https://www.pinterest.com/abraacom/" target="_blank" style="width:31px; height:32px; padding-right:18px;"><img src="https://www.abraa.com/assets/email/pinterest.png" style="width:31px; height:32px;"></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr >
                                <td align="center" valign="top" style="padding:0px 0px 60px 0px;">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                        <tr>
                                            <td align="center" valign="top" style="padding:0px; text-align: center;">
                                                <p style="font-size:12px; padding:20px 30px; margin: 0px; color: #617083; font-family:Roboto, Helvetica, Arial, sans-serif; line-height: 20px; font-weight: 500;">This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify the system manager.<br><br>

            Copyright Abraa ' . date('Y') . ', PO Box 236484, Dubai, United Arab Emirates</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            </body>
            </html>';

            return $message;
    }


    // get approve buying request message 
    public function getApproveRfqMessage($buyer_name, $product_name, $product_link){
        $message = '<table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody" style="background:#FFFFFF; border-radius:4px; -webkit-box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.1);">
            <tbody>
                            <tr>
                                <td align="center" valign="top" style="padding: 0px;">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%"
                                        style="padding:20px;">
                                        <tbody>
                                            <tr>
                                                <td align="center" valign="top" style="padding: 0px;">
                                                    <label
                                                        style="text-align:center;padding: 7px 14px;border-radius:6px;color:#1180b0;font-size:11px;text-decoration:none;">
                                                        Buying request
                                                    </label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="padding:0px;">
    
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%"
                                        style="padding:0px 73px 0px 73px; text-align:left; color:#617083; line-height: 20px;">
                                        <tbody>
                                            <tr>
                                                <td align="center" valign="top" style="padding: 0px;">
                                                    <h3
                                                        style="color:#585e66;font-size: 15px;margin: 0px;padding-bottom: 25px;text-align: left;font-weight:normal;">
                                                        Dear <span style=" font-weight: bold;">' . $buyer_name . ',</span><br />
                                                        <br />
                                                        <span>
                                                            The status of your buying request for the below product is  changed to : <span style="color: #4BB543; font-weight: bold;">Live ,</span>
                                                        </span>
                                                </td>
                                            </tr>
                                        
                                            <tr>
                                                <td align="center" valign="top"
                                                    style="padding-bottom: 0px;">
                                                    <h3
                                                        style="color:#585e66;font-size: 13px;margin: 0px;text-align: center;font-weight:bold;">
                                                        <span style="font-weight:bold" >"' . $product_name . '"</span>
                                                    </h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >
                                                    <label>
                                                    Click this link to visit your dashboard <a  href="' . $product_link . '">' . $product_link . '</a>
                                                     </label>><br/>
                                              </td>
                                            </tr>
                                          
                                            <tr>
                                            <td align="center" valign="top" style="">
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td align="center" valign="top" style="padding:0px; text-align: left;">
                                                            <p style="text-align:justify;font-size:12px; padding:20px 0px; margin: 0px; color: black; line-height: 20px; font-weight: 500;">
                                                                <span>
                                                                    <a style="text-decoration:none;color:black;"
                                                                        href="' . config('global.public_url') . '">Abraa.com</a>
                                                                    &nbsp; &nbsp;|
                                                                    <a style="text-decoration:none;color:black;"
                                                                        href="' . config('global.public_url') . '">RFQ Team</a>
                                                                    &nbsp;
                                                                </span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                </td>
                            </tr>
              </tbody>
      </table>
         ';

         return $message;
    }

}




