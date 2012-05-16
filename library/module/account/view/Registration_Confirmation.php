<?php
$url = HTTP_ROOT;
$content = <<<EMAIL
<!DOCTYPE html>
<html>
<head>
<title>Thank you for registering!</title>
<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<style>
    img {display:block;}
</style>
</head>
<body style="background:url($url/images/burlap.png) #555 100% 0;margin:0;padding:0">
<div style="background:url($url/images/burlap.png) #555 100% 0;">
	<table width="600" border="0" cellspacing="0" cellpadding="0" class="email-body-wrap" id="email-body" align="center" >
	<tr height="30" >
	   <td>
	   </td>
	</tr>
	<tr>
	   <td height="20"></td>
	</tr>
	<tr >
	   <td style="background-color:#eeeeee;background:url($url/images/paper.png) #eeeeee;border-radius:3px;box-shadow:5px 5px 10px #3b4c5d;padding:0;margin:0;">
    	   <img src="$url/images/airmail.png" style="height:10px;width:600px;border-top-left-radius:3px;border-top-right-radius:3px;margin:0;padding:0"/>
    	   <img src="$url/images/logo_large.png" height="60" style="height:50px;display:inline-block;vertical-align:middle;margin-top:-20px;margin-left:30px;"/>
    	   <h1 style="font-family: 'Pacifico', cursive, sans-serif;color:#3399cc;margin-top:20px;margin-left:-10px;display:inline-block;">
    	   Sparticle        
    	   </h1>
    	   <h2 style="display:inline-block;font-family:Lucida Sans Unicode, Lucida Grande, sans-serif;color:#888888;font-size:large;">
    	    &nbsp;&nbsp;thanks you for registering!
    	   </h2>
    	   <p style="color:#555555;font-family:Lucida Sans Unicode, Lucida Grande, sans-serif;line-height:1.5;margin-left:30px;margin-right:30px;margin-bottom:30px;">
                <span>To confirm your account please click on the link below:</span>
                <br/>
                <span style="color:#3399cc">$link</span>
           </p>
    	   
            <p style="background-color:#dddddd;font-family:Lucida Sans Unicode, Lucida Grande, sans-serif;font-size:small;color:#666666;padding:15px;border-bottom-right-radius:3px;border-bottom-left-radius:3px;border-top-color:#bbbbbb; border-width:1px; border-top-style:solid;text-align:center;margin:0;">
                To request a new token click <a href="$url" style="color:#3399cc">here</a>.
            </p>	   
	   </td>
	</tr>
	<tr>
	   <td height="30"></td>
	</tr>
	</table>
        <!--
<div style="font-size:small;color:#FFFFFF;font-family:Lucida Sans Unicode, Lucida Grande, sans-serif;margin:10px;width:99%;text-align:center;"> 
            If you have trouble viewing this email, please goto: 
            <a href="$url" style="color:#3399cc;text-decoration:none;"></a>
            <br />
        </div>
-->
</div>
</body>
</html>
EMAIL;
