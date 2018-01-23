<html>

<head>
</head>
<body>

<div style="width:200px;height:100px;">
 <div>百度搜索</div>
 <form action="" method="get">
  <input type="text" name="key">
  <input type="submit" value="搜索">
 </form>
</div>
<?php
$k = '';
$k = !empty($_GET['key'])?$_GET['key']:'';
session_start();
$_SESSION['key'] = $k;
 
$curl = curl_init(); 
// 设置你需要抓取的URL 
 
for($i = 0;$i<2;$i++){
curl_setopt($curl, CURLOPT_URL, "http://www.baidu.com/s?wd={$_SESSION['key']}&pn={$i}"); 
// 设置header 
curl_setopt($curl, CURLOPT_HEADER, 1); 
// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
// 运行cURL，请求网页 
$data = curl_exec($curl); 
 
$pre = '/<h3 class="t"><a.*?href = "(.*?)".*?target="_blank".*?>(.*?)<\/a><\/h3>/s';
preg_match_all($pre,$data,$match);
 
foreach ($match[1] as $k => $v) {
?> 
<div style="font-size:20px;color:red;">
 <a href="<?php echo $v;?>" target="_blank"><?php echo strip_tags($match[2][$k]);?></a>
</div>
<?php
}
}
 
curl_close($curl)
 
 
?>

</body>
</html>