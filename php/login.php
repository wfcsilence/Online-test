<?php
header("Content-Type: text/html; charset=UTF-8");
//include_once ("connect.php");
/*开启会话*/
session_start();
$name=$_POST['name'];/*获取登录表单提交过来的数据*/
$pswd=$_POST['pswd'];
$filepath="../record/record.txt";
$str="";
$user = $name;
$password = $pswd; //To be completed if you have set a password to root
$database = 'project'; //To be completed to connect to a database. The database must exist.
$port = NULL; //Default must be NULL to use default port
try{
$link = @mysqli_connect('127.0.0.1', $user, $password, $database, $port);
}
catch (Exception $e){
    die("ERROR_连接失败");
}
//$link->query("set names utf8");

if (!$link) {
    $flag=2;
    $str=$name."登录失败";
    file_put_contents($filepath,$str);
    /*die('Connect Error (' . $link->connect_errno . ') '
            . $link->connect_error);*/
}else{
//$result=$link->query("select * from `students` where student_name='$name' and student_pswd='$pswd'");
//$link = null;
//$row = mysqli_fetch_object($result);/*读取从数据库获取的数据*/
//if ($row) {/*如果数据存在，即用户登录成功*/
    $_SESSION['name'] = $name;//$row->student_name;
    $_SESSION['pswd'] = $pswd;
    /*将姓名存在服务器，可以多个页面使用*/
    //$_SESSION['id']=$row->student_id;
    //$_SESSION['class']=$row->class;
    $flag=3;
    /*header('location:../index2.html');*/
    $_SESSION['describe']="此处是题干";
    $_SESSION['a']="选项A";
    $_SESSION['b']="选项B";
    $_SESSION['c']="选项C";
    $_SESSION['d']="选项D";
    $_SESSION['answer']="#";
    $a=array("");
    $_SESSION['tests']=$a;
    $_SESSION['index']="0";
    $str=$_SESSION['name']."已登录";
//}else{/*用户名或密码错误*/
    //header('refresh:3; url=../index.html');
    //echo "用户名或密码错误,系统将在3秒后跳转到登录界面,请重新填写登录信息!";
    /*$flag=2;
    $str=$name+"登录失败";
}*/


file_put_contents($filepath,$str);
}
echo ($flag); //显示在客户端
?>