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
            <div class="col-md-4 col-md-offset-1 task-box">
                <button type="button" class="close" aria-label="Close" title="Delete task">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
                <?php foreach($xx as $record) {
                        echo $record->subject;
                        echo $record->description;
                        echo $record->dueDate;
                    }
                 ?>
                <h3 class="inline"><i class="fa fa-paperclip" aria-hidden="true"></i> Subject of Task</h3>
                <p class="inline pull-right">Due date: <small>21.04.2017</small></p>
                <hr class="task">
                <p>
                    Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum je štandardným výplňovým textom už
                    od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových znakov a pomiešal ich, aby tak
                    vytvoril vzorkovú knihu. Prežil nielen päť storočí, ale aj skok do elektronickej sadzby, a pritom zostal
                    v podstate nezmenený. Spopularizovaný bol v 60-tych rokoch 20.storočia, vydaním hárkov Letraset, ktoré
                    obsahovali pasáže Lorem Ipsum, a neskôr aj publikačným softvérom ako Aldus PageMaker, ktorý obsahoval
                    verzie Lorem Ipsum. Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum
                    je štandardným výplňovým textom už od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových
                    znakov a pomiešal ich, aby tak vytvoril vzorkovú knihu. Prežil nielen päť storočí, ale aj skok do elektronickej
                    sadzby, a pritom zostal v podstate nezmenený. Spopularizovaný bol v 60-tych rokoch 20.storočia, vydaním
                    hárkov Letraset, ktoré obsahovali pasáže Lorem Ipsum, a neskôr aj publikačným softvérom ako Aldus PageMaker,
                    ktorý obsahoval verzie Lorem Ipsum.
                </p>
                <br>
                <div>
                    <a class="btn btn-success btn-lg" href="#">Success</a>
                </div>
            </div>

            <div class="col-md-4 col-md-offset-1 task-box">
                <button type="button" class="close" aria-label="Close" title="Delete task">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
                <h3 class="inline"><i class="fa fa-paperclip" aria-hidden="true"></i> Subject of Task</h3>
                <p class="inline pull-right">Due date: <small>21.04.2017</small></p>
                <hr class="task">
                <p>
                    Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum je štandardným výplňovým textom už
                    od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových znakov a pomiešal ich, aby tak
                    vytvoril vzorkovú knihu. Prežil nielen päť storočí, ale aj skok do elektronickej sadzby, a pritom zostal
                    v podstate nezmenený. Spopularizovaný bol v 60-tych rokoch 20.storočia, vydaním hárkov Letraset, ktoré
                    obsahovali pasáže Lorem Ipsum, a neskôr aj publikačným softvérom ako Aldus PageMaker, ktorý obsahoval
                    verzie Lorem Ipsum. Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum
                    je štandardným výplňovým textom už od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových
                    znakov a pomiešal ich, aby tak vytvoril vzorkovú knihu. Prežil nielen päť storočí, ale aj skok do elektronickej
                    sadzby, a pritom zostal v podstate nezmenený. Spopularizovaný bol v 60-tych rokoch 20.storočia, vydaním
                    hárkov Letraset, ktoré obsahovali pasáže Lorem Ipsum, a neskôr aj publikačným softvérom ako Aldus PageMaker,
                    ktorý obsahoval verzie Lorem Ipsum.
                </p>
                <br>
                <div>
                    <a class="btn btn-success btn-lg" href="#">Success</a>

                    <!--<a class="btn btn-danger btn-sm inline pull-right" href="#">Delete</a>-->
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>