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
    <form class="navbar-form navbar-right" role="forms/login" action="login" method="post">
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