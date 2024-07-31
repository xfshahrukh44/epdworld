<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('focus_keyword', 'Focus keyword') !!}
                {!! Form::text('focus_keyword', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('canonical_tag_href', 'Canonical tag url') !!}
                {!! Form::text('canonical_tag_href', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('meta_title', 'Meta title') !!}
                {!! Form::text('meta_title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('meta_descriptoion', 'Meta description') !!}
                {!! Form::textarea('meta_descriptoion', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor', 'required' => 'required'] : ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('detail', 'Content') !!}
                {!! Form::textarea('detail', null, ('required' == 'required') ? ['class' => 'form-control', 'id' => 'summary-ckeditor1', 'required' => 'required'] : ['class' => 'form-control']) !!}
            </div>
        </div>

{{--        <div class="col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::label('image', 'Image') !!}--}}
{{--                <input class="form-control dropify" name="image" type="file" id="image" {{ ($blog->image != '') ? "data-default-file = /$blog->image" : ''}} {{ ($blog->image == '') ? "required" : ''}} value="{{$blog->image}}">--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>

<div class="form-actions text-right pb-0">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
