<?php include_file('shared/header'); ?>
<?php include_file('shared/navbar'); ?>

<div class="container">
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo url('auth/post_login') ?>" method="post">
			<?php echo insert_inputs(); ?>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>

        </form>
    </div>
</div>

<?php include_file('shared/footer'); ?>