@extends('layouts.app')

@section('title', 'Users | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Users</h1>
            <div class="p-2">
                <button class="btn btn-success">Add New User</button>
            </div>
        </div>
        <p class="fs-5">Here are all of the users within the application</p>

        <div class="row row-eq-height container m-auto" >
            <div class="col-12" >
                <div class="card shadow h-100" >
                    <div class="card-body" >
                        <div class="row" >
                            <div class="col-12 col-md-6 p-4 mb-3" >
                                <div class="form-group position-relative" >
                                    <label for="findModel" >Asset Model</label >
                                    <input type="hidden" id="asset_model" name="asset_model"
                                            class="form-control mb-3" readonly >
                                    <input class="form-control" type="text" name="find_model" id="findModel"
                                            value="" autocomplete="off" placeholder="Search for Model" >
                                    <div id="modelResults"
                                            class="w-100 h-auto mb-5 d-block search-modal position-absolute"
                                            style="visibility: hidden; z-index: 2;" >
                                        <ul id="modelSelect" >
                                            <li >Nothing to Return</li >
                                        </ul >
                                    </div >
                                    <small class="form-text text-muted" >Can't find the Model your after?
                                        <a href="#" data-toggle="modal" data-target="#newModel" >
                                            Click Here</a >to create one.</small >
                                </div >
                                <div class="form-group" >
                                    <x-form.input name="name" formAttributes="required" />
                                </div >
                                <div class="form-group" >
                                    <x-form.input name="asset_tag" />
                                </div >
                                <div class="form-group" >
                                    <x-form.input name="serial_no" formAttributes="required" />
                                </div >
                                @if(old('asset_model') !== null && $model = \App\Models\AssetModel::find(old('asset_model')))
                                    <div id="additional-fields" >
                                        @if($model->fieldset()->exists() && $model->fieldset->fields()->exists())
                                            @foreach($model->fieldset->fields as $field)

                                                <div class="form-group" >
                                                    <label
                                                        for="{{str_replace(' ', '_', strtolower($field->name))}}" >{{$field->name}}</label >
                                                    @switch($field->type)
                                                        @case('Text'):
                                                        <x-form.input :name="$field->name" />
                                                        @break
                                                        @case('Textarea')
                                                        <x-form.textarea :name="$field->name"
                                                                            formAttributes=" cols=' 30' rows='10' " />
                                                        @break
                                                        @case('Select')
                                                        <?php $array = explode("\r\n", $field->value);?>
                                                        <x-form.select :name="$field->name"
                                                                        :models="$array" />
                                                        @break
                                                        @case('Checkbox')
                                                        <?php $array = explode("\r\n", $field->value);?>
                                                        <?php $values = explode(",", old(str_replace(' ', '_', strtolower($field->name))));?>
                                                        <x-form.checkbox :models="$array"
                                                                            :name="$field->name"
                                                                            :checked="$values" />
                                                        @break
                                                        @default
                                                        <x-form.input :name="$field->name" />
                                                    @endswitch
                                                </div >
                                            @endforeach
                                        @endif
                                    </div >
                                @else
                                    <div id="additional-fields" style="display: none;" >
                                        <span class="text-warning" >No Additional Fields Required</span >
                                    </div >
                                @endif
                            </div >
                            <div class="col-12 col-md-6 p-4 mb-3 " >
                                <div id="modelInfo" class="bg-light p-4" >
                                    <div class="model_title text-center h4 mb-3" >Asset Model</div >
                                    <div class="model_image p-4" >
                                        <img id="profileImage"
                                                src="{{ asset('images/svg/device-image.svg') }}" width="100%"
                                                alt="Select Profile Picture" >
                                    </div >
                                    <div class="model_no py-2 px-4" >
                                        Manufacturer:
                                    </div >
                                    <div class="model_no py-2 px-4" >
                                        Model No:
                                    </div >
                                    <div class="model_no py-2 px-4" >
                                        Depreication:
                                    </div >
                                    <div class="model_no py-2 px-4" >
                                        Additional Fieldsets:
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div >
                </div >
            </div >
        </div >
    </div>
</section>

@endsection

@section('modals')

@endsection

@section('js')

@endsection