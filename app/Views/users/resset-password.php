<?php 


// dump($_SESSION['csrf_token']);
// dump($_SESSION['form_data']);

if(!isset($_SESSION['form_data']['csrf_token_name']) || !isset($_SESSION['csrf_token'])) {
	response()->redirect('/');
} else{
	$token = $_SESSION['form_data']['csrf_token_name'];
} 
?>

<div class="col-md-12">
    <div class="contact">
        <form action="<?= base_url('/update-password'); ?>" method="POST">
			<div class="row">
				<div class="form-group">
					<input type="hidden" name="csrf_token_name" value="<?= $token; ?>">
					<?= get_csrf_field() ?>
				</div>
				<div class="form-group col-lg-6 mb-3">
					<input type="text" name="password"
							class="form-control <?= get_validation_class('password', $errors ?? []); ?>" id="password"
							placeholder="Password" value="<?= old('password'); ?>">
					<?= get_errors('password', $errors ?? []); ?>
				</div>
				<div class="form-group col-lg-6 mb-3">
					<input type="text"
							class="form-control <?= get_validation_class('repassword', $errors ?? []); ?>"
							name="repassword" id="repassword" placeholder="Confirm Password" value="<?= old('repassword'); ?>">
					<?= get_errors('repassword', $errors ?? []); ?>
				</div>
				<div class="col-12 mt-3">
					<button class="btn btn-primary"  type="submit">Update</button>
				</div>
			</div>
        </form>
    </div>
</div>


