<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php foreach ($menu as $m) :?>
                <form action="<?= base_url('menu/update') ?>" method="post">
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?= $m->id ?>">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" value="<?= $m->menu ?>">
                    </div>
                    <a type="button" href="<?= base_url('menu')?>" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>
