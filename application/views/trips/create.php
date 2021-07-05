<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<div class="col-xl-8 order-xl-1 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Create trip </h3>
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url(); ?>trips" class="btn btn-sm btn-primary">Ignore</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php echo form_open('trips/create'); ?>
            <h6 class="heading-small text-muted mb-4">Trip information</h6>
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Departure Date</label>
                            <input name="date" type="date" class="form-control" placeholder="Bus stop" value="<?php echo $trip['date']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Departure time</label>
                            <input type="time" name="destination" class="form-control" placeholder="Bus stop" value="<?php echo $trip['time']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label">Departure time</label>
                        <select name="bus" class="form-control">
                            <option value="">--Select</option>
                            <?php foreach ($trip['buses'] as $key => $value): ?>
                                <option value="<?php echo $value['id'] ?>"><?php echo $value['number'].' On '. $value['name'].' Route'; ?></option>
                            <?php endforeach ?>
                        </select>
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
