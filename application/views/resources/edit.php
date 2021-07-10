<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Update research info</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url() ?>resources/index" class="btn btn-sm btn-warning">Ignore</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="text-warning">
                    <?php echo validation_errors(); ?>
                </div>
                <?php echo form_open_multipart('resources/edit/'.$resource['id'], 'client_register'); ?>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="form-control-label">Select Category</label>
                                    <select class="form-control" name="department">
                                        <option value="<?php echo $resource['department']; ?>">
                                            <?php foreach ($resource['all_departments'] as $key => $value): ?>
                                                <?php if ($resource['department'] == $value['id']): ?>
                                                    <?php echo $value['name']; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </option>
                                        <?php foreach ($resource['all_departments'] as $key => $value): ?>
                                            <option value="<?php echo $value['id'] ?>"> <?php echo ucfirst($value['name']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="form-control-label">Price <i>(Rwf)</i> </label>
                                    <input type="text" name="price" placeholder="Ex: 23.4" name="" class="form-control" value="<?php echo $resource['price']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label class="form-control-label">Abstract</label>
                                    <textarea class="form-control" name="description">
                                        <?php echo $resource['description']; ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-success" value="Create">
                    </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Uploaded researchs</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url() ?>researchers/index" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Date uploaded</th>
                            <th scope="col">Readers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                twitter
                            </th>
                            <td>
                                Jun 23, 2020
                            </td>
                            <td>
                                123,000
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
