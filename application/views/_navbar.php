<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">{pagetitle}</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#">Home</a></li>
      <li><a href="#">Stock History</a></li>
      <li><a href="#">Portfolio</a></li>
    </ul>
    <?php echo form_open('/auth_user'); ?>
    <?php
    echo "<div class='error_msg'>";
    if (isset($error_message)) {
        echo $error_message;
    }
    echo validation_errors();
    echo "</div>";
    ?>
    <input type="text" name="username" id="name" placeholder="username"/>
    <input type="password" name="password" id="password" placeholder="**********"/>
    <input type="submit" value=" Login " name="submit"/>
    <?php echo form_close(); ?>
  </div>
</nav>