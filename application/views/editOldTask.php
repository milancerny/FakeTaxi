<?php
    $taskId = '';
    $subject = '';
    $description = '';
    $dueDate = '';
    $userId = '';
    $solver = '';

    if(!empty($taskInfo)) {
        foreach ($taskInfo as $uf) {
            $taskId = $uf->taskId;
            $subject = $uf->subject;
            $description = $uf->description;
            $dueDate = $uf->dueDate;
            $userId = $uf->userId;
            $solver = $uf->name;
        }
    }
?>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-pencil"></i> Edit Task
        <small>old task</small>
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
                    
                    <form role="form" id="updateTask" action="<?php echo base_url() ?>updateTask" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fsubject">Task ID</label>
                                        <input type="text" class="form-control required" id="fsubject" value="<?php echo $taskId; ?>" name="fsubject" maxlength="255" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fsubject">Subject</label>
                                        <input type="text" class="form-control required" id="fsubject" value="<?php echo $subject; ?>" name="fsubject" maxlength="255">
                                    </div>
                                    <div class="form-group">
                                        <!--<label for="dueDate">Due date</label>
                                        <input type="text" class="form-control required" id="dueDate"  name="dueDate">-->

                                        <label class="control-label" for="date">Due date</label>
                                        <div id="datetimepicker4" class="input-group input-append">
                                            <input class="form-control datevalue required" id="dueDate" name="dueDate" value="<?php echo $dueDate; ?>" data-format="yyyy-MM-dd" type="text" placeholder="yyyy-MM-dd"></input>
                                            <span class="add-on datepicker-icon-background">
                                                <i class="datepicker-icon-style" data-time-icon="icon-time" data-date-icon="icon-calendar fa fa-calendar">
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="solver">Solver</label>
                                        <select class="form-control required" id="solver" name="solver">
                                            <option value="<?php echo $userId ?>"><?php echo $solver ?></option>
                                            <?php
                                                if(!empty($solvers)) {
                                                    foreach ($solvers as $solver) {
                                            ?>
                                            <option value="<?php echo $solver->userId ?>"><?php echo $solver->name." -> ".$solver->role ?></option>
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
                                        <textarea class="form-control required" id="fdes" name="fdes" maxlength="255" style="height: 181px"><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <!--<input type="reset" class="btn btn-default" value="Reset" />-->
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

<script src="<?php echo base_url(); ?>assets/js/editTask.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            $('#datetimepicker4').datetimepicker({
                pickTime: false
                });
            }).on('changeDate', function (e) {
                // self.xtag.validation && self.validate();
                $('#datetimepicker4').datetimepicker('hide');
            });
    });
</script>