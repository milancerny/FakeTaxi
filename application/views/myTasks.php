<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-tasks"></i> My Tasks
            <small>overview</small>
        </h1>
    </section>
    <br>
    <section class="content">
        <div class="row">

            <?php 
                if(!empty($taskData)) {
                    foreach($taskData as $record) {
            ?>     
            <div class="col-md-4 col-md-offset-1 task-box">
                <button type="button" class="close" aria-label="Close" title="Delete task">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
                
                <div style="width: 64%">
                    <h3 class="inline"><i class="fa fa-paperclip" aria-hidden="true"></i> <?php echo $record->subject; ?></h3>
                </div>
                <p class="inline pull-right">Due date: <small><?php echo $record->dueDate; ?></small></p>
                <hr class="task">
                <p>
                    <?php echo $record->description; ?>
                </p>
                <br>
                <div>
                    <a class="btn btn-success btn-lg" href="#">Success</a>
                </div>
            </div>
            <?php }} ?>
        </div>
    </section>
</div>