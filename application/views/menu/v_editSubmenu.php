<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php foreach ($subMenu as $sm) :?>
                <form action="<?= base_url('menu/updateSubmenu') ?>" method="post">
                <div class="form-group">
                <select name="menu_id" id="menu_id" class="form-control">
                    <option value="">Select Menu</option>
                    <?php foreach ($menu as $m):?>
                        <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                    <?php endforeach;?>
                </select>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $sm->id ?>">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Menu name" value="<?= $sm->title ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="url" name="url" value="<?= $sm->url ?>" placeholder="Submenu url" >
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" value="<?= $sm->icon ?>">
                </div>

                <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" aria-label="Checkbox for following text input" name="is_active" value="1" checked id="is_active">
                    <label for="is_active">Active ?</label>
                    </div>
                </div>
                <a type="button" href="<?= base_url('menu')?>" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Add</button>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</div>