<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>{{$pData[0]->name}} - Package Enquiry</title>
</head>
<body style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color:#f0f2ea; margin:0; padding:0; color:#333333;">

<table width="100%" bgcolor="#f0f2ea" cellpadding="0" cellspacing="0" border="0">
    <tbody>
        <tr>
            <td style="padding:40px 0;">
                <!-- begin main block -->
                <table cellpadding="0" cellspacing="0" width="608" border="0" align="center">
                    <tbody>
                        <tr>
                            <td>
                                <a href="https://www.sonaughtybutnice.com/package/{{$pData[0]->id}}" style="display:block; width:407px; height:100px; margin:0 auto 30px;">
                                    <img src="https://www.sonaughtybutnice.com/images/email/header_logo.png" width="407" height="100" alt="SoNaughtyButNice.com Logo" style="display:block; border:0; margin:0;">
                                </a>
                                <p style="margin:0 0 36px; text-align:center; font-size:14px; line-height:20px; text-transform:uppercase; color:#626658;">
                                    {{$pData[0]->name}} - Package Enquiry
                                </p>
                                <!-- begin wrapper -->
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="8" height="4" colspan="2" style="background:url(http://demo.artlance.ru/email/shadow-top-left.png) no-repeat 100% 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td height="4" style="background:url(http://demo.artlance.ru/email/shadow-top-center.png) repeat-x 0 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="8" height="4" colspan="2" style="background:url(http://demo.artlance.ru/email/shadow-top-right.png) no-repeat 0 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                        
                                        <tr>
                                            <td width="4" height="4" style="background:url(http://demo.artlance.ru/email/shadow-left-top.png) no-repeat 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td colspan="3" rowspan="3" bgcolor="#FFFFFF" style="padding:0 0 30px;">
                                                <!-- begin content -->
                                                <img src="https://www.sonaughtybutnice.com/images/email/header.png" width="600" height="221" alt="Delicious Healthy Desserts" style="display:block; border:0; margin:0 0 44px; background:#eeeeee;">
                                                <p style="margin:0px;; text-align:center; font-size:22px; line-height:30px; font-weight:bold; color:#484a42;">
                                                    Thankyou {{$fname}} for your catering enquiry!
                                                </p>
                                                <p style="margin:0px;; text-align:center; font-size:16px; line-height:30px; color:#484a42;">
                                                    Date: {{$date}}
                                                </p>
                                                <p style="margin:0 30px 33px;; text-align:center; font-size:16px; line-height:30px; color:#484a42;">
                                                    Time: {{$time}}
                                                </p>
                                                <!-- begin articles -->
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tbody>

                                                        @foreach($pData as $package)
                                                            @foreach($package->menuRecipes as $recipe)
                                                                <tr valign="top">
                                                                    <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                                    <td width="100px">
                                                                        <a style="display:block; margin:0 0 14px;" href="https://www.sonaughtybutnice.com/package/{{$pData[0]->id}}">
                                                                            <img src="https://www.sonaughtybutnice.com/uploads/{{ $recipe_image[$recipe->id] }}" width="100%" height="100%" alt="Recipe Image" style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                        </a>
                                                                    </td>
                                                                    <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                                    <td>
                                                                        <p style="font-size:16px; text-align:left; line-height:22px; font-weight:bold; color:#6c7e44; margin:0 0 5px;">{{$recipe->name}}</p>
                                                                        <p style="font-size:14px; text-align:left; line-height:22px; font-weight:bold; color:#343434; margin:0 0 5px; padding-right:10px; float:left">Amount: </p>
                                                                        <p style="margin:0 0 35px; font-size:14px; line-height:22px; color:#333333;">{{$recipe->pivot->amount}}</p>
                                                                    </td>
                                                                    <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <!-- /end articles -->
                                                <p style="margin:0; border-top:1px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 29px;">&nbsp;</p>
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tbody>
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td>
                                                                <p style="margin:0 0 4px; font-weight:bold; color:#6c7e44; font-size:18px; line-height:22px;">Your message</p>
                                                                <p style="margin-left:10px; color:#333333; font-size:14px; line-height:18px;">{{$d_message}}</p>
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p style="margin:0; border-top:1px solid #e5e5e5; font-size:5px; line-height:5px; margin:30px 29px;">&nbsp;</p>
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tbody>
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td>
                                                                <p style="margin:0 0 4px; font-weight:bold; color:#6c7e44; font-size:14px; line-height:22px;">So Naughty But Nice</p>
                                                                <p style="margin:0; color:#333333; font-size:11px; line-height:18px;">
                                                                    For immediate contact please don't hesitate to contact us directly =)<br/><br/>
                                                                    Call: <span style="color:#6d7e44; text-decoration:none; font-weight:bold;">0428 438 348</span><br/>
                                                                    Email: <span style="color:#6d7e44; text-decoration:none; font-weight:bold;">hello@sonaughtybutnice.com</span><br/>
                                                                    Website: <a href="https://www.sonaughtybutnice.com" style="color:#6d7e44; text-decoration:none; font-weight:bold;">www.sonaughtybutnice.com</a><br/><br/>
                                                                    Warm Regards,<br/>
                                                                    Sarah & Tom 
                                                                </p>
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td width="120">
                                                                <a href="https://www.facebook.com/healthydessert" style="float:left; width:24px; height:24px; margin:6px 8px 10px 0;">
                                                                    <img src="https://www.sonaughtybutnice.com/images/email/facebook.png" width="24" height="24" alt="facebook" style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <a href="https://pintrest.com/snaughtybutnice" style="float:left; width:24px; height:24px; margin:6px 8px 10px 0;">
                                                                    <img src="https://www.sonaughtybutnice.com/images/email/pintrest.png" width="24" height="24" alt="twitter" style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <a href="https://twitter.com/snaughtybutnice" style="float:left; width:24px; height:24px; margin:6px 8px 10px 0;;">
                                                                    <img src="https://www.sonaughtybutnice.com/images/email/twitter.png" width="24" height="24" alt="tumblr" style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <a href="http://instagram.com/sonaughtybutnice" style="float:left; width:24px; height:24px; margin:6px 0 10px 0;">
                                                                    <img src="https://www.sonaughtybutnice.com/images/email/instagram.png" width="24" height="24" alt="rss" style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <p style="margin:0; font-weight:bold; clear:both; font-size:12px; line-height:22px;">
                                                                    <a href="https://www.sonaughtybutnice.com" style="color:#6d7e44; text-decoration:none;">Visit website</a><br>
                                                                    <a href="https://www.sonaughtybutnice.com/package/{{$pData[0]->id}}" style="color:#6d7e44; text-decoration:none;">Veiw Package</a>
                                                                </p>
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- end content --> 
                                            </td>
                                            <td width="4" height="4" style="background:url(http://demo.artlance.ru/email/shadow-right-top.png) no-repeat 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td width="4" style="background:url(http://demo.artlance.ru/email/shadow-left-center.png) repeat-y 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" style="background:url(http://demo.artlance.ru/email/shadow-right-center.png) repeat-y 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                        
                                        <tr> 
                                            <td width="4" height="4" style="background:url(http://demo.artlance.ru/email/shadow-left-bottom.png) repeat-y 100% 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url(http://demo.artlance.ru/email/shadow-right-bottom.png) repeat-y 0 100%;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                 
                                        <tr>
                                            <td width="4" height="4" style="background:url(http://demo.artlance.ru/email/shadow-bottom-corner-left.png) no-repeat 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url(http://demo.artlance.ru/email/shadow-bottom-left.png) no-repeat 100% 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td height="4" style="background:url(http://demo.artlance.ru/email/shadow-bottom-center.png) repeat-x 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url(http://demo.artlance.ru/email/shadow-bottom-right.png) no-repeat 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                            <td width="4" height="4" style="background:url(http://demo.artlance.ru/email/shadow-bottom-corner-right.png) no-repeat 0 0;"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- end wrapper-->
                                <p style="margin:0; padding:34px 0 0; text-align:center; font-size:11px; line-height:13px; color:#333333;">
                                    Don‘t want to recieve further emails? You can unsibscribe <a href="https://www.sonaughtybutnice.com/unsibscribe" style="color:#333333; text-decoration:underline;">here</a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- end main block -->
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>
