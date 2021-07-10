
<?php echo validation_errors(); ?>

<div class="col-xl-10 order-xl-1 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h2 class="mb-0"><?php echo 'You searched for: '. ucfirst($content); ?> </h2>
                </div>
                <div class="col-4 text-right">
                    <!-- <a href="<?php echo base_url(); ?>students/create" class="btn btn-sm btn-primary">New</a> -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php $tblCount=0; ?>
            <?php foreach ($results as $key => $value): ?>
                <?php foreach ($value as $k => $v): ?>
                    <?php if (!empty($v)): ?>
                        <h3 class="mb-1"><?php echo 'From: '. Ucfirst($key); ?></h3>
                        <?php for ($i=0; $i < sizeof($v) ; $i++): ?>
                            <?php  $keys = array_keys($v[$i]); ?>
                            <a href="<?php echo base_url().$tables[$tblCount][2].$v[$i][$keys[0]]; ?>" class="text-reset">
                                <label for="" class="text-decoration-none"><?php echo $v[$i][$keys[1]]; ?></label> <br>
                            </a>
                        <?php endfor; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php $tblCount++; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
