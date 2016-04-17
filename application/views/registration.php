<form class="form col-sm-offset-4 col-xs-4" action='../register/register' method="POST"
      style="float:none; padding-top: 30px; padding-bottom: 30px;">
    <div id="legend">
      <legend>Register</legend>
    </div>
    <fieldset class="form-group">
        <label class="form-control-label"  for="username">Username</label>
        <input type="text" placeholder="Minimum 5 characters" id="username" name="username" class="form-control">
        <p class="help-block"></p>
    </fieldset>
    <fieldset class="form-group">
        <label class="form-control-label" for="password">Password</label>
        <input type="password" placeholder="Minimum 5 characters" id="password" name="password" class="form-control">
        <p class="help-block"></p>
    </fieldset>
    <fieldset class="form-group">
        <label class="form-control-label" for="password-confirm">Password (Confirm)</label>
        <input type="password" id="password-confirm" name="password-confirm" class="form-control">
        <p class="help-block"></p>
    </fieldset>
    <fieldset class="form-group">
        <button type="submit" class="btn" id="btn-submit" disabled>Register</button>
    </fieldset>
</form>