<div class="collapse bg-inverse" id="navbarHeader">

  <div class="container">

    <div class="row">

      <div class="col-sm-8 py-4">

        <h4 class="text-white">About</h4>

        <p class="text-muted"><?php echo $this->config->item('description'); ?></p>

      </div>

      <div class="col-sm-4 py-4">

        <h4 class="text-white">

          <?php if( isAuth() ) { ?>

            <?php echo $this->session->userdata('openxbl')['gamertag']; ?>

          <?php } else { ?>

            Links

          <?php } ?>  
          
        </h4>

        <ul class="list-unstyled">

          <?php if( isAuth() ) { ?>

            <li><a href="<?php echo base_url(); ?>library" class="text-white">View Your Library</a></li>

          <?php } ?>  

          <li><a href="<?php echo base_url(); ?>showcase" class="text-white">View Showcase</a></li>

          <li><a href="<?php echo base_url(); ?>browse" class="text-white">Browse By Game</a></li>

          <li><a href="https://github.com/regimbal93" target="_blank" class="text-white">Fork on GitHub</a></li>

        </ul>

        <?php if( isAuth() ) { ?>

          <a href="<?php echo base_url(); ?>auth/logout" class="btn btn-danger btn-sm">Logout</a>

        <?php } else { ?>

          <a href="https://xbl.io/app/auth/<?php echo $this->config->item('xblio_key'); ?>" class="btn btn-primary btn-sm">Login with Xbox Live</a>

        <?php } ?>  

      </div>

    </div>

  </div>

</div>



<div class="navbar navbar-inverse bg-inverse">

  <div class="container d-flex justify-content-between">

    <a href="<?php echo site_url(); ?>" class="navbar-brand"><?php echo $this->config->item('title'); ?></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">

      <span class="navbar-toggler-icon"></span>

    </button>

  </div>

</div>