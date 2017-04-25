<?php
/**
 * Created by PhpStorm.
 * User: PazitnyJan
 * Date: 21.4.2017
 * Time: 22:43
 */?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Profile Picture Management
            <small>Update profile picture</small>
        </h1>
    </section>

    <section class="content">
        <?php
        if(!empty($profile))
        {
        foreach($profile as $record)
        {
        ?>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $record->name ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="upload/image/<?php echo $record->pictureProfile ?>" class="img-circle img-responsive"> </div>

                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>

                                    <?php echo $this->session->flashdata('success_msg'); ?>
                                    <?php echo $this->session->flashdata('error_msg'); ?>

                                    <form role="form" method="post" enctype="multipart/form-data">
                                        <div class="panel">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label>Choose picture</label>
                                                    <input class="form-control" type="file" name="picture" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-warning" name="userSubmit" value="Update profile picture">
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>


                </div>
            <?php
        }
        }
        ?>
    </section>
</div>


