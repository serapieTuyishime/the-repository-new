<!-- Page content -->
<div class="">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0 row">
                    <div class="col">
                        <h3 class="mb-0"><?= $title?></h3>
                    </div>
                    <div class="col text-right">
                        <h3 class="mb-0 "><a href="<?php echo base_url(); ?>trips/create" class="btn btn-success"><i class="fa fa-plus"></i> Add new</a></h3>
                    </div>
                </div>
                <!-- Light table -->
                <div class="">
                    <table id="dataTable" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th><i class="fa fa-hashtag"></i>..</th>
                                <th>Route</th>
                                <th>Bus</th>
                                <th >Date</th>
                                <th >Time</th>
                                <th><i class="fa fa-hashtag"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <?php foreach ($trips as $key => $value): ?>
                                <tr>
                                    <td><?php echo $value['id']; ?></td>
                                    <td>
                                        <?php

                                        foreach ($routes as $v)
                                        {
                                            if ($v['id']== $value) {
                                                echo $v['name'];
                                                break;
                                            }
                                        }
                                         ?>
                                    </td>
                                    <td><?php echo $value['bus']; ?></td>
                                    <td><?php echo $value['date']; ?></td>
                                    <td><?php echo $value['time']; ?></td>
                                    <td class="text-right">
                                      <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                          <a class="dropdown-item" href="<?php echo base_url(); ?>trips/edit/<?php echo $value['id']; ?>"><i class="fa fa-edit text-primary"></i>Edit</a>
                                          <a class="dropdown-item" href="<?php echo base_url(); ?>trips/delete/<?php echo $value['id']; ?>"><i class="fa fa-trash text-danger"></i> Delete</a>
                                        </div>
                                      </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
