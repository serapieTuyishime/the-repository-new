<div class="col-xl-12 order-xl-1 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <!-- <h2 class="mb-0">All departments </h2> -->
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url(); ?>schools/create" class="btn btn-sm btn-primary">New</a>
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
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Description</th>
                        <th >Students</th>
                        <th><i class="fa fa-hashtag"></i> Actions</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php if (!empty($schools)): ?>
                        <?php foreach ($schools as $key => $value): ?>
                            <tr>
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['telephone']; ?></td>
                                <td><?php echo $value['description']; ?></td>
                                <td><?php echo $value['students']; ?></td>
                                <td class="text-right" >
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>schools/edit/<?php echo $value['id']; ?>"><i class="fa fa-edit text-primary"></i>Edit</a>
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>school/delete/<?php echo $value['id']; ?>"><i class="fa fa-trash text-danger"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
