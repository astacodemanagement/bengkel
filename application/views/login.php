<style>
    #toggle-icon {
        cursor: pointer;
    }
</style>

<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <img src="<?= bengkelLogo() ?>" alt="" style="border-radius:1rem;">
            <div class="login-logo">
                <a href="#" style="color:#FFF;font-size: 28px"> Aplikasi Bengkel
                    <?= $this->shop_info->get_shop_name(); ?>
                </a>
            </div>
            <div class="login-form">
                <?php if ($error) { ?>

                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php } ?>

                <form action="<?= base_url("auth/login"); ?>" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password">
                            <div class="input-group-append">
                                <span class="input-group-text" id="show-password-toggle">
                                    <i class="fa fa-eye" id="toggle-icon"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" style="border-radius: 1rem;">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggle-icon');

        toggleIcon.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Ubah ikon mata berdasarkan status password
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    });
</script>