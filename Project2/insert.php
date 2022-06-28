<?php
session_start();
$server='localhost';
$username='root';
$password='';
$db='Employees';
$conn=mysqli_connect($server,$username,$password,$db);
if(!$conn){
    die("Connection failed".mysqli_connect_error());
}
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$country=$_POST['country'];
$phone=$_POST['phone'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$gender=$_POST['gender'];
$_SESSION['fname']=$_POST['fname'];
$_SESSION['mname']=$_POST['mname'];
$_SESSION['lname']=$_POST['lname'];
$_SESSION['email']=$_POST['email'];
$_SESSION['country']=$_POST['country'];
$_SESSION['phone']=$_POST['phone'];
$_SESSION['password']=$_POST['password'];
$_SESSION['password2']=$_POST['password2'];
$_SESSION['gender']=$_POST['gender'];

if(empty($fname) || empty($country) || empty($phone) || empty($gender) || empty($email) || empty($lname) || empty($password)){
    header('location:register.php?empty=Done');
}else if(!preg_match("/^[a-zA-Z ]*$/",$fname)){
    header('location:register.php?fname=Invalid');   
}else if(!preg_match("/^[a-zA-Z ]*$/",$mname)){
    header('location:register.php?mname=Invalid');   
}else if(!preg_match("/^[a-zA-Z ]*$/",$lname)){
    header('location:register.php?lname=Invalid');   
}else if(!filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)){
    header('location:register.php?email=Invalid');   
}else if(!preg_match("/^[0-9]*$/",$country)){
    header('location:register.php?country=Invalid');   
}else if(!preg_match("/^[9][8][0-9]*$/",$phone)){
    header('location:register.php?phone=Invalid');
}else if(strlen($phone)!=10){
    header('location:register.php?phones=Invalid');
}else if(strlen($password)<8){
    header('location:register.php?password=Invalid');
}else if($password!=$password2){
    header('location:register.php?cpassword=Invalid');
}
else{

$sql="insert into employee(fname,mname,lname,email,country,phone,password,gender) values ('$fname','$mname','$lname','$email','$country','$phone','$password','$gender')";
$res=mysqli_query($conn,$sql);
if(!$res){
    die("NOT INSERTED<br>".mysqli_error($conn));
}
header('location:signin.php?register=success');
session_destroy();
}
?>