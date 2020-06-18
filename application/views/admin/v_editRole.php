<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php foreach ($role as $r) :?>
                <form action="<?= base_url('admin/update') ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $r->id ?>">
                        <input type="text" class="form-control" id="roel" name="role" placeholder="Menu name" value="<?= $r->role ?>">
                    </div>
                    <a type="button" href="<?= base_url('admin/role')?>" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
