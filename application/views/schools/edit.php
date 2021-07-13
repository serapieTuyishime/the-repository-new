
<?php echo validation_errors(); ?>

<div class="col-xl-8 order-xl-1 mx-auto">
	<div class="card">
		<div class="card-header">
			<div class="row align-items-center">
				<div class="col-8">
					<h3 class="mb-0">Edit school info </h3>
				</div>
				<div class="col-4 text-right">
						<a href="<?php echo base_url(); ?>schools" class="btn btn-sm btn-primary">Ignore</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="text-warning font-weight-bold">
				<?php echo validation_errors(); ?>
			</div>

			<?php echo form_open('schools/edit/'.$school['id'], 'client_register'); ?>
				<h6 class="heading-small text-muted mb-4">School information</h6>
				<div class="pl-lg-4">
					<div class="row">
							<div class="col-lg-12">
									<div class="form-group">
											<label class="form-control-label">Name</label>
											<input name="name" type="text" class="form-control" placeholder="School name" value="<?php echo $school['name']; ?>">
									</div>
							</div>

					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="form-control-label">Email</label>
								<input type="text" name="email" class="form-control" placeholder="School email" value="<?php echo $school['email']; ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label class="form-control-label">telephone</label>
								<input type="text" name="telephone" class="form-control" placeholder="School contact" value="<?php echo $school['telephone']; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-control-label">Description</label>
								<textarea name="description" class="form-control" rows="4">
									<?php echo $school['description']; ?>
								</textarea>
							</div>
						</div>
					</div>
				</div>
				<hr class="my-4" />
				<div class="form-group">
						<input type="submit" class="form-control btn btn-success" value="Update">
				</div>

			</form>
		</div>
	</div>
</div>
