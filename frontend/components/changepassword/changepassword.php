<form action="" method="post">
<input type="password" name="oldpassword" value="<?php echo htmlspecialchars($_POST['oldpassword'], ENT_QUOTES); ?>" placeholder="Current Password"/>
<input type="password" name="newpassword" value="<?php echo htmlspecialchars($_POST['newpassword'], ENT_QUOTES); ?>" placeholder="New Password"/>
<input type="password" name="newpasswordrepeat" value="" placeholder="Repeat Password"/>
<input type="submit" name="changepassword" value="Change Password"/>
</form>