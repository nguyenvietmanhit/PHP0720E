<?php
//views/users/register.php
?>
<h1>Form đăng ký</h1>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"
                   class="form-control" />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   class="form-control" />
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm password</label>
            <input type="password" id="confirm-password"
                   name="confirm_password" class="form-control" />
        </div>
        <input type="submit" name="submit" value="Đăng ký"
               class="btn btn-primary" />
        <p>
            Đã có tài khoản,
            <a href="index.php?controller=user&action=login">
                Đăng nhập
            </a>
        </p>
    </form>
</div>