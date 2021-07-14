<div class="col-xl-10 order-xl-1 mx-auto">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-8">
                    <h2 class="mb-0">History </h2>
                </div>
                <div class="col-4 text-right">
                    <!-- <a href="<?php echo base_url(); ?>schools/create" class="btn btn-sm btn-primary">New</a> -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- <table id="dataTable" class="table align-items-center table-flush" data-page-length='2'> -->
            <table id="dataTable" class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th><i class="fa fa-hashtag"></i>ID</th>
                        <th>Name</th>
                        <th >Date saved</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php if (!empty($resources)): ?>
                        <?php foreach ($resources as $key => $value): ?>
                            <tr>
                                <td><?php echo $value['id']; ?></td>
                                <td>    <a href="<?php echo base_url().'/resources/resource/'.$value['resource_id'] ?>"><?php echo $value['title']; ?></a>
                                </td>
                                <td><?php echo $value['date']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
