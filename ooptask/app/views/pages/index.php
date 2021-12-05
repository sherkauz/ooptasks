<?php require APP_ROOT . '/views/inc/header.php' ?>
<div class="jumbotron jumbrotron-fluid">
    <div class="container">
        <h1 class="display-3">Welcome, guest!</h1>
        <p class="lead">
        You can see tasks` list below.
        </p>
    </div>
</div>
<div class="container">

    <div class="row">
        <div class="col-md-12 d-flex">
            <span class="d-flex">  
                <form action="<?php echo URL_ROOT; ?>/pages/index" method="post"> 
                    <select name="sort" class="form-control d-flex"> 
                        <option value="name">name</option>
                        <option value="email">email</option>
                        <option value="status">status</option>
                    </select> 
                    <button type="submit" name="submit" class="btn btn-light btn-sm">Sort by</button>
                </form>
        </div>
    </div>

    <div class="row mt-3 d-flex justify-content-around">
    <?php foreach($data['getTasks'] as $value){ ?>
    <div class="col-md-4 border p-3">
        <h4><?php echo $value->name ?></h4>
        <?php if($value->status == 'active'){ ?>
            <p class="text-muted m-0 p-0">Status: <span class="badge bg-success text-white"><?php echo $value->status ?></span></p>
        <?php }else{ ?>
            <p class="text-muted m-0 p-0">Status: <span class="badge bg-warning text-white"><?php echo $value->status ?></span></p>
        <?php } ?>
        <p class="text-muted">Email: <?php echo $value->email ?></p>
        <p>Task: <?php echo $value->task ?></p>
    </div>
    <?php } ?>
    </div>
    
    <div class="row mx-auto my-3">
        <div class="col-md-4 mx-auto text-center">
            <p class="text-muted m-0 p-0">Pagination</p>
            <a href="?page=<?php echo $data['pagination']->prev_page().''.$data['pagination']->check_search();?>"> << </a>
            <?php for($i=1; $i<=$data['pages']; $i++): ?>
                <?php if($data['pagination']->is_showable($i)):?>
                    <a class="<?php echo $data['pagination']->is_active_class($i) ?>" 
                    href="?page=<?php echo $i.''.$data['pagination']->check_search(); ?>"><?php echo $i;?></a>
                <?php endif; ?>
            <?php endfor; ?>
        <a href="?page=<? echo $data['pagination']->next_page().''.$data['pagination']->check_search();?>"> >> </a>
        </div>
    </div>
</div>
<?php require APP_ROOT . '/views/inc/footer.php' ?>
