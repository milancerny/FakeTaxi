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
            <div class="col-md-4 pull-right">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <?php 
                if(!empty($taskData)) {
                    foreach($taskData as $record) {
            ?>     
            <form action="<?php echo base_url() ?>successTask" method="post" role="form" id="#">
                <div class="col-md-4 col-md-offset-1 task-box">
                    <button type="button" class="close" aria-label="Close" title="Delete task">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <br>
                    
                    <div style="width: 64%">
                        <h3 class="inline"><i class="fa fa-paperclip" aria-hidden="true"></i> <?php echo htmlspecialchars($record->subject, ENT_QUOTES, 'UTF-8'); ?></h3>
                    </div>
                    <p class="inline pull-right">Due date: <small><?php echo $record->dueDate; ?></small></p>
                    <hr class="task">
                    <p>
                        <?php echo htmlspecialchars($record->description, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <br>
                        
                    <div class="input-group">
                        <input type="hidden" value="<?php echo $record->taskId; ?>" id="taskId" name="taskId" />
                    </div>
                    <input type="submit" class="btn btn-success btn-lg" value="Success" />
                </div>
            </form>
            <?php }} ?>
        </div>
    </section>
</div>