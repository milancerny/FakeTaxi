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
            <div class="col-xs-12 text-left">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>createTask"><i class="fa fa-plus"></i> Create New Task</a>
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
                      <th>Id</th>
                      <th>Solver</th>
                      <th>Subject</th>
                      <th>Description</th>
                      <th>Due date</th>
                      <th>Completed</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($taskData))
                    {
                        foreach($taskData as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $record->taskId ?></td>
                      <td style="width: 115px;"><?php echo $record->name ?></td>
                      <td style="width: 215px;"><?php echo $record->subject ?></td>
                      <td><?php echo $record->description ?></td>
                      <td style="width: 105px;"><?php echo $record->dueDate ?></td>
                      <td style="text-align: center"><?php echo $record->isCompleted ?></td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'editOld/'.$record->taskId; ?>"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->taskId; ?>"><i class="fa fa-trash"></i></a>
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
</script>