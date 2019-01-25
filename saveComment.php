<?
header('Content-type:text/html;charset=gb2312');
include("conn/conn.php");
$title=$_POST['title'];
$content=$_POST['content'];
$goodsID=$_GET['id'];
$time=date("Y-m-d H:i");
session_start();
$username=$_SESSION['username'];
mysqli_query($conn,"insert into tb_pingjia (username,goodsID,title,content,time) values ('$username','$goodsID','$title','$content','$time')");
echo "<script>alert('评价发表成功!');</script>";
header("location:goodsDetail.php?id=".$goodsID."&action=showcomment");
?>
