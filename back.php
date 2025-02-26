<?php
// url,username,password
$con=mysqli_connect('localhost','root','');
if(!$con){
    echo "not connected";
}

if(!mysqli_select_db($con,'user')){
    echo "database not selected";
}
$Name=$_POST['Name'];
$Email=$_POST['Email'];
$Password=$_POST['Password'];
$sql="INSERT INTO userInfo (Name,Email,Password) Values('$Name','$Email','$Password')";
if(mysqli_query($con,$sql)){
    echo "inserted data";
}
else{
    echo "not inserted";
}
?>