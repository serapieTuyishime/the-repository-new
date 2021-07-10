<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0"><?php echo $package['package_info']['name']; ?></h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url(); ?>packages/index" class="btn btn-sm btn-warning">back</a>
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
                    <?php echo form_open('packages/subscribe/'.$package['package_info']['id']); ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Months</label>
                                    <input name="months" type="number" class="form-control" value="<?php echo $package['months']; ?>" min="1" max="20">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label"> <br> </label>
                                    <button type="submit" name="button" class="btn btn-primary form-control">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
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
