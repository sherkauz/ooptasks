<?php require APP_ROOT . '/views/inc/header.php' ?>
<?php flash('user_message'); ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h3>Tasks (in process)</h3>
        </div>
        <div class="col-md-6">
            <a href="<?php echo URL_ROOT;?>/pages/addtask" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add Task
            </a>
        </div>
    </div>
    <div class="card card-body mb-3">
        <div class="card-block">
            <div class="table">
                <table class="table table-sm table-condensed">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </tr>
                    </thead>
                    <tbody>
<?php foreach($data['getTasks'] as $value) : ?>
                    <tr>
                        <td><?php echo $value->name; ?></td>
                        <td><?php echo $value->email; ?></td>
                        <td><?php echo $value->task; ?></td>
                        <?php if($value->status == 'active'){ ?>
                            <td> <span class="badge bg-success text-white"> <?php echo $value->status; ?> </span></td>
                        <?php }else{ ?>
                            <td> <span class="badge bg-warning text-white"> <?php echo $value->status; ?> </span></td>
                        <?php } ?> 
                        <td class="d-flex">
                            <form action="<?php echo URL_ROOT; ?>/tasks/alter/<?php echo $value->id; ?>" method="post" class="mr-2">
                                <input type="submit" name="toactive" value="to Active" class="btn btn-success btn-sm">
                            </form>

                            <a href="<?php echo URL_ROOT; ?>/tasks/edit/<?php echo $value->id; ?>" class="btn btn-primary btn-sm mr-2">Edit</a>
                        
                        <form action="<?php echo URL_ROOT; ?>/opers/delete/<?php echo $value->id; ?>" method="post">
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                        </td>
                    </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div><!-- end div table-responsive -->
        </div>
    </div>
<?php require APP_ROOT . '/views/inc/footer.php' ?>