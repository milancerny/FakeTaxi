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
            <i class="fa fa-users"></i> User Management
            <small>Add, Edit, Delete</small>
        </h1>
    </section>
    <a class="btn btn-primary" href="<?php echo base_url(); ?>profilePicture"><i class="fa fa-plus"></i> Update</a>
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





                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $record->email ?></td>
                                    </tr>
                                    <td>Phone Number</td>
                                    <td><?php echo $record->mobile ?>
                                    </td>

                                    </tr>

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


