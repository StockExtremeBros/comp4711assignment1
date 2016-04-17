<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">{pagetitle}</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/">Home</a></li>
      <li><a href="/stockhistory">Stock History</a></li>
      <li><a href="/profiles">Profile</a></li>
      <li><a href="/editusers">Edit Users</a></li>
    </ul>
    <form class="navbar-form navbar-right ajax-form" role="forms" action="../forms/logout" method="post">
        <img class="avatar-img-navbar" alt="{avatar_image}" src="{avatar_path}"/>
        <label class="text-muted">User: {current_user}&nbsp;&nbsp;&nbsp;</label>
        <button type="submit" class="btn btn-default" id="logout-btn">Sign out</button>
    </form>
  </div>
</nav>