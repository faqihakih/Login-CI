<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">

        <?= $this->session->flashdata('message');?>

        <!-- <h4>Role : <?= $role['role'];?></h4> -->

        <!-- <a href="<?= base_url('admin/role')?>">Back <i class="fas fa-fw fa-arrow-left"></i></a> -->

        <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach ($role as $r) :?>
            <tr>
            <th scope="row"><?= $no++ ?></th>
            <td><?= $r['name']; ?></td>
            <td><?= $r['role_id']; ?></td>
            <td>
            <a href="<?= base_url('admin/editUserRole/'.$r['id']) ?>" class="badge badge-success"
            >Edit</a>
            </td>
            </tr>
        <?php endforeach;?>
        </tbody>
        </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->