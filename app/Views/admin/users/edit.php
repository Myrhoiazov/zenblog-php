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
                    <li class="breadcrumb-item active">Edit user</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>
                    <!-- /.card-header -->

                    <form method="post" action="<?= base_url('/admin/users/update'); ?>" enctype="multipart/form-data">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" 
												value="<?= h($user['name']); ?>"
												class="form-control <?= get_validation_class('name', $errors ?? []); ?>" 
												id="name" placeholder="Name" 
												value="<?= h($user['name']); ?>">
                                        <?= get_errors('name', $errors ?? []); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="email" type="text" 
												value="<?= h($user['email']); ?>"
												class="form-control <?= get_validation_class('email', $errors ?? []); ?>" 
												id="email" placeholder="email" 
												value="<?= h($user['email']); ?>">
                                        <?= get_errors('email', $errors ?? []); ?>
                                    </div>
                                </div>
								<div class="col-md-10">
                                    <div class="form-group">
                                        <label for="image">Avatar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="avatar"
                                                       class="custom-file-input <?= get_validation_class('avatar', $errors ?? []); ?>"
                                                       id="avatar"
													   value="<?= h($user['avatar']); ?>">
                                                <label class="custom-file-label" for="avatar">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <?= get_errors('avatar', $errors ?? []); ?>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
										<label for="role">Role</label>
										<select name="role" id="role" 
												class="form-control <?= get_validation_class('email', $errors ?? []); ?>">
											<option value="admin" <?= h($user['role']) == 1 ? 'selected' : ''; ?>>Admin</option>
											<option value="user" <?= h($user['role']) == 0 ? 'selected' : ''; ?>>User</option>
										</select>
										<?php get_csrf_field() ?>
                                        <?= get_errors('role', $errors ?? []); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="hidden" name="id" value="<?= h($user['id']); ?>">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                    <?php session()->forget('form_errors'); ?>

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</section>
<!-- /.content -->

