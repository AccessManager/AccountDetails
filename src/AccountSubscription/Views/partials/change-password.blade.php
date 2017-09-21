 <div class="row">
    <div class="col-md-4 col-md-offset-3">
        <p class="text-primary pull-left">
            Change Password
        </p>
        <div class="form-group">
            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'new password']) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>'confirm password']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-3">
        <div class="form-group">
            <input type="submit" class="form-control btn btn-flat btn-block btn-primary bg-light-blue-gradient">
        </div>
    </div>
</div>