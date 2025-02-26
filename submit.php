<?php
// url,username,password
$con=mysqli_connect('localhost','root','');
if(!$con){
    echo "not connected";
}

if(!mysqli_select_db($con,'user')){
    echo "database not selected";
}
$Name=$_GET['Name'];
$Email=$_GET['Email'];
$Password=$_GET['Password'];
$sql="INSERT INTO userInfo (Name,Email,Password) Values('$Name','$Email','$Password')";
$sql="UPDATE userInfo SET NAME='a' where Email='anujkumarsharma2023@gmail.com'";
$ans=mysqli_query($con,$sql);
$rows=mysqli_num_rows($ans);
echo $rows;

if(mysqli_query($con,$sql)){
    echo "name: ",$Name,"email: ",$Email,"password: ",$Password;
    echo "inserted data";
}
else{
    echo "not inserted";
}

$con->close();
?>