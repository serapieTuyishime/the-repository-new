<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<div class="col-xl-8 order-xl-1 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Edit route </h3>
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url(); ?>routes" class="btn btn-sm btn-primary">Ignore</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php echo form_open('routes/update'); ?>
            <input type="hidden" name="id" value="<?php echo $route['id']; ?>">

            <h6 class="heading-small text-muted mb-4">Route information</h6>
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Departure</label>
                            <input name="depart" type="text" class="form-control" placeholder="Bus stop" value="<?php echo $route['depart']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Destination</label>
                            <input type="text" name="destination" class="form-control" placeholder="Bus stop" value="<?php echo $route['destination']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="form-control-label">Amount</label>
                            <input type="number" value="<?php echo $route['amount']; ?>" name="price" class="form-control" placeholder="Cost">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="form-control-label">Shift</label><br>
                            <input type="radio" name="time" value="night">Night <br>
                            <input type="radio" name="time" value="day" checked>Day
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4" />
            <div class="form-group">                
                <input type="submit" class="form-control btn btn-success" value="Create">
            </div>
        </form>
    </div>
</div>
