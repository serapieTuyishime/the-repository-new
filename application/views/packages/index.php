<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Browse Packages</h3>
                    </div>
                    <div class="col text-right">
                    </div>
                </div>
            </div>
            <div class="row container">
                <?php foreach ($packages as $key => $value): ?>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $value['name']; ?></h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $value['price']; ?> Rwf</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <?php echo $value['details']; ?>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class=""><?php echo word_limiter($value['description'], 10); ?></span>
                                    <?php if ($this->session->userdata('userType')=='admin'): ?>
                                        <a href="<?php echo base_url().'packages/edit/'.$value['id']; ?>" >
                                            <span class="d-none d-md-block btn btn-primary"><i class="fa fa-edit"></i> Edit</span>
                                            <span class="d-md-none"><i class="fa fa-edit"></i></span>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo base_url().'packages/subscribe/'.$value['id']; ?>" >
                                            <span class="d-none d-md-block btn btn-primary"><i class="fa fa-coins"></i> Get</span>
                                            <span class="d-md-none"><i class="fa fa-coins"></i></span>
                                        </a>
                                    <?php endif; ?>
                                </p>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
