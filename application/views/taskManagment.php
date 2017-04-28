<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-pencil"></i> Task managment
            <small>create, update, delete</small>
        </h1>
    </section>
    <br>
    <section class="content">
        <div class="row">
            <div class="col-xs-8 text-left">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>createTask"><i class="fa fa-plus"></i> Create New Task</a>
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
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tasks List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList" style="height: 30px;">
                                    <i class="fa fa-search"></i>
                                </button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th class="text-center" style="width: 100px;">Completed</th>
                      <th>Id</th>
                      <th style="width: 115px;">Solver</th>
                      <th style="width: 215px;">Subject</th>
                      <th>Description</th>
                      <th style="width: 105px;">Due date</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($taskData))
                    {
                        foreach($taskData as $record)
                        {
                    ?>
                    <tr>
                      <td style="text-align: center">
                      <?php if ($record->isCompleted == 0){ ?>
                          <i class="fa fa-times color-darkred"></i>
                      <?php } else { ?>
                          <i class="fa fa-check color-green"></i>
                      <?php } ?></td>

                      <td><?php echo $record->taskId ?></td>
                      <td><?php echo $record->name ?></td>
                      <td><?php echo htmlspecialchars($record->subject, ENT_QUOTES, 'UTF-8'); ?></td>
                      <td style="white-space: pre-wrap;"><?php echo htmlspecialchars($record->description, ENT_QUOTES, 'UTF-8'); ?></td>
                      <td><?php echo $record->dueDate ?></td>
                      <td class="text-center">
                          <?php if ($record->isCompleted == 0){ ?>
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'loadOldTask/'.$record->taskId; ?>">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <?php } ?>
                          <?php if($role == ROLE_ADMIN) { ?>
                          <a class="btn btn-sm btn-danger deleteTask" href="#" data-toggle="modal" data-taskid="<?php echo $record->taskId; ?>"><i class="fa fa-trash"></i></a>
                          <?php } ?>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>

            

        </div>
    </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Task</h4>
      </div>
      <div class="modal-body">
        <p>This task will permanently deleted.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deleteBtn">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;
            console.log(link);        
            var value = link.substring(link.lastIndexOf('/') + 1);
            console.log(value);   

            jQuery("#searchList").attr("action", baseURL + "taskManagment/" + value);
            jQuery("#searchList").submit();
        });
    });

    /* Set icon when task complete */
</script>