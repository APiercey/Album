<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Album</title>
</head>
<body>
<h3>Upload your Pictures(accepted picture types: JPEG, GIF, PNG) </h3>
<form action='NewUser.php' method='post'>
  <table>
    		<tr>
				<td class='input' width="190" align="right">File to Upload</td>
                <td width="144"><input type = "text" name = "upload" /></td>
			</tr>
            <tr>
				<td class='input' width="190" align="right">Title</td>
                <td width="144"><input type = "text" name = "Title"  /></td>
                
			</tr>
            <tr>
				<td class='input'align="right">Description</td>
				<td><TEXTAREA name = "Description" ROWS=2 COLS=20></TEXTAREA></td>
			</tr>
			<tr>
				<td ><input type='submit' class='button' name='btnUpload' value='Upload' />&nbsp;&nbsp;
					<input type='submit' class='button' name='btnDone' value='Done' /></td>
     </tr>
	</table>
	<br/>
</form>

</body>
</html>