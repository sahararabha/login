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
            <th>حذف</th>
        </tr>
        <?php
			require 'class/db.php';
			if(isset($_GET["id"]))
			{
				$delete = new database;
				$id = $_GET["id"];
				$delete->delete('user','id='.$id);
			}
			$search = new database;
			$res = $search->select('user');
			foreach($res as $row)
			{
				echo '<tr>
						<td>'.$row["name"].'</td>
						<td>'.$row["username"].'</td>
						<td>'.$row["email"].'</td>
						<td>'.$row["city"].'</td>
						<td>'.$row["age"].'</td>
						<td><a href="?id='.$row["id"].'">حذف</a></td>
						<td><a href="update.php?id='.$row["id"].'">ویرایش</a></td>
				</tr>';
			}
        ?>
    </table>
</body>
</html>