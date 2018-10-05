<!-- Division Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('division_id', 'Division Id:') !!}
    {!! Form::select('division_id', $isidivisi->pluck('nama', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Departmen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('departmen', 'Departmen:') !!}
    {!! Form::text('departmen', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('masterDepartmens.index') !!}" class="btn btn-default">Cancel</a>
</div>
