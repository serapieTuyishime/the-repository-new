<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Browse Resources</h3>
                    </div>
                    <div class="col text-right">
                    </div>
                </div>
            </div>
            <div class="row container">
                <?php foreach ($resources as $key => $value): ?>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $value['saves']; ?> Saves</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $value['title']; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <?php echo $value['downloads']; ?>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="">By: <?php echo $value['author']; ?></span>
                                    <a href="<?php echo base_url().'resources/resource/'.$value['id']; ?>" >
                                        <span class="d-none d-md-block btn btn-light"><i class="fa fa-list"></i> More</span>
                                        <span class="d-md-none"><i class="fa fa-list"></i></span>
                                    </a>
                                </p>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="pagination-links">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</div>
