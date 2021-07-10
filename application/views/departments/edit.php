<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Department Update</h3>

                    </div>
                    <div class="col text-right">
                        <!-- <a href="myResearchs.html" class="btn btn-sm btn-warning">back</a> -->
                    </div>

                </div>
                <div class="container-fluid">
                    <div class="text-warning font-weight-bold">
                        <?php echo validation_errors(); ?>
                    </div>

                    <?php echo form_open('departments/edit/' . $department['id'], 'client_register'); ?>
						<h6 class="heading-small text-muted mb-4">Add ...</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label">Name</label>
										<input name="name" type="text" class="form-control" placeholder="Department name" value="<?php echo $department['name']; ?>">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
                                        <label class="form-control-label">.</label>
                                        <input type="submit" class="form-control btn btn-success" value="Update">
									</div>
								</div>
							</div>
						</div>
                	</form>
				</div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Other departments</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url()?>departments/index" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">name</th>
                            <th scope="col">Resources</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach ($department['all_departments'] as $key => $value): ?>
							<tr>
								<th scope="row"><?php echo $value['id']?></th>
								<td><?php echo $value['name']?></td>
								<td><?php echo $value['resources'] ?></td>
							</tr>
						<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
