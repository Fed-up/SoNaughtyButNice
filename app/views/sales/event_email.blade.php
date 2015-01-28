<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>{{$event_name}} - Email Confirmation</title>
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
                                <a href="https://www.sonaughtybutnice.com/event/{{$event_id}}" style="display:block; width:407px; height:100px; margin:0 auto 30px;">
                                    <img src="https://www.sonaughtybutnice.com/images/email/header_logo.png" width="407" height="100" alt="{{$event_name}}" style="display:block; border:0; margin:0;">
                                </a>
                                <p style="margin:0 0 36px; text-align:center; font-size:14px; line-height:20px; text-transform:uppercase; color:#626658;">
                                    {{$event_name}} - Email Confirmation
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
                                                <p style="margin:0 30px 33px;; text-align:center; text-transform:uppercase; font-size:22px; line-height:30px; font-weight:bold; color:#484a42;">
                                                    TICKET ID FOR {{$name}}: {{$ticket_id}}
                                                </p>
                                                <!-- begin articles -->
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tbody>
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td>
                                                                <a style="display:block; margin:0 0 14px;" href="https://www.sonaughtybutnice.com/event/{{$event_id}}"><img src="https://www.sonaughtybutnice.com/images/email/date.png" width="255" height="150" alt="Date" style="display:block; margin:0; border:0; background:#eeeeee;"></a>
                                                                <p style="font-size:22px; line-height:22px; text-align:center; font-weight:bold; color:#333333; margin:0 0 5px;"><a href="https://www.sonaughtybutnice.com/event/{{$event_id}}" style="color:#6c7e44; text-decoration:none;">Date</a></p>
                                                                <p style="margin:0 0 35px; font-size:18px; text-align:center; line-height:18px; color:#333333;">{{$event_date}}</p>
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td>
                                                                <a style="display:block; margin:0 0 14px;" href="https://www.sonaughtybutnice.com/event/{{$event_id}}"><img src="https://www.sonaughtybutnice.com/images/email/time.png" width="255" height="150" alt="Time" style="display:block; margin:0; border:0; background:#eeeeee;"></a>
                                                                <p style="font-size:22px; text-align:center; line-height:22px; font-weight:bold; color:#333333; margin:0 0 5px;"><a href="https://www.sonaughtybutnice.com/event/{{$event_id}}" style="color:#6c7e44; text-decoration:none;">Time</a></p>
                                                                <p style="margin:0 0 35px; font-size:18px; text-align:center; line-height:18px; color:#333333;">{{$event_time}}</p>
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td>
                                                                <a style="display:block; margin:0 0 14px;" href="https://www.sonaughtybutnice.com/event/{{$event_id}}"><img src="https://www.sonaughtybutnice.com/images/email/cost.png" width="255" height="150" alt="Purchase" style="display:block; margin:0; border:0; background:#eeeeee;"></a>
                                                                <p style="font-size:22px; line-height:22px; font-weight:bold; color:#333333; margin:0 0 5px; text-align:center;"><a href="https://www.sonaughtybutnice.com/event/{{$event_id}}" style="color:#6c7e44; text-decoration:none;">Purchase</a></p>
                                                                <p style="margin:0 0 35px; text-align:center; font-size:18px; line-height:18px; color:#333333;">${{$event_cost}}</p>
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td>
                                                                <a style="display:block; text-align:center; margin:0 0 14px;" href="https://www.sonaughtybutnice.com/event/{{$event_id}}"><img src="https://www.sonaughtybutnice.com/images/email/quantity.png" width="255" height="150" alt="Tickets" style="display:block; margin:0; border:0; background:#eeeeee;"></a>
                                                                <p style="font-size:22px; text-align:center; line-height:22px; font-weight:bold; color:#333333; margin:0 0 5px;"><a href="https://www.sonaughtybutnice.com/event/{{$event_id}}" style="color:#6c7e44; text-decoration:none;">Tickets</a></p>
                                                                <p style="margin:0 0 35px; font-size:18px; text-align:center; line-height:18px; color:#333333;">{{$quantity}}</p>
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td colspan="3">
                                                                <a style="display:block; margin:0 0 14px;" href="https://www.google.com.au/maps/place/Raw+Materials+PTY+Ltd./@-37.8081688,144.9014175,16z/data=!4m5!1m2!2m1!1sstudio+raw+materials!3m1!1s0x0000000000000000:0xe5b92f306f6c213e"><img src="https://www.sonaughtybutnice.com/images/email/map.png" width="540" height="220" alt="Map to Venue" style="display:block; margin:0; border:0; background:#eeeeee;"></a>
                                                                <p style="font-size:14px; line-height:22px; font-weight:bold; color:#333333; margin:0 0 5px;"><a href="https://www.sonaughtybutnice.com/event/{{$event_id}}" style="color:#6c7e44; text-decoration:none;">We are excited to see you at the event {{$name}}</a></p>
                                                                <p style="margin:0 0 35px; font-size:12px; line-height:18px; color:#333333;">This year has been a massive year for So Naughty But Nice! <br/>
                                                                So get ready to dress up, and be ready to celebrate with us, your family and friends.
                                                                We look forward to seeing you there! x</p>
                                                            </td>
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!-- /end articles -->
                                                <p style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 29px;">&nbsp;</p>
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tbody>
                                                        <tr valign="top">
                                                            <td width="30"><p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p></td>
                                                            <td>
                                                                <p style="margin:0 0 4px; font-weight:bold; color:#333333; font-size:14px; line-height:22px;">So Naughty But Nice</p>
                                                                <p style="margin:0; color:#333333; font-size:11px; line-height:18px;">
                                                                    The place where you can discover how to make healthy desserts possible<br>
                                                                    Help &amp; Support Center: 0428 438 348<br>
                                                                    Website: <a href="https://www.sonaughtybutnice.com" style="color:#6d7e44; text-decoration:none; font-weight:bold;">www.sonaughtybutnice.com</a>
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
                                                                    <a href="https://www.sonaughtybutnice.com/event/{{$event_id}}" style="color:#6d7e44; text-decoration:none;">Event Details</a>
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
