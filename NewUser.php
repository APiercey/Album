<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Album</title>
</head>
<body>
<h3>To start, please enter the required registration data</h3>

<form action='NewUser.php' method='post'>
	<table>
    		<tr>
				<td class='input' width="190" align="right">Email:</td>
                <td width="144"><input type = "text" name = "email" /></td>
			</tr>
            <tr>
				<td class='input' width="190" align="right">Name:</td>
                <td width="144"><input type = "text" name = "name"  /></td>
                
			</tr>
            <tr>
				<td class='input'align="right">Create Password:</td>
				<td><input type='password' name = "createpassword" /></td>
			</tr>
            <tr>
				<td class='input'align="right">Re-enter Password:</td>
				<td><input type='password' name = "reenterpassword"  /></td>
			</tr>
			<tr>
				<td ><input type='submit' class='button' name='btnRegister' value='Register' />&nbsp;&nbsp;
					<input type='submit' class='button' name='btnReset' value='Reset' /></td>
     </tr>
	</table>
	<br/>
	</form>

</body>
</html>