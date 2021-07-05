<div class="col-xl-8 order-xl-1 mx-auto">
	<div class="card">
		<div class="card-header">
			<div class="row align-items-center">
				<div class="col-8">
					<h3 class="mb-0">Add new package </h3>
				</div>
				<div class="col-4 text-right">
						<a href="<?php echo base_url(); ?>packages" class="btn btn-sm btn-primary">Ignore</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="text-warning font-weight-bold">
				<?php echo validation_errors(); ?>
			</div>

			<?php echo form_open('packages/create', 'client_register'); ?>
				<h6 class="heading-small text-muted mb-4">Package information</h6>
				<div class="pl-lg-4">
					<div class="row">
							<div class="col-lg-6">
									<div class="form-group">
											<label class="form-control-label">Name</label>
											<input name="name" type="text" class="form-control" placeholder="Package name" value="<?php echo $package['name']; ?>">
									</div>
							</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label class="form-control-label">Price</label>
								<input type="text" name="price" class="form-control" placeholder="" value="<?php echo $package['price']; ?>">
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Select the topics for the package</label> <br>
								<div class="row">

									<?php foreach ($package['all_departments'] as $key => $value): ?>
										<div class="col-lg-4">
											<?php echo '<input type="checkbox" name="departments[]" value="'.$value['id'].'">'; ?>
											<?php echo ucfirst($value['name']); ?> <br>
										</div>
									<?php endforeach; ?>

								</div>

                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-control-label">Description</label>
								<textarea name="description" class="form-control" rows="4">
									<?php echo $package['description']; ?>
								</textarea>
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
