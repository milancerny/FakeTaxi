<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-car"></i> Cars Managment
            <small>create, update, delete</small>
        </h1>
    </section>
    <br>
    <section class="content">
        <div class="row">
            <div class="col-xs-8 text-left">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>createCar"><i class="fa fa-plus"></i> Create New Car</a>
                </div>
            </div>
            <!-- TITLEPANE -->
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success) {
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
            <!-- /TITLEPANE -->
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cars List</h3>
                    <div class="box-tools" style="visibility: hidden;">
                        <form action="<?php echo base_url() ?>taskManagment" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="hidden" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
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
                      <!--<th class="text-center" style="width: 6%;">Completed</th>-->
                      <th style="width: 3%;">#</th>
                      <th style="width: 16.33%;">Car Type</th>
                      <th style="width: 16.33%;">Car SubType</th>
                      <th style="width: 16.33%;">EČV</th>
                      <th style="width: 16.33%;">VIN</th>
                      <th style="width: 16.33%;">Owner</th>
                      <th style="width: 8%;">KM</th>
                      <th class="text-center" style="width: 0%;">Action</th>
                    </tr>
                    <?php
                    if(!empty($carsData)) {
                        foreach($carsData as $record) {
                    ?>
                    <tr>

                      <td><?php echo $record->id ?></td>
                      <td><?php echo $record->type ?></td>
                      <td><?php echo $record->subType ?></td>
                      <td><?php echo $record->ECV ?></td>
                      <td><?php echo $record->VIN ?></td>
                      <td><?php echo $record->name ?></td>
                      <td><?php echo number_format($record->totalCountKm, 0, '', ' ') ?></td>
                      <td class="text-center">
                          
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'loadOldTask/'.$record->id; ?>">
                            <i class="fa fa-pencil"></i>
                          </a>

                          <?php if($role == ROLE_ADMIN) { ?>
                            <a class="btn btn-sm btn-danger deleteCar" href="#" data-toggle="modal" data-id="<?php echo $record->id; ?>">
                                <i class="fa fa-trash"></i>
                            </a>
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

<div class="modal fade" tabindex="-1" role="dialog" id="myModalCar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Car</h4>
      </div>
      <div class="modal-body">
        <p>This car will permanently deleted.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deleteCarBtn">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        if($('.alert').is(":visible")) {
            $('.alert').delay(5000).fadeOut(300); 
        }
        
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;
            console.log(link);        
            var value = link.substring(link.lastIndexOf('/') + 1);
            console.log(value);   

            jQuery("#searchList").attr("action", baseURL + "carsManagment/" + value);
            jQuery("#searchList").submit();
        });
    });

    /* Set icon when task complete */
</script>