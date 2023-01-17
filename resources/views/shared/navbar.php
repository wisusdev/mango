<nav class="navbar navbar-expand-lg bg-warning">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><?php echo config('app.name') ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto">

			</ul>
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo url('auth/login') ?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('auth/register') ?>">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>