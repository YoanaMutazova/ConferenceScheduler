<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"/>

<style>
.form-horizontal{
  width: 50%;
}

.form-control{
    width: 300px;
}
</style>

<h1>Register</h1>
<form class="form-horizontal" method="post">
  <fieldset>
    <div class="form-group">
      <label for="username" class="col-lg-2 control-label">Username</label>
      <div class="col-lg-10">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <label for="confirmPassword" class="col-lg-2 control-label">Confirm Password</label>
      <div class="col-lg-10">
          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
          <button type="reset" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-primary" name="submit">Register</button>
      </div>
    </div>
  </fieldset>
</form>

<a href="/ConferenceScheduler/public/home">Home</a>
