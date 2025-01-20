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
                    <li class="breadcrumb-item active">Voiting</li>
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
							<?php if (!empty($users)): ?>
								<div class="row">
									<?php foreach($users as $user) {?> 
										<div class="col-3">
											<?php if (isset($user['avatar'])): ?>
												<div class="img-wrap">
													<img src="<?= $user['avatar']; ?>" title="<?= $user['name']; ?>" class="rounded" alt="<?= $user['name']; ?>" width="200">
												</div>
												<?php else: ?>
													<div class="img-wrap">
														<img src="<?= base_url() . '/images/avatar.png' ; ?>" alt="<?= $user['name']; ?>" class="img-thumbnail" width="200" alt="User">
													</div>
											<?php endif; ?>
											<div class="desc">
												<p><?= $user['name']; ?></p>
												<p>Голосов: <?= $user['voutes'] ?: '0' ?></p>
												<form method="POST" action="">
													<input type="hidden" name="gvotes" value="<?php echo $user['votes'] ?? 0 ?>">
													<input type="hidden" name="gid" value="<?php echo $user['id'] ?>">
													<?= get_csrf_field() ?>
												<?php if($user['class'] === 'active') {?>
                    								<button disabled class="btn btn-success" type="button">Voted</button>
												<?php } else{ ?>
                    								<button class="btn btn-primary" type="submit">Vote</button>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
								</div>
							<?php else: ?>
								<p class="p-3">Voiting posts found...</p>
							<?php endif; ?>
						</div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</section>
<!-- /.content -->