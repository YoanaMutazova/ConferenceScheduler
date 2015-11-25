<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"/>

<style>
.form-horizontal{
  width: 50%;
}

.form-control{
    width: 300px;
}
</style>

<h1>Create event</h1>
<form class="form-horizontal" method="post">
  <fieldset>
    <div class="form-group">
      <label for="description" class="col-lg-2 control-label">Description</label>
      <div class="col-lg-10">
          <input type="text" class="form-control" id="description" name="description" placeholder="Description">
      </div>
    </div>
    <div class="form-group">
      <label for="start" class="col-lg-2 control-label">Start</label>
      <div class="col-lg-10">
          <input type="text" class="form-control" id="start" name="start" placeholder="Start">
      </div>
    </div>
    <div class="form-group">
      <label for="end" class="col-lg-2 control-label">End</label>
      <div class="col-lg-10">
          <input type="text" class="form-control" id="end" name="end" placeholder="End">
      </div>
    </div>
    <div class="form-group">
      <label for="speaker" class="col-lg-2 control-label">Speaker</label>
      <div class="col-lg-10">
          <input type="text" class="form-control" id="speaker" name="speaker" placeholder="Speaker username">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
          <button type="reset" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>
    </div>
  </fieldset>
</form>