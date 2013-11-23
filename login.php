<?php include 'header.php'; ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>">

<label for="username">Username:</label><input type="text" name="username">
<label for="password">Password:</label><input type="password" name="password">
<input type="submit" name="login" value="login">

</form>
<?php include 'footer.php'; ?>