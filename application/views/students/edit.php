<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Student information update</h3>

                    </div>
                    <div class="col text-right">
                        <!-- <a href="myResearchs.html" class="btn btn-sm btn-warning">back</a> -->
                    </div>

                </div>
                <div class="container-fluid">
                    <div class="text-warning font-weight-bold">
                        <?php echo validation_errors(); ?>
                    </div>

                    <?php echo form_open('students/edit/'. $student['id'], 'client_register'); ?>
						<h6 class="heading-small text-muted mb-4">Student information</h6>
						<div class="pl-lg-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label">Name</label>
										<input name="name" type="text" class="form-control" placeholder="Student name" value="<?php echo $student['name']; ?>">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label">Email</label>
										<input type="text" name="email" class="form-control" placeholder="Student email" value="<?php echo $student['email']; ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="form-control-label">Username</label>
										<input type="text" class="form-control" placeholder="School id" value="<?php echo $student['username'];?>" readonly required name="usernameEdit">
									</div>
								</div>
							</div>
							<!-- <h6 class="heading-small text-muted mb-4">Login information</h6> -->
							<div class="row" hidden>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label">Password</label>
										<input type="password" name="password" class="form-control" placeholder="Password" id="password">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label class="form-control-label">Confirm password</label>
										<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
									</div>
								</div>
							</div>
						</div>
						<hr class="my-4" />
						<div class="form-group">
							<input type="submit" class="form-control btn btn-success" value="Add">
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
                        <h3 class="mb-0">Our students</h3>
                    </div>
                    <div class="col text-right">
                        <a href="<?php echo base_url()?>students" class="btn btn-sm btn-primary">See all</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Access expiring....</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach ($student['all_students'] as $key => $value): ?>
							<tr>
								<th scope="row"><?php echo $value['name']?></th>
								<td><?php echo $value['username']?></td>
								<td><?php echo $value['email']?></td>
								<td><?php echo $value['expiring_date']?></td>
							</tr>
						<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
