<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="summary-ckeditor">Parent</label>

                    <select class="form-control select2" name="parent" id="parent" required>
                        <option disabled selected value="0">Select Parent</option>
                        @php
                            $cat = App\Category::all();
                        @endphp

                        @foreach ($cat as $cats)
                            <option {{ ($cats->id == $category->parent) ? 'selected' : '' }} value="{!! $cats->id !!}">{!! $cats->name !!}</option>
                        @endforeach




                    </select>
              </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
            	{!! Form::label('name', 'Name') !!}
            	{!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            </div>
        </div>

   </div>
</div>
<div class="form-actions text-right pb-0">
	{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
<div class="form-group row justify-content-center left_css col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">

    <div class="col-md-12">

        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
