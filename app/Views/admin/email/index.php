<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $title ?? ''; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('/admin'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Emails</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">

<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body py-5">
						<div class="container">
						<form action="<?= base_url('/admin/emails'); ?>" method="post">
							<?= get_csrf_field(); ?>
							<div class="mb-3">
								<label for="name" class="form-label">Name</label>
								<input name="name" type="text" class="form-control <?= get_validation_class('name'); ?>" 
								id="name" placeholder="Name" value="<?= old('name'); ?>">
								<?= get_errors('name'); ?>
							</div>
							<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<input name="email" type="email" 
										class="form-control <?= get_validation_class('email'); ?>" 
										id="email" placeholder="name@example.com" value="<?= old('email'); ?>">
								<?= get_errors('email'); ?>
							</div>
							<div class="mb-3">
								<label for="message" class="form-label">Message</label>
								<textarea name="message"
										class="form-control" 
										id="message" placeholder="Message"></textarea>
							</div>
							<div class="mb-5">
								<label class="form-label" for="attachment">Choose file</label>
								<input type="file" name="attachment" class="form-control" id="attachment">
							</div>
							<div class="d-flex justify-content-between">
								<button type="submit" class="btn btn-warning px-5">SUBMIT</button>
								<div class="d-flex align-items-center g-3">
									<input type="checkbox" class="js-trigger">
									<div class="text">PHP post form</div>
								</div>
							</div>
						</form>
						</div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</section>
<!-- /.content -->