<?php

namespace App\Http\Traits;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Buyer;

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
                //return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
                $message = 'Oops , Problem Sending Messages';
                session()->flash('error', 'true');
                session()->flash('feedback_title', 'Error Sending');
                session()->flash('feedback', $message);
            }
            
            else {
                //return back()->with("success", "Email has been sent.");
                $message = 'Message Has been Send successfully';
                session()->flash('success', 'true');
                session()->flash('feedback_title', 'Send Success');
                session()->flash('feedback', $message);
            }

        } catch (Exception $e) {
            $message = 'Oops , Problem Sending Messages';
            session()->flash('error', 'true');
            session()->flash('feedback_title', 'Error Sending');
            session()->flash('feedback', $message);
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


    // to send new buying request to suppliers 
    public function buy_request_email_format($supplier, $buying_request, $strmImages, $lang = 'en', $external = 0)
    {

        $user_id = $supplier->id;

        $encryptIds = $this->__encryptors('encrypt', $user_id . '-' . $buying_request->id);
        $inqueryLink = config('global.public_url')  .'external-login/' . $encryptIds;

        $buyer_name = '';
        $buyer_country = '';
        $buyer = Buyer::find($buying_request->buyer_id);
        if($buyer){
            $buyer_name = $buyer->full_name;
            if($buyer->buyer_country){
                $buyer_country = $buyer->buyer_country->en_name;
            }
        }

        if ($buying_request->quantity < 10)
            $title = 'buyer';
        else
            $title = 'wholesale buyer';

        $phone = $supplier->phone;

        $params['title'] = $title;

        $params['name'] = $supplier->full_name;
        $params['country'] = $buyer_country;
        $params['product_name'] = $buying_request->product_name;
        $params['qty'] = $buying_request->quantity . ' ' . $buying_request->unit->unit_en;
        $params['link'] = $inqueryLink;
        

        $updateUrl = config('global.public_url')  . '/questionnaire/' . $encryptIds;
        $login = config('global.public_url')  . '/login';
        $register = config('global.public_url')  . '/register';

        $message = $lang == 'en' ? '<table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody" style="background:#FFFFFF; border-radius:4px; -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                            <tbody><tr>
                                <td align="center" valign="top" style="padding: 0;">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%" style="padding:20px;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="padding: 0;">
                                                <a target="_blank" href="' . $inqueryLink . '" style="float:right;padding: 7px 14px;border-radius:6px;background: #4da1ff;color:#FFFFFF;font-size:11px;text-decoration:none;font-family:\'Roboto\', Helvetica, Arial, sans-serif;">REQUEST FOR QUOTATION</a>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="padding:0;">

                                    <table border="0" cellpadding="20" cellspacing="0" width="100%" style="padding:0 73px 60px 73px; text-align:left; font-family:\'Roboto\', Helvetica, Arial, sans-serif; color:#617083; line-height: 20px;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="padding: 0;">
                                                <h3 style="color:#585e66;font-size: 20px;margin: 0;padding-bottom: 25px;text-align: left;font-weight:normal;font-family:\'Roboto\', Helvetica, Arial, sans-serif;">Hi <span style="font-weight: bold;">' . $supplier['supplier_name'] . ',</span></h3>
                                            </td>
                                        </tr>                                       
                                        <tr>
                                            <td align="center" valign="top" style="padding: 0; text-align: left; font-family:\'Roboto\', Helvetica, Arial, sans-serif;">
                                                     
  
     
    <p style="font-size:14px;padding:0;margin:0;text-align:left;">A ' . $title . ' is looking for the below product:</p>
    
    
    
    
    
	<br><br>
	
             <table  border="1" cellpadding="10" cellspacing="1" width="100%" style="text-align:left;font-family:Roboto, Helvetica, Arial, sans-serif;color:#617083;line-height:5px;">
             
              <tr>
			 <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 400;
        
    line-height: 200%;
    width: 220px;">
			 Item Name
			 </td>
			  <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
        
    line-height: 200%;
    font-weight: 500;
    vertical-align: middle;">
    ' . $buying_request->product_name . '
			 </td>			 
			 </tr>
			 <tr>
			  <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 400;
        
    line-height: 200%;
    width: 220px;">
			 Details
			 </td>
			  <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
        
    line-height: 200%;
    font-weight: 500;
    vertical-align: middle;">
    ' . $buying_request->product_detail . '
			 </td>			 
			 </tr>
             
             
			 <tr>
			 <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 400;
    width: 220px;
    display: inline-block;">
			 Quantity Required
			 </td>
			  <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 500;
    vertical-align: middle;">
    ' . $buying_request->quantity . ' ' . $buying_request->unit->unit_en . '
			 </td>			 
			 </tr>
			 
			 <tr>
			 <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 400;
    width: 220px;">
			Buying Frequency
			 </td>
			   <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 500;
    vertical-align: middle;">
    ' . $buying_request->buying_frequency_id . '
			 </td>			 
			 </tr>
			 
			 <tr>
			<td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 400;">
			Shipping Country
			 </td>
			   <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 500;
    vertical-align: middle;">
    ' . $buyer_country . '
			 </td>			 
			 </tr>
			 
			 </table>
			 
			 <br>
			 <p style="text-align:left;font-family:Roboto, Helvetica, Arial, sans-serif;color:#617083;line-height:5px;">Please submit your quotation by <a href="' . $inqueryLink . '" target="_blank" style="padding: 10px 18px;text-decoration: none;color: #4da1ff;font-size: 12px;text-align: center;font-weight: 400;">Clicking Here</a>
			  
			 </p>
			 
			 <p>
                Or by replying this email.
                <br>
                <br>
                Or to Whatsapp number <a href="https://api.whatsapp.com/send?phone=971505346880"
                                                   style="
    text-decoration: none;
    background-color: #4da1ff;
    color: #ebf4fe !important;
    font-weight: 400;
    border-color: #4da1ff !important;
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;">0971505346880</a>
                </p>

    <br>
    <p>' . $strmImages . '</p>
    <br>

' .
//                                        <p>
//<a href="https://www.youtube.com/watch?v=VJiCqEgCfj4">
//<img src="https://www.abraa.com/assets/images/rsz_img-video.png" /></a></p>
            '
	<p style="text-align:justify;font-size:12px; padding:20px 0px; margin: 0px; color: black; font-family:Roboto, Helvetica, Arial, sans-serif; line-height: 20px; font-weight: 500;">
			If you are selling different products ,Please
			<span
				style="color:rgb(17, 128, 176);text-decoration:none:rgb(17, 128, 176); font-family:Arial, sans-serif, Arial; font-weight:700; font-style:normal;">
				update&nbsp;
			</span>
			your account info by visiting
			<a href="' . $updateUrl . '">www.abraa.com</a>
			<a style="text-decoration:none;color:rgb(17, 128, 176);font-family:Arial, sans-serif, Arial; font-weight:700; font-style:normal;"
					href="' . $login . '">
					Login&nbsp;
			</a>
			if you have an account or
			<a style="text-decoration:none;color:rgb(242, 133, 0);font-family:Arial, sans-serif, Arial; font-weight:700; font-style:normal;"
					href="' . $register . '">
					Signup
			</a>
			if you are new to abraa Also you can click
			<span
				style="color:rgb(17, 128, 176); font-family:Arial, sans-serif, Arial; font-weight:400; font-style:normal;">
				unsubscribe
			</span>
			if wish to remove your email from our list &nbsp;of suppliers.
	  </p>
		<br />
		<br />
<p style="font-size: 15px;padding-top: 25px;margin: 0;color:#3c495b;text-align: left;"> 
                                               
                                                   Abraa RFQ Team
                                                    <br><br>
                                                    <a target="_blank" href="https://www.abraa.com/" style="color:#4da1ff; text-decoration:none;">abraa.com</a>
                                                    </p>
                                             </td>
                                        </tr>
                                    </tbody></table>

                                </td>
                            </tr>
                        </tbody>
                        </table>' : '<table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody" style="background:#FFFFFF; border-radius:4px; -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                            <tbody>
                            <tr>
                                <td align="center" valign="top" style="padding: 0;">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%" style="padding:20px;">
                                        <tbody><tr>
                                            <td align="center" valign="top" style="padding: 0;">
                                                <a target="_blank" href="' . config('global.public_url') . 'tr/buying-inquiry/' . $buying_request->hash . '/' . encryptor('encrypt', $sup['supplier_id']) . ' " style="float:right;padding: 7px 14px;border-radius:6px;background: #4da1ff;color:#FFFFFF;font-size:11px;text-decoration:none;font-family:\'Roboto\', Helvetica, Arial, sans-serif;">REQUEST FOR QUOTATION</a>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="padding:0;">

                                    <table border="0" cellpadding="20" cellspacing="0" width="100%" style="padding:0 73px 60px 73px; text-align:left; font-family:\'Roboto\', Helvetica, Arial, sans-serif; color:#617083; line-height: 20px;">
                                        <tbody>
                                        <tr>
                                            <td align="center" valign="top" style="padding: 0;">
                                                <h3 style="color:#585e66;font-size: 20px;margin: 0;padding-bottom: 25px;text-align: left;font-weight:normal;font-family:\'Roboto\', Helvetica, Arial, sans-serif;">Merhaba <span style="font-weight: bold;">' . $sup['supplier_name'] . ',</span></h3>
                                            </td>
                                        </tr>                                       
                                        <tr>
                                            <td align="center" valign="top" style="padding: 0; text-align: left; font-family:\'Roboto\', Helvetica, Arial, sans-serif;">
                                                     

     
    <p style="font-size:14px;padding:0;margin:0;text-align:left;">Bir alıcı aşağıda belirtilen ürünü arıyor:</p>
    
    
    
    
    
	<br><br>
	
             <table  border="1" cellpadding="10" cellspacing="1" width="100%" style="text-align:left;font-family:Roboto, Helvetica, Arial, sans-serif;color:#617083;line-height:5px;">
             
              <tr>
			 <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
        
    line-height: 200%;
    font-weight: 400;
    width: 220px;">
			 Ürün Adı
			 </td>
			  <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 500;
        
    line-height: 200%;
    vertical-align: middle;">
    ' . $buying_request->product_name . '
			 </td>			 
			 </tr>
             
             
			 <tr>
			 <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 400;
    width: 220px;">
			 Gerekli Miktar
			 </td>
			  <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 500;
    vertical-align: middle;">
    ' . $buying_request->quantity . ' ' . $buying_request->unit->unit_en . '
			 </td>			 
			 </tr>
			 
			 <tr>
			 <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 400;
    width: 220px;">
			Alım sıklığı 
			 </td>
			   <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 500;
    vertical-align: middle;">
    ' . $buying_request->buying_frequency_id . '
			 </td>			 
			 </tr>
			 
			 <tr>
			<td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 400;">
			Nakliye ülkesi 
			 </td>
			   <td style="    color: #617083;
    font-size: 14px;
    letter-spacing: 1px;
    font-weight: 500;
    display: inline-block;
    vertical-align: middle;">
    ' . $buyer_country . '
			 </td>			 
			 </tr>
			 
			 </table>
			 
			 <br>
			 <p style="text-align:left;font-family:Roboto, Helvetica, Arial, sans-serif;color:#617083;line-height:5px;">Lütfen teklifinizi <a href="' . config('global.public_url') . 'tr/buying-inquiry/' . $buying_request->hash . '/' . encryptor('encrypt', $sup['supplier_id']) . '" target="_blank" style="padding: 10px 18px;text-decoration: none;color: #4da1ff;font-size: 12px;text-align: center;font-weight: 400;">gönderiniz.</a>
			  
			 </p>
			 <p><br/>yada aşağıda belirtilen url ‘yi tarayıcınıza kopyalayıp yapıştırınız. <br/>' . config('global.public_url') . 'tr/buying-inquiry/' . $buying_request->hash . '/' . encryptor('encrypt', $sup['supplier_id']) . '</p>

<br>
<p>' . $strmImages . '</p>
<br>

' .
//                                        <p>
//<a href="https://www.youtube.com/watch?v=VJiCqEgCfj4">
//<img src="https://www.abraa.com/assets/images/rsz_img-video.png" /></a></p>
            '
	<p style="text-align:justify;font-size:12px; padding:20px 0px; margin: 0px; color: black; font-family:Roboto, Helvetica, Arial, sans-serif; line-height: 20px; font-weight: 500;">
			If you are selling different products ,Please
			<span
				style="color:rgb(17, 128, 176);text-decoration:none:rgb(17, 128, 176); font-family:Arial, sans-serif, Arial; font-weight:700; font-style:normal;">
				update&nbsp;
			</span>
			your account info by visiting
			<a href="' . $updateUrl . '">www.abraa.com</a>
			<a style="text-decoration:none;color:rgb(17, 128, 176);font-family:Arial, sans-serif, Arial; font-weight:700; font-style:normal;"
					href="' . $login . '">
					Login&nbsp;
			</a>
			if you have an account or
			<a style="text-decoration:none;color:rgb(242, 133, 0);font-family:Arial, sans-serif, Arial; font-weight:700; font-style:normal;"
					href="' . $register . '">
					Signup
			</a>
			if you are new to abraa Also you can click
			<span
				style="color:rgb(17, 128, 176); font-family:Arial, sans-serif, Arial; font-weight:400; font-style:normal;">
				unsubscribe
			</span>
			if wish to remove your email from our list &nbsp;of suppliers.
	  </p>
		<br />
		<br />
<p style="font-size: 15px;padding-top: 25px;margin: 0;color:#3c495b;text-align: left;"> 
                                               
                                                   Abraa RFQ Team
                                                    <br><br>
                                                    <a target="_blank" href="' . config('global.public_url') . '" style="color:#4da1ff; text-decoration:none;">abraa.com</a>
                                                    </p>
                                             </td>
                                        </tr>
                                    </tbody></table>

                                </td>
                            </tr>
                        </tbody>
                        </table>';
        return $message;

    }


    public function send_custom_email_to_suppliers($supplier, $msg){
        
        $message = ' <table border="0" cellpadding="20" cellspacing="0" width="100%" style="background: #FFFFFF; padding:30px 73px 30px 73px; text-align:left; font-family:Roboto, Helvetica, Arial, sans-serif; color:#617083; line-height: 20px;">

            <tr>
                <td align="center" valign="top" style="color:#585e66; font-size: 22px; padding:0px; text-align: left;  
                    ">
                    
                    <h3 style="font-weight:normal; font-family:Roboto, Helvetica, Arial, sans-serif;">
                    Dear <span style=" font-weight: bold;">' . $supplier->full_name . ',</span>
                    </h3>
                    <br>
            </td>
            </tr>

            <tr>
                <td align="center" valign="top" style="color:#585e66; font-size: 22px; padding:0px; text-align: left;  
                    ">
            
                    <p style="font-size:16px; padding: 0px; margin: 0px; text-align: left; color:#3c495b; font-family:Roboto, Helvetica, Arial, sans-serif;">
                        ' . $msg . '
                    </p>
                    <br>
                </td>
            </tr>
        </table>';

        return $message;
    }



    public function getRfqApprovedSupplierEmailTemplete(
        $supplierName,$productName,$productUrl,$productDetails,$buyFrequency,$countryOfShipping,$sendQuotationUrl,$baseUrl
    ){
        $html = '<HTML
            <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody" style="background:#FFFFFF; border-radius:4px; -webkit-box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.1);
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
                                                            style="text-align:center;padding: 7px 14px;border-radius:6px;color:#1180b0;font-size:11px;text-decoration:none;">buyer
                                                            interested in your product
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
                                            style="padding:0px 73px 0px 73px; text-align:left;; color:#617083; line-height: 20px;">
                                            <tbody>
                                                <tr>
                                                    <td align="center" valign="top" style="padding: 0px;">
                                                        <h3
                                                            style="color:#585e66;font-size: 15px;margin: 0px;padding-bottom: 25px;text-align: left;font-weight:normal;;">
                                                            Hi'. $supplierName  .' ,<br />
                                                            <br />
                                                            <span>
                                                                A buyer is looking for the below product:
                                                            </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="padding: 0px;font-weight:bold ;color: #000 !important;padding-left: 0px;color: #000;font-size: 14px;letter-spacing: 1px;font-weight: bold;width: 220px;display: inline-block;">
                                                        Product name
                                                    </td>
                                                    <td
                                                        style="padding: 0px;padding-left: 0px;color: #000 !important;font-size: 14px;letter-spacing: 1px;width: 220px;display: inline-block;">
                                                        <a href="' . $productUrl . '">' . $productName . '</a>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="padding:8px 0px;border-bottom:1px solid rgba(17,128,176,1.00)">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="padding: 10px 0 0 0;font-weight:bold ;color: #000 !important;padding-left: 0px;color: #000;font-size: 14px;letter-spacing: 1px;font-weight: bold;width: 220px;display: inline-block;">
                                                        More Details
                                                    </td>
                                                    <td
                                                        style="padding: 10px 0 0 0;padding-left: 0px;color: #000 !important;font-size: 14px;letter-spacing: 1px;width: 220px;display: inline-block;">
                                                        ' . $productDetails . '
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="padding:8px 0px;border-bottom:1px solid rgba(17,128,176,1.00)">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="padding: 10px 0 0 0;font-weight:bold ;color: #000 !important;padding-left: 0px;color: #000;font-size: 14px;letter-spacing: 1px;font-weight: bold;width: 220px;display: inline-block;">
                                                        Quantity required
                                                    </td>
                                                    <td
                                                        style="padding: 10px 0 0 0;padding-left: 0px;color: #000 !important;font-size: 14px;letter-spacing: 1px;width: 220px;display: inline-block;">
                                                        $buyingQty
                                                    </td>
                                                    <td
                                                        style="padding: 10px 0 0 0;font-weight:bold ;color: #000 !important;padding-left: 0px;color: #000;font-size: 14px;letter-spacing: 1px;font-weight: bold;width: 220px;display: inline-block;">
                                                        Buying frequency
                                                    </td>

                                                    <td
                                                        style="padding: 10px 0 0 0;padding-left: 0px;color: #000 !important;font-size: 14px;letter-spacing: 1px;width: 220px;display: inline-block;">
                                                            ' . $buyFrequency . '
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="padding:8px 0px;border-bottom:1px solid rgba(17,128,176,1.00)">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="padding: 10px 0 0 0;font-weight:bold ;color: #000 !important;padding-left: 0px;color: #000;font-size: 14px;letter-spacing: 1px;font-weight: bold;width: 220px;display: inline-block;">
                                                        Ship to country
                                                    </td>
                                                    <td
                                                        style="padding: 10px 0 0 0;padding-left: 0px;color: #000 !important;font-size: 14px;letter-spacing: 1px;width: 220px;display: inline-block;">
                                                        ' . $countryOfShipping . '
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding-bottom: 0px;">
                                                        <h3
                                                            style="color:#585e66;font-size: 13px;margin: 0px;text-align: center;font-weight:normal;;">
                                                            If you can supply this product Please click here
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top" style="padding: 0px;">
                                                        <a target="_blank"
                                                            href=" ' . $sendQuotationUrl . '"
                                                            style="width: 27%;display: inline-block;margin-top:10px;padding: 7px 14px;border-radius:6px;border-color:rgba(2,90,191,1);background:rgba(17,128,176,1);color:#FFFFFF;font-size:11px;text-decoration:none;">
                                                            Submit Quotation
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding-bottom: 10px;padding-top: 10px;">
                                                        <h3 style="color:#585e66;font-size: 13px;margin: 0px;text-align: center;font-weight:normal;">
                                                            Or
                                                        </h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top" style="padding:0px;">
                                                        <a target="_blank" href="https://api.whatsapp.com/send?phone=+971566710044"
                                                            style="color:rgba(17,128,176,1) ;font-size:12px;text-decoration:none;">
                                                            Click here to reply via WhatsApp
                                                        </a>
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
                                                                            href="'. $baseUrl .'">Abraa.com</a>
                                                                        &nbsp; &nbsp;|
                                                                        <a style="text-decoration:none;color:black;"
                                                                            href="' . $baseUrl . '">RFQ Team</a>
                                                                        &nbsp;
                                                                    </span>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                    </td>
                                </tr>
                </tbody>
        </table>';

        return $html;

    }

    function __encryptors($action, $string)
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
        $secret_key = 'prtcl';
        $secret_iv = 'e4rt6mk';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }


}




