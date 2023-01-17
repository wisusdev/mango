<?php include_file('shared/header'); ?>
<?php include_file('shared/navbar'); ?>

    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <p class="m-0 fw-semibold">Login</p>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo url('auth/postRegister') ?>" method="post">
                            <?php echo insert_inputs(); ?>
							<div class="form-group mb-3">
								<label class="form-label">Name</label>
								<input type="text" name="name" class="form-control">
							</div>

                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm-password" class="form-control">
                            </div>
                            <div class="form-group float-end">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php include_file('shared/footer'); ?>