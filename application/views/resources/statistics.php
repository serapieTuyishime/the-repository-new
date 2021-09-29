<div class="col-xl-12 order-xl-1 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <!-- <h2 class="mb-0">All departments </h2> -->
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- <table id="dataTable" class="table align-items-center table-flush" data-page-length='2'> -->
            <table id="dataTable" class="table align-items-center table-responsive">
                <thead class="thead-light">
                    <tr>
                        <th><i class="fa fa-hashtag"></i>ID</th>
                        <th>Title</th>
                        <!-- <th>Author</th> -->
                        <!-- <th>department</th> -->
                        <th>price</th>
                        <th >date</th>
                        <th >downloads</th>
                        <th >file name</th>
                        <th><i class="fa fa-hashtag"></i> Actions</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php if (!empty($resources)): ?>
                        <?php foreach ($resources as $key => $value): ?>
                            <tr>
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['title']; ?></td>
                                <!-- <td><?php echo $value['researcher_id']; ?></td> -->
                                <!-- <td><?php echo $value['department']; ?></td> -->
                                <td><?php echo $value['price']; ?></td>
                                <td><?php echo substr($value['date'],0,10); ?></td>
                                <td><?php echo $value['downloads']; ?></td>
                                <td><?php echo $value['file']; ?></td>
                                <td class="text-right" >
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>resources/edit/<?php echo $value['id']; ?>"><i class="fa fa-edit text-primary"></i>Edit</a>
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>resources/resource/<?php echo $value['id']; ?>"><i class="fa fa-play text-success"></i>More info</a>
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>resources/delete/<?php echo $value['id']; ?>"><i class="fa fa-trash text-danger"></i> Delete</a>
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
