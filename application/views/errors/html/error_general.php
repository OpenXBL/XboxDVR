<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$title = 'Error';
$this->config = get_instance()->config;
$this->session = get_instance()->session;
?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include VIEWPATH.'partials/_meta.php'; ?>
</head>
<body>
	<?php include VIEWPATH.'partials/_header.php'; ?>

    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading"><strong>Status <?php echo $status_code; ?></strong><br><?php echo $heading; ?></h1>
        <p class="lead text-muted"><?php echo $message; ?></p>
        <p>
          <a href="<?php echo site_url(); ?>">Go back and try again.</a>
        </p>
      </div>
    </section>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="<?php echo asset_url("js/bootstrap.js"); ?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo asset_url("js/ie10-viewport-bug-workaround.js"); ?>"></script>
  </body>
</html>
