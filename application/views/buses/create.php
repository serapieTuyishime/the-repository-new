<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<div class="col-xl-8 order-xl-1 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0"><?= $title; ?> </h3>
                </div>
                <div class="col-4 text-right">
                    <a href="<?php echo base_url(); ?>routes" class="btn btn-sm btn-primary">Routes</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php echo form_open('buses/create'); ?>
            <h6 class="heading-small text-muted mb-4">Bus information</h6>
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Plate number</label>
                            <input name="plate" type="text" class="form-control" placeholder="Ex. RAA 111 A" value="<?php echo $plate; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Capacity</label>
                            <input name="size" type="number" min="3" max="300" class="form-control" value="<?php echo $size; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Route</label>
                            <select class="form-control" name="route">
                                <option value="">-Select</option>
                                <?php foreach($routes as $route): ?>
                        		  	<option value="<?php echo $route['id']; ?>"><?php echo $route['name']; ?></option>
                        		  <?php endforeach; ?>
                            </select>
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
