<?php require_once '../app/views/templates/header.php' ?>

<div class="col">
    <form class="form-horizontal"
          action="<?=UPDATE_PROFILE?>"
          method="post">
        <div class="row">
            <label class="col-sm-4 control-label">Password</label>
            <div class="col-sm-8">
                <input type="password"
                       name="password"
                       value="<?=$data->password?>"
                       class="form-control"/>
            </div>
        </div>
        
        <div class="row">
            <label class="col-sm-4 control-label">First Name</label>
            <div class="col-sm-8">
                <input type="text"
                       name="firstname"
                       value="<?=$data->firstname?>"
                       class="form-control"/>
            </div>
        </div>
        
        <div class="row">
            <label class="col-sm-4 control-label">Last Name</label>
            <div class="col-sm-8">
                <input type="text"
                       name="lastname"
                       value="<?=$data->lastname?>"
                       class="form-control"/>
            </div>
        </div>
        
        <div class="row">
            <label class="col-sm-4 control-label">DOB</label>
            <div class="col-sm-8">
                <input type="date"
                       name="dob"
                       class="form-control"
                       value="<?=$data->dob?>"/>
            </div>
        </div>
        
        <div class="row">
            <label class="col-sm-4 control-label">Phone</label>
            <div class="col-sm-8">
                <input type="text"
                       name="phone"
                       value="<?=$data->phone?>"
                       class="form-control"/>
            </div>
        </div>
        
        <div class="row">
            <label class="col-sm-4 control-label">Email</label>
            <div class="col-sm-8">
                <input type="email"
                       name="email"
                       value="<?=$data->email?>"
                       class="form-control"/>
            </div>
        </div>
        
        <div class="row">
            <label class="col-sm-4"></label>
            <div class="col-sm-8">
                <input type="submit" 
                       value="Save"
                       class="btn btn-primary"/>
            </div>
        </div>
    </form>
</div>

<?php require_once '../app/views/templates/footer.php' ?>