<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-pencil"></i> Create New Task
        <small>Create / Edit Task</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Task Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="createTask" action="<?php echo base_url() ?>createNewTask" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fsubject">Subject</label>
                                        <input type="text" class="form-control required" id="fsubject" name="fsubject" maxlength="255">
                                    </div>
                                    <div class="form-group">
                                        <label for="dueDate">Due date</label>
                                        <input type="text" class="form-control required" id="dueDate"  name="dueDate">
                                    </div>
                                    <div class="form-group">
                                        <label for="solver">Solver</label>
                                        <select class="form-control required" id="solver" name="solver">
                                            <option value="0">Select Solver</option>
                                            <?php
                                                if(!empty($solvers)) {
                                                    foreach ($solvers as $solver) {
                                            ?>
                                            <option value="<?php echo $solver->userId ?>"><?php echo $solver->name ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fdes">Description</label>
                                        <!--<input type="text" class="form-control required email" id="fdes"  name="fdes" maxlength="255">-->
                                        <textarea class="form-control required" id="fdes"  name="fdes" maxlength="255" style="height: 181px"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
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
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/createTask.js" type="text/javascript"></script>