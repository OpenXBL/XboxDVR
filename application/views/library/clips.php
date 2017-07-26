<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>

<html lang="en">

<head>

    <?php $this->load->view('partials/_meta'); ?>

    <link href="<?php echo asset_url("css/library.css"); ?>" rel="stylesheet">

</head>

<body>

    <?php $this->load->view('partials/_header'); ?>

    <section class="jumbotron text-center">

      <div class="container">

        <h1 class="jumbotron-heading"><?php echo $this->session->userdata('openxbl')['gamertag']; ?></h1>

        <p class="lead text-muted">Your Media Library</p>

      </div>

    </section>

    <div class="album text-muted">

      <div class="container">

        <div class="row">
          
          <p style="margin: 0 auto; margin-bottom: 15px;"><i>This is your private library. To become internet famous hover over the media and click "share."</i></p>

        </div>

        <div class="row">

          <div class="btn-toolbar" role="toolbar" style="margin: 0 auto; padding: 15px;">

            <div class="btn-group mr-2" role="group">

              <a href="<?php echo base_url(); ?>library/clips" class="btn btn-primary">Game Clips</a>

            </div>

            <div class="btn-group mr-2" role="group">

              <a href="<?php echo base_url(); ?>library/screenshots" class="btn btn-secondary">Screenshots</a>

            </div>

            <div class="btn-group mr-3" role="group">

              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#helpModal">

                <span class="fa fa-question"></span>

              </button>

            </div>

          </div>

        </div>

        <div class="row" id="media-data">

          <p class="loading">Retrieving your DVR content... Thank you for your patience.</p>

        </div>

      </div>

    </div>

    <?php $this->load->view('partials/_help'); ?>

    <?php $this->load->view('partials/_share'); ?>

    <?php $this->load->view('partials/_footer'); ?>

    <script src="<?php echo asset_url("js/library.video.js"); ?>"></script>

  </body>

</html>