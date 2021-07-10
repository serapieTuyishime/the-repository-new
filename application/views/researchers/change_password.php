
<?php echo validation_errors(); ?>

<div class="col-xl-8 order-xl-1 mx-auto">
	<div class="card">
		<div class="card-header">
			<div class="row align-items-center">
				<div class="col-8">
					<h3 class="mb-0">Researcher account</h3>
				</div>
				<div class="col-4 text-right">
						<a href="<?php echo base_url(); ?>resources" class="btn btn-sm btn-primary">Ignore</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="text-warning font-weight-bold">
				<?php echo validation_errors(); ?>
			</div>

			<?php echo form_open('researchers/change_password', 'client_register'); ?>
				<h6 class="heading-small text-muted mb-4">Complete the below form</h6>
				<div class="pl-lg-4">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-control-label">Old password</label>
								<input type="password" name="old_password" class="form-control" placeholder="Current password">
							</div>
						</div>
					</div>
					<div class="row">
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
						<input type="submit" class="form-control btn btn-success" value="Change">
				</div>

			</form>
		</div>
	</div>
</div>
