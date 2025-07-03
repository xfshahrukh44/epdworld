<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::Label('item', 'Select Category:') !!}
                {!! Form::select('item_id', $items, isset($product) ? $product->category : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('product_title', 'Product Title') !!}
                {!! Form::text(
                    'product_title',
                    null,
                    'required' == 'required' ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control'],
                ) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('slug', 'Product Slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('price', 'Price') !!}
                {!! Form::text(
                    'price',
                    null,
                    'required' == 'required' ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control'],
                ) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('sku', 'SKU') !!}
                {!! Form::text('sku', isset($product) ? $product->sku : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('item_number', 'Item number') !!}
                {!! Form::text('item_number', isset($product) ? $product->item_number : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea(
                    'description',
                    null,
                    'required' == 'required'
                        ? ['class' => 'form-control', 'id' => 'summary-ckeditor', 'required' => 'required']
                        : ['class' => 'form-control'],
                ) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('image', 'Image') !!}
                <input class="form-control dropify" name="image" type="file" id="image"
                    {{ $product->image != '' ? "data-default-file = /$product->image" : '' }}
                    {{ $product->image == '' ? 'required' : '' }} value="{{ $product->image }}">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {!! Form::label('additional_image', 'Gallary Image') !!}
                <div class="gallery Images">
                    @foreach ($product_images as $product_image)
                        <div class="image-single">
                            <img src="{{ asset($product_image->image) }}" alt="" id="image_id">
                            <button type="button" class="btn btn-danger" data-repeater-delete=""
                                onclick="getInputValue({{ $product_image->id }}, this);"> <i
                                    class="ft-x"></i>Delete</button>
                        </div>
                    @endforeach
                </div>
                <input class="form-control dropify" name="images[]" type="file" id="images"
                    {{ $product->additional_image != '' ? "data-default-file = /$product->additional_image" : '' }}
                    value="{{ $product->additional_image }}" multiple>
            </div>
        </div>
        <div class="col-md-12">
            <h4 class="card-title" id="repeat-form">Add Variation</h4>
        </div>

        {{-- <div id="variationsWrapper">
            <select class="form-control multiSelect" name="attribute_id[]" multiple>
                @foreach ($att as $attribute)
                    <option value="{{ $attribute->id }}" data-values='@json($attribute->values)'>
                        <!-- pass attribute values as JSON -->
                        {{ $attribute->name }}
                    </option>
                @endforeach
            </select>

           <div id="attributeValuesContainer" class="d-flex flex-wrap gap-2 mt-3"></div>

        </div> --}}

        {{-- <!-- Existing wrapper -->
        <div id="variationsWrapper">
            <!-- Container where all blocks will be added -->
            <div id="allVariationBlocks">
                <!-- Initial variation will be added via JS -->
            </div>

            <!-- Add variation button -->
            <button type="button" id="addVariationBtn" class="btn btn-primary mt-3">Add Variation</button>
        </div>

        <!-- Hidden template (not displayed) -->
        <template id="variationTemplate">
            <div class="variationBlock mb-4 border p-3 rounded">
                <select class="form-control multiSelect" name="attribute_id[__INDEX__][]" multiple>
                    @foreach ($att as $attribute)
                        <option value="{{ $attribute->id }}" data-values='@json($attribute->values)'>
                            {{ $attribute->name }}
                        </option>
                    @endforeach
                </select>

                <div class="attributeValuesContainer d-flex flex-wrap gap-2 mt-3"></div>
            </div>
        </template> --}}



        <div class="col-md-12">
            <!-- Attribute Select (Once at the top only) -->
            <div class="mb-3 mainAttributeSelectsec">
                <label><strong>Select Attributes</strong></label>
                <select id="mainAttributeSelect" class="form-control" multiple>
                    @foreach ($att as $attribute)
                        <option value="{{ $attribute->id }}" data-values='@json($attribute->values)'>
                            {{ $attribute->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Variation Blocks Container -->
            <div id="variationBlocksContainer"></div>

            <!-- Button to Add Variation -->
            <button type="button" class="btn btn-primary mt-3" id="addVariationBtn">Add Variation</button>


        </div>


        {{-- <button type="button" id="addVariationBtn" class="btn btn-primary mt-3">Add Variation</button> --}}




        {{-- @foreach ($product->attributes as $pro_att_edits)
            <div class="col-md-12">
                <div data-repeater-list="attribute">
                    <div data-repeater-item class="row">
                        <input type="hidden" value="{{ $pro_att_edits->id }}" name="product_attribute[]">
                        <div class="form-group mb-1 col-sm-12 col-md-3">
                            <label for="email-addr">Attribute</label>
                            <select class="form-control" name="attribute_id[]" onchange="getval(this)" disabled>
                                <option value="{{ $pro_att_edits->attribute_id }}">
                                    {{ $pro_att_edits->attribute->name }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group mb-1 col-sm-12 col-md-3">
                            <label for="pass">Value</label>
                            <select class="form-control value" name="value[]" disabled>
                                <option value="{{ $pro_att_edits->value }}">
                                    {{ $pro_att_edits->attributesValues->value }}</option>
                            </select>
                        </div>

                        <div class="form-group mb-1 col-sm-12 col-md-2">
                            <label for="price">Price</label>
                            <input type="number" step="any" name="v_price[]" class="form-control"
                                value="{{ $pro_att_edits->price }}">
                        </div>

                        <div class="form-group mb-1 col-sm-12 col-md-2">
                            <label for="qty">Quantity</label>
                            <input type="number" name="qty[]" class="form-control"
                                value="{{ $pro_att_edits->qty }}">
                        </div>

                        <div class="form-group mb-1 col-sm-12 col-md-3">
                            <label for="image">Image</label>
                            <input type="file" name="image_att[]" class="form-control">
                        </div>
                        @if (!empty($pro_att_edits->image))
                            <img src="{{ asset($pro_att_edits->image) }}" width="100">
                        @endif

                        <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                            <button onclick="deleteAttr({{ $pro_att_edits->id }}, this)" type="button"
                                class="btn btn-danger" data-repeater-delete="">
                                <i class="ft-x"></i> Delete
                            </button>
                        </div>

                        <hr>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="repeater-default col-md-12">
            <div data-repeater-list="attribute">
                <div data-repeater-item="" class="row">
                    <div class="form-group mb-1 col-sm-12 col-md-3">
                        <label for="email-addr">Attribute</label>
                        <br>
                        <select class="form-control" id="attribute_id" name="attribute_id" onchange="getval(this)">
                            @foreach ($att as $atts)
                                <option value="{{ $atts->id }}">{{ $atts->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-3">
                        <label for="pass">value</label>
                        <br>
                        <select class="form-control value" id="value" name="value">

                        </select>
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-2">
                        <label for="bio" class="cursor-pointer">Price</label>
                        <br>
                        <input type="number" step="any" name="v-price" class="form-control" id="price"
                            value="{{ $pro_att_edits->attributesValues->price }}">
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-2">
                        <label for="bio" class="cursor-pointer">qty</label>
                        <br>
                        <input type="number" name="qty" class="form-control" id="qty">
                    </div>
                    <div class="form-group mb-1 col-sm-12 col-md-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group col-sm-12 col-md-2 text-center mt-2">
                        <button type="button" class="btn btn-danger" data-repeater-delete=""> <i
                                class="ft-x"></i>
                            Delete</button>
                    </div>

                    <hr>
                </div>
            </div>
            <div class="form-group overflow-hidden">
                <div class="">
                    <button type="button" data-repeater-create="" class="btn btn-primary">
                        <i class="ft-plus"></i> Add
                    </button>
                </div>
            </div>
        </div> --}}

    </div>
</div>

<div class="form-actions text-right pb-0">
    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
