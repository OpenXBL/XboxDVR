<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">

<head>

    <?php $this->load->view('partials/_meta'); ?>

</head>

<body>

    <?php $this->load->view('partials/_header'); ?>

    <section class="jumbotron text-center" style="padding:0;background-color:#191919;">

        <div class="container" style="padding:0;">

                <?php if($media->media_type == 'video') { ?>

                  <video id="videojs" class="video-js vjs-default-skin" style="" controls preload="auto" height="400"
                  poster="" data-setup="{}">

                    <source src="<?php echo base_url() . 'uploads/media/' . $media->media_id . '.mp4'; ?>" type='video/mp4'>

                    <p class="vjs-no-js">
                      To view this video please enable JavaScript, and consider upgrading to a web browser that
                      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>

                  </video>

                <?php } else { ?>

                  <img src="<?php echo base_url() . 'uploads/media/' . $media->media_id . '.png'; ?>" style="height:400px;" />

                <?php } ?>

        </div>

    </section>

    <div class="album text-muted">

      <div class="container">

        <div class="row">

          <p><?php echo $media->gamertag; ?> on <?php echo $media->name; ?></p>

        </div>

        <div class="row">

          <p><i><?php echo $media->title; ?></i></p>
      
        </div>

        <div class="row">

          <p>Shared at <i><?php echo $media->shared_at; ?></i></p>
      
        </div>

        <div class="row">

          <p><?php echo $media->description; ?></p>
      
        </div>

        <div class="row">

          <button class="btn btn-secondary btn-sm copy" type="button"  data-clipboard-text="<?php echo base_url() . 'uploads/media/' . $media->media_id . (($media->media_type=='video')?'.mp4':'.png'); ?>">Copy to Clipboard</button>

        </div>


      </div>

    </div>

    <?php $this->load->view('partials/_footer'); ?>

  </body>
</html>