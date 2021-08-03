
<?php echo validation_errors(); ?>

<div class="col-xl-10 order-xl-1 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <!-- <h2 class="mb-0">All Students </h2> -->
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url(); ?>students/create" class="btn btn-sm btn-primary">New</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable1" class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">School</th>
                        <th scope="col">Package</th>
                        <th scope="col">Active until</th>
                        <th scope="col">Active ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($subscriptions)): ?>
                        <?php foreach ($subscriptions as $key => $value): ?>
                            <tr>
                                <th scope="row"><?php echo $value['school'] ?></th>
                                <td><?php echo $value['package'] ?></td>
                                <td><?php echo $value['date_end'] ?></td>
                                <td><?php echo ($value['active'])? 'Yes': 'No'; ?></td>
                            </tr>
                        <?php endforeach; unset($value); unset($key);?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
