<?php require APP_ROOT . '/views/inc/header.php' ?>
<div class="text-center">
    <h1>Adding a task</h1>
    <p>You can do it without authorization</p>
</div>

<div class="container">
<div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-3">
                <?php flash('register_success'); ?>
                <h3>Add your task</h3>
                <p>Please, fill all blanks.</p>
                <form action="<?php echo URL_ROOT; ?>/tasks/add" method="post">

                    <div class="form-group">
                    <label for="name">Name: <sup>*</sup></label>
                    <input type="text" name="name" id="name" class="form-control form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" placeholder="Your name...">
                    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>

                    <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" id="email" class="form-control form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" placeholder="Your email...">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>

                    <div class="form-group">
                    <label for="task">Task: <sup>*</sup></label>
                    <input type="text" name="task" id="task" class="form-control form-control <?php echo (!empty($data['task_err'])) ? 'is-invalid' : '';?>" placeholder="Your task...">
                    <span class="invalid-feedback"><?php echo $data['task_err']; ?></span>
                    </div>

                    <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block"/>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APP_ROOT . '/views/inc/footer.php' ?>