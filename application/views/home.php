<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">

<head>

    <?php $this->load->view('partials/_meta'); ?>

    <link href="<?php echo asset_url("css/home.css"); ?>" rel="stylesheet">

</head>

<body>

    <?php $this->load->view('partials/_header'); ?>

    <section class="jumbotron text-center" style="min-height:400px;">

        <video id="my-video" class="video" muted loop>

          <source src="<?php echo base_url() . 'assets/images/hero.mp4'; ?>" type="video/mp4">

        </video>

      <div class="container">

        <h1 class="jumbotron-heading"><?php echo $this->config->item('title'); ?></h1>

        <p class="lead">Share something great&trade;</p>

        <p>

          <?php if( isAuth() ) { ?>

              <a href="<?php echo base_url(); ?>library" class="btn btn-primary">View Your Library</a>

              <a href="<?php echo base_url(); ?>showcase" class="btn btn-secondary">View Showcase</a>

          <?php } else { ?>

            <form action="https://xbl.io/app/auth/<?php echo $this->config->item('xblio_key'); ?>">

              <button type="submit" class="btn btn-primary" id="login">Log in with Xbox Live</button>

            </form>

          <?php } ?>

        </p>

      </div>

    </section>
    <div class="album text-muted">

      <div class="container">

        <div class="row">

            <h3 class="header">10 Latest Shares</h3>

        </div>

        <div class="row">

          <?php foreach($media as $item) { ?>

              <div class="card">

                <img class="thumbnail" src="<?php echo base_url() . 'uploads/thumbnail/' . $item->media_id . '.png'  ; ?>" alt="">

                <div>

                  <p class="card-text" style="display: inline;"><?php echo $item->gamertag . ' - ' . $item->title; ?></p>

                  <div class="dropdown" style="float:right;padding-right: 12px;">

                    <span class="fa fa-ellipsis-h" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                      <button class="dropdown-item copy" type="button"  data-clipboard-text="<?php echo base_url() . 'uploads/media/' . $item->media_id . (($item->media_type=='video')?'.mp4':'.png'); ?>">Copy to Clipboard</button>

                    </div>

                  </div>

              </div>

              <div class="overlay">

                <div class="btn btn-secondary" style="margin-top: 25px;opacity: 0.4;">

                  <a href="<?php echo base_url() . 'showcase/' . $item->share_id; ?>">

                    <span class="fa fa-xblio <?php echo ($item->media_type=='video')?'fa-video-camera':'fa-camera'; ?>"></span>

                  </a>

                </div>

              </div>

            </div>

          <?php } ?>

        </div>

      </div>

    </div>

    <?php $this->load->view('partials/_footer'); ?>

    <script src="<?php echo asset_url("js/home.js"); ?>"></script>

  </body>

</html>