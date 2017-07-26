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

        <h1 class="jumbotron-heading">Our Policy</h1>

        <p class="lead">Last updated 07.24.2017</p>

      </div>

    </section>

    <div class="album text-muted">

      <div class="container">

        <h2 class="heading">Xbox Live</h2>

        <p class="lead">Our website uses Xbox Live to verify your identity and pull DVR content. No local user account is stored.</p>

        <h2 class="heading">Sharing media</h2>

        <p class="lead">Our website admins have the right to remove any media we see fit. We reserve the right to ban your account from accessing our services without cause.</p>

        <h2 class="heading">Misc.</h2>

        <p class="lead">Thank you for taking the time to read our policies.</p>

      </div>

    </div>

    <?php $this->load->view('partials/_footer'); ?>

  </body>

</html>
