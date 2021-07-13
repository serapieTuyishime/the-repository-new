<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0"><?php echo $resource['title']; ?></h3>

                    </div>
                    <div class="col text-right">
                        <!-- <a href="myResearchs.html" class="btn btn-sm btn-warning">back</a> -->
                    </div>

                </div>
                <div class="container-fluid">
                    <hr>
                    <h4>Abstract</h4>
                    <p>
                        <?php echo $abstract; ?>
                    </p>
                    <hr>
                    <p>
                        <div class="row">
                            <div class="col-md-6">
                                <label>By: <?php echo ucfirst($researcher['name']) ?></label><br>
                                <i>Uploaded on  </i><?php echo $resource['date']; ?>
                            </div>
                            <div class="col-md-4">
                                <label>Solo purchase: <strong><?php echo $resource['price']; ?> Rwf</strong></label>
                            </div>
                            <div class="col-md-1">
                                <i class="fa fa-download"></i> <?php echo $downloads; ?>
                            </div>
                            <div class="col-md-1">
                                <i class="fa fa-save"></i> <?php echo $saves; ?>
                            </div>
                        </div>
                    </p>
                    <div class="col">
                        <ul class="nav nav-pills justify-content-end">
                            <?php if ($this->session->userdata('logged_in')): ?>
                                <?php if ($this->session->userdata('userType')=='researcher' && $this->session->userdata('user_id')== $resource['researcher_id']): ?>
                                    <!-- get and print the statistics -->

                                    <li class="nav-item mr-2 mr-md-0">
                                        <a href="<?php echo base_url().'resources/edit/'.$resource['id'] ?>" class="nav-link py-2 px-3 active" >
                                            <span class="d-none d-md-block"><i class="fa fa-edit"></i> Edit</span>
                                            <span class="d-md-none"><i class="fa fa-edit"></i></span>
                                        </a>
                                    </li>


                                <?php else: ?>
                                    <li class="nav-item mr-2 mr-md-0"  data-suffix="k">
                                        <a href="<?php echo base_url().'resources/download/'.$resource['id'] ?>" class="nav-link py-2 px-3 active" >
                                            <span class="d-none d-md-block"><i class="fa fa-download"></i> Download</span>
                                            <span class="d-md-none"><i class="fa fa-download"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" >
                                        <a href="<?php echo base_url().'resources/save_for_later/'.$resource['id'] ?>" class="nav-link py-2 px-3" >
                                            <span class="d-none d-md-block"><i class="fa fa-save"></i> Save for later</span>
                                            <span class="d-md-none"><i class="fa fa-save"></i></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php else: ?>
                                <li class="nav-item mr-2 mr-md-0"  data-suffix="k" hidden>
                                    <a href="<?php echo base_url().'clients/login'; ?>" class="nav-link py-2 px-3 active" >
                                        <span class="d-none d-md-block"><i class="fa fa-download"></i> Login</span>
                                        <span class="d-md-none"><i class="fa fa-download"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item mr-2 mr-md-0"  data-suffix="k">
                                    <a href="<?php echo base_url().'clients/login?to_where=resources_download_'.$resource['id']; ?>" class="nav-link py-2 px-3 active" >
                                        <span class="d-none d-md-block"><i class="fa fa-download"></i> Download</span>
                                        <span class="d-md-none"><i class="fa fa-download"></i></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
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
                        <h3 class="mb-0">From the same uploader</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url() ?>resources/index" class="btn btn-sm btn-primary">See all</a>
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
                        <?php if (!empty($resources_by_research)): ?>
                            <?php foreach ($resources_by_research as $key => $value): ?>
                                <tr>
                                    <th scope="row"><?php echo $value['title']; ?></th>
                                    <td><?php echo $value['date']; ?></td>
                                    <td><?php echo $value['title']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
