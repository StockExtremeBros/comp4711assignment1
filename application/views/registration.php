<br><form class="form-horizontal" action='../register/register' method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Register</legend>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
        <span class="help-inline"></span>
      </div>
    </div>
 
    <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
        <span class="help-inline"></span>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <p class="help-block">Minimum 5 characters</p>
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
        <span class="help-inline"></span>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password -->
      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="controls">
        <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
        <span class="help-inline"></span>
      </div>
    </div>
    <br>
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
          <button type="submit" class="btn btn-success" id="btn-submit">Register</button>
      </div>
    </div>
  </fieldset>
</form><br>
