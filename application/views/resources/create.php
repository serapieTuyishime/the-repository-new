<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">New research</h3>
                    </div>
                    <div class="col text-right">
                        <a href="#!" class="btn btn-sm btn-warning">Ignore</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="text-warning">
                    <?php echo validation_errors(); ?>
                </div>
                <?php echo form_open_multipart('resources/create', 'client_register'); ?>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Research title</label>
                                    <input name="name" type="text" class="form-control" placeholder="Unique name" value="<?php echo $resource['title']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Document</label>
                                    <input type="file" name="userfile" class="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label class="form-control-label">Select Category</label>
                                    <select class="form-control" name="department">
                                        <option value="">~ select</option>
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
                        <a href="myResearchs.html" class="btn btn-sm btn-primary">See all</a>
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
