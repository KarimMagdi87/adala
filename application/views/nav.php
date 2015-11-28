<nav class="navbar navbar-default">
    <div class="container-fluid">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

            <ul class="nav navbar-nav navbar-right">

                <?php foreach($rowsTopicTypes as $r): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $r->name; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                             <?php
                                 foreach($rowsDocumentType as $sr):
                                 if($r->topictypeid == $sr->topictypeid ):
                             ?>
                                 <li><a data-value="<?php echo $sr->documenttypeid; ?>" class="documenttype" id="<?php echo $sr->topictypeid; ?>" href="#"><?php echo $sr->name; ?></a></li>
                             <?php
                                 endif;
                                 endforeach;
                             ?>
                        </ul>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>