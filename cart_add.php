<?php
header("Content-type:text/html;charset=gb2312");
session_start();
include("conn/conn.php");
if(!isset($_SESSION['username'])){
	echo"<script>alert('请先登录后购物!');history.back();</script>";
exit;
}
$id=strval($_GET['goodsID']);
$num=strval($_GET['num']);
$sql=mysqli_query($conn,"select * from tb_shangpin where id='".$id."'");
$info=mysqli_fetch_array($sql);
if($info['shuliang']<=0){
	echo "<Script>alert('该商品已经售完!");history.back();</script>";
exit;
}
$array=explode("@",isset($_SESSION['producelist'])?$_SESSION['producelist']:"");
if(count($array)==1){
	$_SESSION['producelist']=$_SESSION['producelist'].$id."@";
	$_SESSION['quatity']=	$_SESSION['quatity'].$num."@";
}
if(count($array)!=1){
	if(!in_array($id,$array)){
		$_SESSION['producelist']=$_SESSION['producelist'].$id."@";
		$_SESSION['quatity']=$_SESSION['quatity'].$num."@";
}else{
	$arrayquatity=explode("@",$_SESSION['quatity']);
	$key=array_search($id,$array);
	$arrayquatity[$key]=$arrayquatity[$key]+$num;
	$_SESSION['quatity']=implode("@",$arrayquatity);
}
}
header("location:cart_see.php");
?>
