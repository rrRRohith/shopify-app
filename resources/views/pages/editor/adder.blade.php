<div class="modal fade " id="newSectionModal" tabindex="-1" role="dialog" aria-labelledby="newSectionModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="newSectionModalCenterTitle">Add sections</h5>
            </div>
            <div class="modal-body">
                @include('pages.editor.widgets', ['side' => false])
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="productModalCenterTitle">Product grid settings</h5>
            </div>
            <div class="modal-body">
                <div class="product-setting">
                    <div class="row">
                        <div class="col">
                            <label for="" class="mb-0 small">Product collection</label>
                            <select name="" id="product_handle" class="form-control">
                                <option selected default value="all">All collections</option>
                                @foreach($collections as $collection)
                                <option value="{{ $collection->handle }}">{{ $collection->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="" class="mb-0 small">Limit products</label>
                            <select name="" id="product_limit" class="form-control">
                                <option selected default value="0">All paginated</option>
                                @for($i = 4; $i <= 16; $i=$i+4) <option value="{{ $i }}">{{ $i }} products</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-check-inline">
                                <input id="show_price" type="checkbox" class="form-check-input" value="1">
                                <label for="show_price" class="form-check-label">Show price</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary new-product" data-dismiss="modal">Continue</button>
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="customSectionModal" tabindex="-1" role="dialog" aria-labelledby="customSectionModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="customSectionModalCenterTitle">Customise section</h5>
            </div>
            <div class="modal-body">
                <div class="row slim-row custom-sections">
                    <div class="col slim-col">
                        <div class="addSec d-flex aligin-items-center new-columns p-4 cursor-pointer" data-col="2"
                            data-remove=".text-section">
                            <div class="m-auto small text-overflow"><img src="{{ asset('icons/img_101569.png') }}"
                                    alt="">Image</div>
                        </div>
                    </div>
                    <div class="col slim-col">
                        <div class="addSec d-flex aligin-items-center new-columns p-4 cursor-pointer" data-col="2"
                            data-remove=".image-section">
                            <div class="m-auto small text-overflow"><img src="{{ asset('icons/img_798.png') }}"
                                    alt="">Text</div>
                        </div>
                    </div>
                    <div class="col slim-col">
                        <div class="addSec d-flex aligin-items-center new-columns p-4 cursor-pointer" data-col="2"
                            data-type="all-section">
                            <div class="m-auto small text-overflow"><img src="{{ asset('icons/img_489545.png') }}"
                                    alt="">Image and text</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="formModalCenterTitle">New form</h5>
            </div>
            <div class="modal-body">
                <div class="row slim-row custom-sections">
                    <div class="col slim-col">
                        <div class="addSec d-flex aligin-items-center new-form p-4 cursor-pointer" 
                            data-type="image">
                            <div class="m-auto small text-overflow"><img src="{{ asset('icons/img_101569.png') }}"
                                    alt="">Image and form</div>
                        </div>
                    </div>
                    <div class="col slim-col">
                        <div class="addSec d-flex aligin-items-center new-form p-4 cursor-pointer" 
                            data-type="text">
                            <div class="m-auto small text-overflow"><img src="{{ asset('icons/img_798.png') }}"
                                    alt="">Text and form</div>
                        </div>
                    </div>
                    <div class="col slim-col">
                        <div class="addSec d-flex aligin-items-center new-form p-4 cursor-pointer" 
                            data-type="form">
                            <div class="m-auto small text-overflow"><img src="{{ asset('icons/img_471193.png') }}"
                                    alt="">Only form</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="customButtonModal" tabindex="-1" role="dialog" aria-labelledby="customButtonModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="customButtonModalCenterTitle">Customise button</h5>
            </div>
            <div class="modal-body">
                <div class="button-customizer">
                    <div class="row slim-row custom-sections">
                        <div class="col-md-6 slim-col">
                            <label for="" class="mb-0 small">Button text</label>
                            <input type="text" autofill="off" autocomplete="off" class="form-control" id="button_text"
                                value="" placeholder="Click here">
                        </div>
                        <div class="col-md-6 slim-col">
                            <label for="" class="mb-0 small">Button link</label>
                            <input type="text" autofill="off" autocomplete="off" class="form-control" id="button_link"
                                value="" placeholder="https://example.com/page">
                        </div>
                        <div class="col-md-6 slim-col d-flex">
                            <div class="mr-2">
                                <label for="" class="mb-0 small">Button color</label>
                                <div class="color-picker button-color"></div>
                            </div>
                            <div>
                                <label for="" class="mb-0 small">Text color</label>
                                <div class="color-picker text-color"></div>
                            </div>
                        </div>
                        <div class="col-12"></div>
                        <div class="col-md-6 slim-col">
                            <label for="">Align button</label>
                            <div class="clear-fix"></div>
                            <div class="btn-positioner">
                                <div class="form-check-inline">
                                    <input id="option1" type="radio" checked class="form-check-input" value="left"
                                        name="align">
                                    <label for="option1" class="form-check-label">Left</label>
                                </div>
                                <div class="form-check-inline">
                                    <input id="option2" type="radio" class="form-check-input" value="center"
                                        name="align">
                                    <label for="option2" class="form-check-label">Center</label>
                                </div>
                                <div class="form-check-inline disabled">
                                    <input id="option3" type="radio" class="form-check-input" value="right"
                                        name="align">
                                    <label for="option3" class="form-check-label">Right</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="mr-auto btn btn-danger button-delete" data-dismiss="modal">Remove</button>
                <button type="button" class="btn btn-primary new-button button-update">Continue</button>
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="context-menu position-absolute">
    <div class="dropdown-menu p-0 border-0 text-overflow show " aria-labelledby="dropdownMenuButton"
        x-placement="bottom-start">
        <a class="dropdown-item text-overflow add-button" href="#/">Add button</a>
        <a class="dropdown-item text-overflow change-color textCOLOR" href="#/">Change color</a>
    </div>
</div>
<div class="image-context-menu position-absolute">
    <div class="dropdown-menu p-0 border-0 text-overflow show " aria-labelledby="dropdownMenuButton"
        x-placement="bottom-start">
        <a class="dropdown-item text-overflow add-link" href="#/">Add Link</a>
        <a class="dropdown-item text-overflow update-image" href="#/">Update image</a>
    </div>
</div>
<div class="modal fade" id="customHTMLModal" tabindex="-1" role="dialog" aria-labelledby="customHTMLModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="customHTMLModalCenterTitle">Edit html</h5>
            </div>
            <div class="modal-body">
                <div class="html-edit">
                    <textarea name="" id="" class="w-100 form-control"
                        placeholder="Your custom html and css"></textarea>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary new-button html-update">Save</button>
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="replacerModal" tabindex="-1" role="dialog" aria-labelledby="customButtonModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="replacerModalCenterTitle">Find and replace in this page</h5>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" autofill="off" autocomplete="off" class="form-control" id="find_item"
                                value="" placeholder="Find what">
                        </div>
                        <div class="col-md-6">
                            <input type="text" autofill="off" autocomplete="off" class="form-control" id="replace_item"
                                value="" placeholder="Replace with">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-primary replace-text" disabled>Replace</button>
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="inputModalCenterTitle">Customise field</h5>
            </div>
            <div class="modal-body">
                <div class="product-setting">
                       <form class="new-input-customizer" id="elementForm">
                            <div class="row">
                                <div class="col-sm-4 input_type_selector">
                                    <div class="form-group">
                                    <label for="" class="mb-0 small">Field type</label>
                                    <select id="" required class="field-type form-control" >
                                        <option value="text">Text</option>
                                        <option value="number">Number</option>
                                        <option value="email">Email</option>
                                        <option value="date">Date</option>
                                        <option value="textarea">Textarea</option>
                                        <option class="values" value="select">Select</option>
                                        <option class="values" value="checkbox">Checkbox</option>
                                        <option class="values" value="radio">Radio</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="" class="mb-0 small">Field name</label>
                                    <input type="text" required class="field-name form-control" placeholder="first_name">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label for="" class="mb-0 small">Placholder | Label</label>
                                    <input type="text" required class="field-placeholder form-control" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="" class="mb-0 small">Field width</label>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <input id="width25" required type="radio" class="form-check-input field-width" name="field_width" value="25">
                                            <label for="width25" class="form-check-label">25%</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input id="width50" required type="radio" class="form-check-input field-width" name="field_width" value="50">
                                            <label for="width50" class="form-check-label">50%</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input id="width75" required type="radio" class="form-check-input field-width" name="field_width" value="75">
                                            <label for="width75" class="form-check-label">75%</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input id="width100" required type="radio" class="form-check-input field-width" name="field_width" value="100">
                                            <label for="width100" class="form-check-label">100%</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="" class="mb-0 small">Field required</label>
                                    <div class="form-group">
                                        <div class="form-check-inline">
                                            <input id="required" required type="radio" class="form-check-input field-required" name="field_required" value="required">
                                            <label for="required" class="form-check-label">Required</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input id="optional" required type="radio" class="form-check-input field-required" name="field_required" value="optional">
                                            <label for="optional" class="form-check-label">Optional</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 value-adder" style="display:none">
                                    <label for="" class="mb-0 small">Options</label>
                                    <div class=" mb-2">
                                    <div class="value-items row slim-row">
                                        
                                    </div>
                                    </div>
                                    <a href="#/" class="btn btn-cancel small add-value">Add option</a>
                                </div>
                            </div>
                       </form> 
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="mr-auto btn btn-danger field-delete" data-dismiss="modal">Remove</button> 
                <button type="button" class="btn btn-primary field-saver create-new-field">Add field</button>
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>