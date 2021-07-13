<div class="row">
    <div class="col-xl-6">
        <div class="card card-profile">
            <img src="<?php echo base_url().'assets/images/researchers/brand.jpg'; ?>" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <a href="#">
                            <img src="<?php echo base_url().'assets/images/researchers/'.$info['photo'] ?>" class="rounded-circle">
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                    <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col">
                        <div class="card-profile-stats d-flex justify-content-center">
                            <div>
                                <span class="heading"><?php echo $info['resources'] ?></span>
                                <span class="description">Resources</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h5 class="h3">
                        <?php echo $info['name'] ?>
                    </h5>
                    <div class="h5 font-weight-300">
                        <i class="ni location_pin mr-2"></i><?php echo $info['email'] ?>
                    </div>
                    <div class="h5 mt-4">
                        <i class="ni business_briefcase-24 mr-2"></i><?php echo $info['description'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Resources by <?php echo $info['name']; ?></h3>
                    </div>
                    <div class="col text-right">
                        <!-- <a href="<?php echo base_url()?>resources/index" class="btn btn-sm btn-primary">See all</a> -->
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Date added</th>
                            <th scope="col">Downloads</th>
                            <th scope="col">Saves</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php if (!empty($resources)): ?>
                            <?php foreach ($resources as $key => $value): ?>
    							<tr>
                                    <td scope= "row">
                                        <a href="<?php echo base_url().'resources/resource/'.$value['id']; ?>"><?php echo $value['title']?></a>
                                    </td>
                                    <td scope= "row"><?php echo $value['date']?></td>
                                    <td scope= "row"><?php echo $value['downloads']?></td>
    								<td scope= "row"><?php echo $value['saves']?></td>
    							</tr>
    						<?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
