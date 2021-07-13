<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="mb-0"><?php echo ucfirst($package['package_info']['name']); ?></h2>
                    </div>
                    <div class="col text-right">
                        <!-- <a href="<?php echo base_url(); ?>packages/index" class="btn btn-sm btn-warning">back</a> -->
                    </div>

                </div>
                <div class="container-fluid">
                    <div class="text-warning">
                        <?php echo validation_errors(); ?>
                    </div>
                    <hr>
                    <h4>Description</h4>
                    <p>
                        <?php echo $package['package_info']['description']; ?>
                    </p>
                    <hr>
                    <p>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Montly Price: <strong><?php echo $package['package_info']['price'];?> Rwf</strong></label>
                            </div>
                        </div>
                    </p>
                    <h4>Departments covered</h4>
                    <div class="row">

                        <?php if (!empty($package['details'])): ?>
                            <?php foreach ($package['details'] as $key => $value): ?>
                                <div class="col-lg-4">
                                    <?php echo ucfirst($value['department_name']); ?> <br>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Other packages</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url()?>packages/index" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Departments</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($package['all_packages'] as $key => $value): ?>
                            <tr>
                                <th scope="row"><?php echo $value['name']?></th>
                                <td><?php echo $value['details']?></td>
                                <td><?php echo $value['price']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
