<div class="col-xl-10 order-xl-1 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <!-- <h2 class="mb-0">All departments </h2> -->
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url(); ?>resources/create" class="btn btn-sm btn-primary">New</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- <table id="dataTable" class="table align-items-center table-flush" data-page-length='2'> -->
            <table id="dataTable" class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th><i class="fa fa-hashtag"></i>ID</th>
                        <th>Name</th>
                        <th >Downloads</th>
                        <th >Saves</th>
                        <th><i class="fa fa-hashtag"></i> Actions</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php if (!empty($resources)): ?>
                        <?php foreach ($resources as $key => $value): ?>
                            <tr>
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['title']; ?></td>
                                <td><?php echo $value['downloads']; ?></td>
                                <td><?php echo $value['saves']; ?></td>
                                <td>
                                    <a class="" href="<?php echo base_url(); ?>resources/edit/<?php echo $value['id']; ?>"><i class="fa fa-edit text-primary"></i></a>
                                    <a class="" href="<?php echo base_url(); ?>resources/delete/<?php echo $value['id']; ?>"><i class="fa fa-trash text-danger"></i> </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
