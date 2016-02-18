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
    <form class="navbar-form navbar-right ajax-form" role="forms" action="index.php/forms/logout" method="post">
        <label class="text-muted">User: <?php echo $_SESSION['current_user']?>&nbsp;&nbsp;&nbsp;</label>
        <button type="submit" class="btn btn-default" id="logout-btn">Sign out</button>
    </form>
  </div>
</nav>