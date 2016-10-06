<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>پنل</title>
</head>
<body style="direction:rtl">
    <table cellpadding="15" border="1">
        <tr>
            <th>نام</th>
            <th>نام کاربری</th>
            <th>ایمیل</th>
            <th>شهر</th>
            <th>سن</th>
            <th>ویرایش</th>
        </tr>
        <tr>
           <?php
           require 'class/db.php';
		   if(isset($_GET["id"]))
		   {
			   $id = $_GET["id"];
			   $edit = new database;
			   
			   if(isset($_GET["edit"]))
			   {
				   $edit->update('user',$param=array(
						'name' => $_GET["name"],
						'username' => $_GET["username"],
						'email' => $_GET["email"],
						'city' => $_GET["city"],
						'age'=> $_GET["age"]
				   ),'id='.$id);
			   }
			   $res = $edit->select('user','*',null,'id='.$id);
			   $row = $res->fetch(PDO::FETCH_ASSOC);
		   }
           ?>
		   <form method="get">
            <td><input type="text" name="name" value="<?php echo $row["name"]; ?>"></td>
            <td><input type="text" name="username" value="<?php echo $row["username"]; ?>"></td>
            <td><input type="text" name="email" value="<?php echo $row["email"]; ?>"></td>
            <td><input type="text" name="city" value="<?php echo $row["city"]; ?>"></td>
            <td><input type="text" name="age" value="<?php echo $row["age"]; ?>"></td>
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
            <td><input type="submit" value="ویرایش" name="edit"></td>
			</form>
        </tr>
    </table>
</body>
</html>