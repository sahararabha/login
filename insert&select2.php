<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ورود - ثبت نام</title>
</head>
<body style="direction:rtl">
<?php
require 'class/db.php';
if(isset($_POST["send"]))
{
	$signup = new database;
	$result = $signup->insert('user',$param=array(
		'name' => $_POST["name"],
		'username' => $_POST["username"],
		'password' => md5($_POST["password"]),
		'email' => $_POST["email"],
		'age' => $_POST["age"],
		'city' => $_POST["city"]
	));
	if($result)
	{
		echo 'ثبت نام با موفقیت انجام شد';
	}
}

if(isset($_POST["login"]))
{
	$login = new database;
	$user = $_POST["username"];
	$pass = md5($_POST["password"]);
	$result = $login->select('user','*',null,'username ="'.$user.'" && password = "'.$pass.'"');
	$row = $result->rowCount();
	if($row == 1)
	{
		//header("location:panel.php"); // error : Cannot modify header information - headers already sent by 
		echo '<script>window.location.href="panel.php"</script>';
		exit;
	}
}

?>
    <form action="" method="post">
        <table>
            <tr>
                <td>نام و نام خانوادگی</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>نام کاربری</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>رمز عبور</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>آدرس ایمیل</td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td>سن</td>
                <td><input type="number" name="age"></td>
            </tr>
            <tr>
                <td>شهر</td>
                <td><input type="text" name="city"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="ثبت نام" name="send"></td>
            </tr>
        </table>
    </form>
    <br>
    <form method="post">
        <table>
            <tr>
                <td>نام کاربری : </td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>رمز عبور : </td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="ورود" name="login"></td>
            </tr>
        </table>
    </form>
</body>
</html>