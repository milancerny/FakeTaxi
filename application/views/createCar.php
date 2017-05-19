<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-pencil"></i> Create New Car
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
                        <h3 class="box-title">Enter Car Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="createCar" action="<?php echo base_url() ?>createNewCar" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="carType">Car Type <small class="redStar">*</small></label>
                                        <select class="form-control required" id="carType" name="carType">
                                            <!--<option value="0">Select Car Type</option>-->
                                            <?php
                                                if(!empty($carTypes)) {
                                                    foreach ($carTypes as $t) {
                                            ?>
                                            <option value="<?php echo $t->id ?>"><?php echo $t->type ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <p><small>Master type of vehical</small></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="carSubType">Car Sub Type <small class="redStar">*</small></label>
                                        <select class="form-control required" id="carSubType" name="carSubType">
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ecv">EČV <small class="redStar">*</small></label>
                                        <input type="text" class="form-control required" placeholder="XX-NNNLL" id="ecv" name="ecv" maxlength="8" style="text-transform:uppercase">
                                        <p><small>Licence plate</small></p>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vin">VIN <small class="redStar">*</small></label>
                                        <input type="text" class="form-control required" placeholder="XX-NNNLL" id="vin" name="vin" maxlength="17" style="text-transform:uppercase">
                                        <p><small>Vehicle identification number</small></p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="driver">Driver <small class="redStar">*</small></label>
                                        <select class="form-control required" id="driver" name="driver">
                                            <!--<option value="0">Select Solver</option>-->
                                            <?php
                                                if(!empty($drivers)) {
                                                    foreach ($drivers as $driver) {
                                            ?>
                                            <option value="<?php echo $driver->userId ?>"><?php echo $driver->name ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="totalKm">KM <small class="redStar">*</small></label>
                                        <input type="number" class="form-control required" placeholder="999999" id="totalKm" name="totalKm">
                                        <p><small>Total count of km</small></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="color">Color <small class="redStar">*</small></label>
                                        <input type="text" class="form-control required" id="color" name="color">
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
            <!-- TITLE PANE -->
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
        </div>    
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/createTask.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var carSubTypes = JSON.parse('<?php echo json_encode($carSubTypes) ?>');

        $("#carType").focus(); // after load screen focus first element

        if($('.alert').is(":visible")) {
            $('.alert').delay(5000).fadeOut(300); 
        }

        /* Filter for Sub Type Cars */
        var carTypeId = "";
        $("#carType").change(function () {
            $("#carSubType").empty();
            $("select#carType option:selected").each(function() {
                carTypeId = $(this).attr('value');
            });
            var filtered = carSubTypes.filter(function(obj) {
                return obj.carTypeId == carTypeId;
            });

            var subTypeCombo = $("#carSubType");
            for(var i = 0; i < filtered.length; i++) { 
                var option = document.createElement('option');
                option.innerHTML = filtered[i].subType;
                option.value = filtered[i].carTypeId;
                subTypeCombo.append(option);          
            }
        }).change();
    });
</script>