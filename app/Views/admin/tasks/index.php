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
                    <li class="breadcrumb-item active">Tasks</li>
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
							<div class="app">
								<div class="boards">
									<div class="boards__item">
										<span contenteditable="true" class="title">Type name</span>
										<div class="list">
											<div class="list__item" draggable="true">Start card</div>
										</div>
										<div class="form">
											<textarea class="textarea" placeholder="Enter name of card" autofocus ></textarea>
											<div class="buttons">
												<button class="add__item-btn">Add card</button>
												<button class="cancel__item-btn">Cancel card</button>
											</div>
										</div>
										<div class="add__btn"><span>+</span> Add card</div>
									</div>
								</div>
								<div class="button">Add Board</div>
							</div>
						</div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</section>
<!-- /.content -->