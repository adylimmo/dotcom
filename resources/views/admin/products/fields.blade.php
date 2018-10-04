<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control rte']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    <div id="image-thumb">
        <img src="dummy-image.jpg" style="width:100%">
    </div>
    <div class="input-group">
        {!! Form::text('image', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        <div class="input-group-btn">
            <a href="{!! url('assets/dialog?filter=all&appendId=image') !!}" class="btn btn-primary filemanager fancybox.iframe" data-fancybox-type="iframe">Choose File</a>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.products.index') !!}" class="btn btn-default">Cancel</a>
</div>
