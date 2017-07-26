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

        <h1 class="jumbotron-heading">Migration Success.</h1>

        <p class="lead">For your security disable migrations in '/application/config/migration.php'</p>

      </div>

    </section>

    <?php $this->load->view('partials/_footer'); ?>

  </body>

</html>
