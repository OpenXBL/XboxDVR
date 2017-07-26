<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">

<head>

    <?php $this->load->view('partials/_meta'); ?>

</head>

<body>

	<?php $this->load->view('partials/_header'); ?>

    <section class="jumbotron text-center">

      <div class="container">

        <h1 class="jumbotron-heading">Browse By Game</h1>

        <p class="lead">Share something great&trade;</p>

      </div>

    </section>

    <div class="album text-muted">

      <div class="container">

        <div class="row">

          <?php foreach($titles as $title) { ?>

              <div class="card">

                <div>

                  <p class="card-text" style="display: inline;"><a href="<?php echo base_url(); ?>browse/<?php echo $title->title_id; ?>" class="btn btn-secondary btn-block"><?php echo $title->name; ?></a></p>

              </div>

            </div>

          <?php } ?>

        </div>

      </div>

    </div>

    <?php $this->load->view('partials/_footer'); ?>

  </body>

</html>