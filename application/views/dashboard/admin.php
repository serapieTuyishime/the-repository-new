
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Summary</h3>
                    </div>
                    <div class="col text-right">
                    </div>
                </div>
            </div>
            <div class="row container">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total schools</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $schools; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="ni ni-building"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="<?php echo base_url(); ?>schools/index">
                                    <span class="text-nowrap">View more</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Money made</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $coins; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-align-center"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="<?php echo base_url(); ?>payments/index">
                                    <span class="text-nowrap">Details</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total resources</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $resources; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-cyan text-white rounded-circle shadow">
                                        <i class="ni ni-books"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="<?php echo base_url(); ?>resources/index">
                                    <span class="text-nowrap">View more</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Authors</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $researchers; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-yellow text-black rounded-circle shadow">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="<?php echo base_url(); ?>researchers/index">
                                    <span class="text-nowrap">View more</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Downloads</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url() ?>resources/statistics" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Downloads</th>
                            <th scope="col">Saves</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($all_resources)): ?>
                            <?php foreach ($all_resources as $key => $value): ?>
                                <tr>
                                    <th scope="row"><?php echo $value['title'] ?></th>
                                    <td><?php echo $value['author'] ?></td>
                                    <td><?php echo $value['downloads'] ?></td>
                                    <td><?php echo $value['saves'] ?></td>
                                </tr>
                            <?php endforeach; unset($value); unset($key);?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Active subscriptions</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url() ?>subscriptions/index" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">School</th>
                            <th scope="col">Package</th>
                            <th scope="col">Active until</th>
                            <th scope="col">Active ?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($subsrciptions)): ?>
                            <?php foreach ($subsrciptions as $key => $value): ?>
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
</div>
<div class="row">
    <div class="col-xl-8">
        <div class="card bg-default">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                        <h5 class="h3 text-white mb-0">Sales value</h5>
                    </div>
                    <div class="col">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                                <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                    <span class="d-none d-md-block">Month</span>
                                    <span class="d-md-none">M</span>
                                </a>
                            </li>
                            <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                                <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                    <span class="d-none d-md-block">Week</span>
                                    <span class="d-md-none">W</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                    <!-- Chart wrapper -->
                    <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                        <h5 class="h3 mb-0">Total orders</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                    <canvas id="chart-bars" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
