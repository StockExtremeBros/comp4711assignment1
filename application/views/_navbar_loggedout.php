<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">{pagetitle}</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/">Home</a></li>
      <li><a href="/stockhistory">Stock History</a></li>
      <li><a href="/profiles">Profile</a></li>
    </ul>
    <form class="navbar-form navbar-right ajax-form" role="forms" action="index.php/forms/login" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default" id="login-btn">Sign in</button>
    </form>
  </div>
</nav>