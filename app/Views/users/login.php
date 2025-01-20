<div class="col-md-12">
    <div class="contact">
        <form action="<?= base_url('/login'); ?>" method="post" role="form" class="php-email-form" id="login-form" autocomplete="on">
            <div class="row">
                <div class="form-group">
                    <input type="email" class="form-control <?= get_validation_class('email', $errors ?? []) ; ?>" name="email" id="email" placeholder="Your Email" value="<?= old('email'); ?>">
                    <?= get_errors('email', $errors ?? []); ?>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control <?= get_validation_class('password', $errors ?? []) ; ?>" id="password" placeholder="Password" value="<?= old('password'); ?>">
                    <?= get_errors('password', $errors ?? []); ?>
                </div>
				<?php echo get_csrf_field(); ?>
            </div>
            <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
            </div>
            <div class="row">
				<div class="col-6">
					<a href="javascript:void(0)" class="btn-link js-forgotPassword"  data-bs-toggle="modal" data-bs-target="#forgotPassword">Forgot password?</a>
				</div>
                <div class="col-6 text-end">
					<button type="submit">Login</button>
				</div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="forgotPasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Recover password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<form action="<?= base_url('/restore-password'); ?>" method="post" role="form" autocomplete="on" id="resset-password">
			<label for="ressetPassword" class="form-label">Enter your email</label>
			<input type="email" class="form-control" name="ressetPassword" id="ressetPassword" placeholder="Eneter your email">
			<div class="my-3 text-end">
				<button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Send</button>
			 </div>
		</form>
	</div>
    </div>
  </div>
</div>

