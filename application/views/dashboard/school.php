
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
                                    <h5 class="card-title text-uppercase text-muted mb-0">Our students</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $students; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="<?php echo base_url(); ?>students/index">
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
                                    <h5 class="card-title text-uppercase text-muted mb-0">Active deals</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $active_subscriptions; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="ni ni-align-center"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="<?php echo base_url(); ?>departments/index">
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
                                    <h5 class="card-title text-uppercase text-muted mb-0">Next bill</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo date('d-M-y', strtotime($lastAccessDate)) ?></span>
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
                                    <h5 class="card-title text-uppercase text-muted mb-0">Coins</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $balance ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                                        <i class="fa fa-coins"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                    <span class="text-nowrap">As of today</span>
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
                        <h3 class="mb-0">Subscriptions</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url() ?>packages/index" class="btn btn-sm btn-primary">New</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- subscriptions table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"><i class="fa fa-hashtag"></i></th>
                            <th scope="col">Package ID</th>
                            <th scope="col">Date start</th>
                            <th scope="col">Date End</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($packages)): ?>
                            <?php foreach ($packages as $key => $value): ?>
                                <tr>
                                    <td><?php echo $value['id'] ?></td>
                                    <th scope="row">  <a href="<?php echo base_url().'packages/package/'. $value['package_id'] ?>"><?php echo $value['package_id'] ?></a>
                                    </th>
                                    <td><?php echo $value['date_start'] ?></td>
                                    <td><?php echo $value['date_end'] ?></td>
                                    <td><?php
                                        if (!$value['active']) {
                                            echo "<a href='".base_url()."packages/activate/". $value['id'] ."'><button class='btn btn-sm btn-warning'>Activate</a>";
                                        }
                                     ?></td>
                                </tr>
                            <?php endforeach; unset($value); unset($key);?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No subscriptions active</td>
                            </tr>
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
                        <h3 class="mb-0">Active Students</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url() ?>students/index" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"><i class="fa fa-hashtag"></i></th>
                            <th scope="col">Student Id</th>
                            <th scope="col">Downloads</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($downloadsPerStudents)): ?>
                            <?php foreach ($downloadsPerStudents as $key => $value): ?>
                                <tr>
                                    <th scope="row"><?php echo $key +1 ?></th>
                                    <td><?php echo $value['student_id'] ?></td>
                                    <td><?php echo $value['downloads'] ?></td>
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
