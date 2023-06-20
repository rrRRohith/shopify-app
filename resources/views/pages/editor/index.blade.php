
@extends('layouts.app')
@section('content')
@section('title', 'Pages | '.shop()->title)
<div class="container-fluid p-0 dash-container w-100">
   @include('layouts.header')
   @include('layouts.sidebar')
   <div class="w-100 panel-container">
      <div class="container-fluid container-xxxl p-2 p-sm-3 p-md-5 dash-bodies position-relative">
         @include('layouts.loader')
         <div class="row">
            <div class="col-xxl-2 col-xl-3 d-none d-xl-block side-container">
               @include('pages.editor.side')
            </div>
            <div class="col-xxl-10 col-xl-9 main-container">
               @include('pages.editor.editor')
            </div>
         </div>
         
      </div>
   </div>
</div>
<form action="" id="form"></form>
@include('pages.editor.adder')
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/popline/css/normalize.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/popline/themes/default.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/colorPicker/style.css') }}" />
@endpush
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/sticky.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/colorPicker/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/popline/scripts/jquery.popline.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/popline/scripts/plugins/jquery.popline.link.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/popline/scripts/plugins/jquery.popline.decoration.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/popline/scripts/plugins/jquery.popline.list.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/popline/scripts/plugins/jquery.popline.justify.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/popline/scripts/plugins/jquery.popline.blockformat.js') }}"></script>
<script>
   hideSide();
   $('.side-container, .main-container').theiaStickySidebar({
      additionalMarginTop: 60
   });
   const editor = $('.editor-container');
   $(function(){
      editor.find('.notebook-editor').popline({position: "fixed"});
   })
   $('.new-text').on('click', function(e){
      e.preventDefault();
      let id = makeid();
      let content = $(`{!! view('pages.editor.sections.text', ['js' => true])->render() !!}`);
      editor.append(content);
      content.find('.notebook-editor').popline();
      updateInit(content);
   });
   $('.new-product').on('click', function(e){
      e.preventDefault();
      let id = makeid();
      let content = $(`{!! view('pages.editor.sections.products', ['js' => true])->render() !!}`);
      editor.append(content);
      content.find('.notebook-editor').popline();
      content.find('input.product-collection').val($('select#product_handle').val());
      content.find('input.product-limit').val($('select#product_limit').val());
      content.find('input.product-price').val($('input#show_price').is(':checked') ? 1 : 0);
      $('input#show_price').prop('checked', false).removeAttr('checked');
      $('select#product_handle, select#product_limit').prop('selectedIndex',0);
      updateInit(content);
   });
   $('.new-form').on('click', async function(e){
      e.preventDefault();
      let id = makeid();
      let content = $(`{!! view('pages.editor.sections.form', ['js' => true])->render() !!}`);
      editor.append(content);
      content.find('.notebook-editor').popline();
      let formData = JSON.parse( content.find('.form-element').val());
      await renderForm(formData,  content.find('.form-editor'));
      content.find('.form-editor-container').addClass('enable-edit');
      content.addClass('enable-edit');
      if($(this).attr('data-type') == 'image'){
         content.find('.text-col').remove();
         content.find('.form-col').addClass('col-sm-6').removeClass('col-sm-12');
      }
      else if($(this).attr('data-type') == 'text'){
         content.find('.image-col').remove();
         content.find('.form-col').addClass('col-sm-6').removeClass('col-sm-12');
      }
      else{
         content.find('.image-col').remove();
         content.find('.text-col').remove();
         content.find('.flip-section-form').remove();
      }
      $('#formModal').modal('hide');
      makeSortable(content);
      updateInit(content);
   });
   $('.new-banner').on('click', function(e){
      e.preventDefault();
      let id = makeid();
      let content = $(`{!! view('pages.editor.sections.banner', ['js' => true])->render() !!}`);
      editor.append(content);
      content.find('.notebook-editor').popline();
      updateInit(content);
   });
   $('.new-html').on('click', function(e){
      e.preventDefault();
      let id = makeid();
      let content = $(`{!! view('pages.editor.sections.html', ['js' => true])->render() !!}`);
      editor.append(content);
      updateInit(content);
      content.find('.edit-html').click();
   });
   let htmlContent;
   $(document).on('click', '.edit-html', function(e){
      e.preventDefault();
      htmlContent = $(this).closest('.editor-section').find('.html-editor');
      $('.html-edit textarea').val(htmlContent.html());
      $('#customHTMLModal').modal({backdrop: 'static', keyboard: false}, 'show');
   });
   $('.html-update').on('click', function(e){
      e.preventDefault();
      htmlContent.html($('.html-edit textarea').val());
      htmlContent.closest('.section-holder').find('.html-content').val(htmlContent.html());
      $('#customHTMLModal').modal('hide');
   });
   $('.new-text-image').on('click', function(e){
      e.preventDefault();e
      let id = makeid();
      let content = $(`{!! view('pages.editor.sections.textImage', ['js' => true])->render() !!}`);
      editor.append(content);
      content.find('.notebook-editor').popline();
      updateInit(content);
   });
   $('.new-columns').on('click', function(e){
      e.preventDefault();
      let id = makeid();
      let content = $(`{!! view('pages.editor.sections.columns', ['js' => true])->render() !!}`);
      let col = parseInt($(this).attr('data-col'));
      if(col == 2 ){
         content.find('.col-dynamic').addClass('col-md-6').removeClass('col-md-3').last().remove();
         content.find('.col-dynamic').last().remove();
      }
      else if(col == 3 )
         content.find('.col-dynamic').addClass('col-md-4').removeClass('col-md-3').last().remove();
      content.find($(this).attr('data-remove')).remove();   
      editor.append(content);
      content.find('.notebook-editor').popline();
      $('#customSectionModal').modal('hide');
      updateInit(content);
   });
   $(document).on('click', '.remove-section', function(e){
      e.preventDefault();
      $(this).closest('.editor-section').remove();
   });
   $(document).on('click', '.flip-section', function(e){
      e.preventDefault();
      let flipper = $(this).closest('.editor-section').find('.flipper');
      let first = $(this).closest('.section-holder').find('.first-item');
      first.val(first.val() == 'image' ? 'text' : 'image');
      flipper.first().insertAfter(flipper.last());
   });
   $(document).on('click', '.flip-section-form', function(e){
      e.preventDefault();
      let flipper = $(this).closest('.editor-section').find('.flipper');
      let first = $(this).closest('.section-holder').find('.first-item');
      first.val(first.val() == 'form' ? 'text' : 'form');
      flipper.first().insertAfter(flipper.last());
   });
   $(document).on('click', '.addSec', function(){
      $('#newSectionModal').modal('hide');
   });
   $(document).on('click', '.remove-col', function(e){
      e.preventDefault();
      let col = $(this).closest('.col-dynamic');
      let row = $(this).closest('.row');
      $(this).closest('.editor-section').remove();
      if(col.children().length)
        return false;
      col.remove();
         
      if(!row.children().length){
         row.closest('.editor-section').remove();
         return false;
      }
      let currentLength = row.children('.col-dynamic').length;
      const lengths = {
         3 : 4,
         2 : 6,
         1 : 12,
      };
      row.find('.col-dynamic').each(function(){
         $(this).removeClass().addClass(`col-dynamic col-md-${(lengths[currentLength] ?? 1)}`);
      });
   });
   $(document).on('click', '.new-custom', function(){
      $('.new-columns').attr('data-col', $(this).attr('data-col'));
   });
   $(document).on("contextmenu", "a", function(e) {
      return false;
   });
   $(document).on("contextmenu", ".notebook-editor", function(e) {
      $(".context-menu").removeClass('btn-ctx clr-ctx')
      if(window.getSelection().toString() == ""){
         e.preventDefault();
         $(".context-menu").finish().toggle(100).css({
            top: e.pageY + "px",
            left: e.pageX + "px"
         }).addClass('btn-ctx');
      }
      else{
         e.preventDefault();
         $(".context-menu").finish().toggle(100).css({
            top: e.pageY + "px",
            left: e.pageX + "px"
         }).addClass('clr-ctx');
      }
   });
   let imageSelection;
   $(document).on("contextmenu", "img.upload-image", function(e) {
      if(window.getSelection().toString() == ""){
         e.preventDefault();
         imageSelection = $(this);
         $(".image-context-menu").finish().toggle(100).css({
            top: e.pageY + "px",
            left: e.pageX + "px"
         });
      }
   });
   $(document).on('click', '.add-link', function(e){
      $(".image-context-menu").hide(100);
      $('.linker').remove();
      let link = imageSelection.closest('.editor-section').find('.image-link').val();
      if(link == undefined)
         link = '';

      let linker = $(`<div class="d-flex align-items-center linker"><i class="fa-link fa"></i><input class="form-control" placeholder="https://example.com" value="${link}"></div>`).css({
         top: e.pageY + "px",
         left: e.pageX + "px"
      });
      $('body').append(linker);
   })
   $(document).on('keyup', ".linker input", function (e) {
      if (e.key === 'Enter' || e.keyCode === 13) {
         let link = $('.linker input').val();
         imageSelection.closest('.editor-section').find('.image-link').val(link);
         $(".linker").remove();
      }
   });
   $(document).on('click', '.update-image', function(){
      imageSelection.click();
      $(".image-context-menu").hide(100);
   })
   $(document).bind("mousedown", function (e) {
    if (!$(e.target).parents(".context-menu").length > 0) {
        $(".context-menu").hide(100);
    }
    if (!$(e.target).parents(".image-context-menu").length > 0) {
        $(".image-context-menu").hide(100);
    }
    if (!$(e.target).parents(".linker").length > 0) {
        $(".linker").remove();
    }
   });
   $('.add-button').on('click', function(){
      let id = makeid();
      document.execCommand('insertHTML', false, `<a class="btn btn-attach ${id}" data-position="left" contenteditable="false" href="#" style="background:#333;color:#ecf0f1">Click here</a>`);
      $(".context-menu").hide(100);
      $('.'+id).click();
   });
   let btn;
   $(document).on('click', '.btn-attach', function(e){
      e.preventDefault();
      if(window.getSelection().toString() == ""){
         btn = $(this);
         $('.btn-positioner input[value="'+btn.attr('data-position')+'"]').attr('cheched', true).prop('checked', true);
         $('input#button_text').val(btn.text());
         $('input#button_link').val(btn.attr('href'));
         $('.button-color').css({'background-color' : btn.css('background-color')});
         $('.text-color').css({'background-color' : btn.css('color')});
         $('#customButtonModal').modal('show');
      }
   });
   $('.button-delete').on('click', function(){
      btn.remove();
   });
   $(document).on('click', '.button-update', function(e){
      e.preventDefault();
      let text = $('input#button_text').val();
      let link = $('input#button_link').val();
      if(!text || !link)
         return false;

      let position = $('input[name="align"]:checked').val();
      btn.text(text).attr('href', link).css({
         'background-color' : $('.button-color').css('background-color'),
         'color' : $('.text-color').css('background-color'),
      }).attr('data-position', position);
      $('#customButtonModal').modal('hide');
      $('input#button_text, input#button_link').val('');
      if(position == 'center')
         btn.css({
            'margin' : 'auto',
         });
      else if(position == 'right')
         btn.css({
            'margin-left' : 'auto',
            'margin-right' : '0px',
         });
      else
         btn.css({
            'margin-left' : '0px',
            'margin-right' : 'auto',
         });
      $('.btn-positioner input').removeAttr('checked').prop('checked', false);
      btn.closest('.section-holder').find('.html-content').val(btn.closest('.section-holder').find('.notebook-editor').html());
   });
   $(".color-picker").colorPick({
		'initialColor' : '#333',
	});
   const updateInit = function(content){
      content.find('.notebook-editor').each(function(){
         $(this).closest('.section-holder').find('.html-content').val($(this).html());
      });
      content.find('.html-editor').each(function(){
         $(this).closest('.section-holder').find('.html-content').val($(this).html());
      });
      content.find('.image-file').each(function(){
         $(this).closest('.section-holder').find('.image-url').val($(this).attr('src'));
      });
      scroll();
   }
   $(document).on('input', '.notebook-editor', function() {
      $(this).closest('.section-holder').find('.html-content').val($(this).html());
   });
</script>
<script>
$(function() {
   $(document).on('click', '.upload-image', function(e){
      e.preventDefault();
      $(this).closest('.editor-section').find('input.image-uploader').click();
   })
   $(document).on("change", ".image-uploader", function(){
      var uploadFile = $(this);
      let editorSection = uploadFile.closest('.editor-section');
		uploadFile.parent().find('.uploaded_image').remove();
      var files = !!this.files ? this.files : [];
      if (!files.length || !window.FileReader) return;

      if (/^image/.test( files[0].type)){
         var reader = new FileReader();
         reader.readAsDataURL(files[0]);
         reader.onloadend = function(){
            let image = this.result;
            editorSection.find('.dynamic-image').attr('src', image).css({'background-image' : `url(${image})`});
            fetch(`{{ route('pages.image', ['page' => $page->id]) }}`,{
               method: 'POST',
               headers: {
                  'Content-Type': 'application/json',
                  'X-Requested-With': 'XMLHttpRequest',
                  'X-CSRF-Token': $('meta[name="_token"]').attr('content')
               },
               body: JSON.stringify({
                  'image' : image,
               }),
            })
         .then(response=>response.json())
         .then(data=>{ 
            if(data.image){}
               editorSection.find('input.image-url').val(data.image);
               
         }).catch(function(response){
         });
            uploadFile.val('');
         }
      }
   });
});
$('form#editor').on('submit', async function(e){
   e.preventDefault();
   let btn = $('.save-btn');
   btn.text('Saving changes').attr('disabled', true);
   let body = $(this).serialize();
   await $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: body,
      success:function(data) {
         if(data.success)
            toastSuccess(data.message)
         else
            toastError(data.message)
      },
      error  : function(){
         toastError('Sorry, something went wrong.')   
      }
   });
   btn.text('Save changes').removeAttr('disabled');
});
$(document).on('click', '.move-section', function(e) {
   e.preventDefault();
   var parent = $(this).closest('.editor-section');
   if ($(this).attr('data-direction') == 'up') {
      parent.insertBefore(parent.prev('.editor-section'));
   }
   else if ($(this).attr('data-direction') == 'down') {
      parent.insertAfter(parent.next('.editor-section'));
   }
});
</script>
<script>
   let replaces = 0;
   $('.replacer').on('click', function(e){
      e.preventDefault();
      $('.replace-result').text(``);
      $('div#replacerModal input[type="text"]').val('');
      $('#replacerModal').modal({backdrop: 'static', keyboard: false}, 'show');
      replaces = 0;
   });
   $('.replace-text').on('click', async function(){
      replaces = 0;
      if($('input#find_item').val().trim().length){
         await findAndReplace($('.html-editor'));
         await findAndReplace($('.notebook-editor'));
         $('#replacerModal').modal('hide');
         updateReplace();
         toastSuccess(`${replaces} found and replaced.`)
      }
   });
   const findAndReplace = function(ele){
      let find = $('input#find_item').val();
      let replace = $('input#replace_item').val();
      findR = new RegExp('(' + find + ')', 'gi');
      ele.each(function(){
         if($(this).children().length)
            return findAndReplace($(this).children())

         return $(this).text(function () {
            if($(this).text().toLocaleLowerCase().indexOf(find.toLocaleLowerCase())!=-1)
               replaces++;
            return $(this).text().replace(findR, replace); 
         });
      });
   }
   $('input#find_item').on('keyup', function(){
      if($('input#find_item').val().trim().length){
        $('.replace-text').removeAttr('disabled');
      }
      else
         $('.replace-text').attr('disabled', true);
   })
   const updateReplace = function(){
      $('.editor-container').find('.notebook-editor').each(function(){
         $(this).closest('.section-holder').find('.html-content').val($(this).html());
      });
      $('.editor-container').find('.html-editor').each(function(){
         $(this).closest('.section-holder').find('.html-content').val($(this).html());
      });
   }
</script>
<script>
   $(document).on('click', '.update-form', async function(e){
     e.preventDefault(); 
     let form = $(this).closest('.editor-section');
     form.addClass('enable-edit');
     let formData = JSON.parse(form.find('.form-element').val());
     form.find('.form-editor-container').addClass('enable-edit');
     makeSortable(form);
   })
   
   const initRenderForm = function(){
      $('.form-editor').each(function(){
         let formData = JSON.parse($(this).closest('.editor-section').find('.form-element').val());
         renderForm(formData, $(this));
      })
   }
   const formWidths = {
      '100' : 'col-sm-12',
      '75' : 'col-sm-9',
      '50' : 'col-sm-6',
      '25' : 'col-sm-3',
   };
   const formWithDefault = 'col-12';
   const renderForm = async function(formData, formContainer){
      let elementContainer = $('<div class="form-container row"></div>');
      await formData.forEach(function(ele, i){
         let type = ele.type ?? 'text';
         let element = '';
         switch(type){
            case 'text' :
            case 'number' :
            case 'email' :
            case 'submit' :
            case 'date' :
               element = renderInput(ele, i);
            break;
            case 'textarea' :
               element = renderText(ele, i);
            break;
            case 'select' :
               element = renderSelect(ele, i);
            break;
            case 'radio' :
               element = renderRadio(ele, i);
            break;
            case 'checkbox' :
               element = renderCheckbox(ele, i);
            break;
            default : 
            //do nothing;
            break;
         }
         elementContainer.append(element);
      });
      formContainer.html('');
      formContainer.append(elementContainer);
   }
   const renderInput = function(ele, i){
      let type = ele.type ?? 'text';
      let required = ele.required ?? false;
      let value = ele.value ?? '';
      let width = ele.width ?? '100';
      let placeholder = ele.placeholder ?? null; 
      let widthClass = formWidths[width] ?? formWithDefault;
      let name = ele.name ?? i;
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} edit_element">
      ${getElementAction(ele)}
      ${placeholder ? `<label for="item__${i}_${name}">${placeholder}</label> ` : ''}
      <input ${required ? 'required' : ''} form="form" type="${type == 'submit' ? 'button' : type}" autocomplete="off" class="form-control ${type == 'submit' ? 'btn btn-dark' : ''}" id="item__${i}_${name}" value="${value}" placeholder="${placeholder}">
      </div>`;
   };
   const renderText = function(ele, i){
      let width = ele.width ?? '100';
      let required = ele.required ?? false;
      let placeholder = ele.placeholder ?? null; 
      let widthClass = formWidths[width] ?? formWithDefault;
      let name = ele.name ?? i;
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} position-relative edit_element">
      ${getElementAction(ele)}
      ${placeholder ? `<label for="item__${i}_${name}">${placeholder}</label> ` : ''}
      <textarea ${required ? 'required' : ''} form="form" autocomplete="off" class="form-control" id="item__${i}_${name}" placeholder="${placeholder}"></textarea>
      </div>`;
   };
   const renderSelect = function(ele, i){
      let width = ele.width ?? '100';
      let required = ele.required ?? false;
      let placeholder = ele.placeholder ?? null; 
      let widthClass = formWidths[width] ?? formWithDefault;
      let values = ele.values ?? [];
      let options = '';
      let name = ele.name ?? i;
      values.forEach(function(value){
         options += `<option value="${value}">${value}</option>`;
      });
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} position-relative edit_element">
      ${getElementAction(ele)}
      ${placeholder ? `<label for="item__${i}_${name}">${placeholder}</label> ` : ''}
      <select ${required ? 'required' : ''} form="form" autocomplete="off" class="form-control" id="item__${i}_${name}" placeholder="${placeholder}">
      <option selected disabled>Select</option>
      ${options}
      </select>
      </div>`;
   };
   const renderRadio = function(ele, i){
      let width = ele.width ?? '100';
      let required = ele.required ?? false;
      let placeholder = ele.placeholder ?? null; 
      let widthClass = formWidths[width] ?? formWithDefault;
      let values = ele.values ?? [];
      let options = '';
      let name = ele.name ?? i;
      values.forEach(function(value){
         options += `<div class="form-check">
            <input ${required ? 'required' : ''} form="form" class="form-check-input" type="radio" value="" id="item__${i}_${name}_${value}" name="${name}" value="${value}">
            <label class="form-check-label" for="item__${i}_${name}_${value}">${value}</label>
            </div>`;
      });
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} position-relative edit_element">
      ${getElementAction(ele)}
      ${placeholder ? `<label for="item__${i}_${name}">${placeholder}</label> ` : ''}
      <div class="checkbox-group">
         ${options}
      </div>
      </div>`;
   };
   const renderCheckbox = function(ele, i){
      let required = ele.required ?? false;
      let width = ele.width ?? '100';
      let placeholder = ele.placeholder ?? null; 
      let widthClass = formWidths[width] ?? formWithDefault;
      let values = ele.values ?? [];
      let options = '';
      let name = ele.name ?? i;
      values.forEach(function(value){
         options += `<div class="form-check">
            <input ${required ? 'required' : ''} form="form" class="form-check-input" type="checkbox" value="" id="item__${i}_${name}_${value}" name="${name}[]" value="${value}">
            <label class="form-check-label" for="item__${i}_${name}_${value}">${value}</label>
            </div>`;
      });
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} position-relative edit_element">
      ${getElementAction(ele)}
      ${placeholder ? `<label for=item__${i}_${name}">${placeholder}</label> ` : ''}
      <div class="checkbox-group">
         ${options}
      </div>
      </div>`;
   };
   const getElementAction = function(ele){
      return `<span class="grip-handle"><i class="fa-solid fa-grip-vertical"></i></span><input type="hidden" class="element-setting" value='${JSON.stringify(ele)}'>`;
   }
   $(document).on('click', '.editor-actions .close-edit', function(e){
      e.preventDefault();
      let form = $(this).closest('.editor-section').removeClass('enable-edit');
      form.find('.form-editor-container').removeClass('enable-edit');
      form.find(".form-container" ).sortable('cancel');
   })
   $(function(){
      initRenderForm();
   })
   const scroll = function(){
      $('html,body').animate({scrollTop: document.body.scrollHeight},"slow");
   }
   let formEditor;
   $(document).on('click', '.new-element', function(e){
      e.preventDefault();
      formEditor = $(this).closest('.editor-section');
      $('form#elementForm').trigger('reset');
      $('.field-saver').addClass('create-new-field').removeClass('update-new-field').text('Add field');
      $('.field-delete').hide();
      $('.value-adder').hide();
      $('.value-items').html('');
      $('.input_type_selector').show();
      $('#inputModal').modal('show');
   })
   $(document).on('click', '.create-new-field', function(){
      for (const el of document.getElementById('elementForm').querySelectorAll("[required]")) {
         if (!el.reportValidity()) {
            return;
         }
      }
      let formSettings = JSON.parse(formEditor.find('input.form-element').val());
      let values = $("input[name='values[]']").map(function(){return $(this).val();}).get();
      let newElement = {
         type : $('.field-type').val(),
         name : $('.field-name').val(),
         width : $("input[name=field_width]:checked").val(),
         placeholder : $('.field-placeholder').val(),
         required : $("input[name=field_required]:checked").val() == 'required' ? true : false,
         values : values,
      }
      formSettings.push(newElement);
      formEditor.find('input.form-element').val(JSON.stringify(formSettings));
      renderForm(formSettings, formEditor.find('.form-editor'));
      formEditor.find('.empty__form').hide();
      $('#inputModal').modal('hide');
      
   });
   let formElement;
   $(document).on('click', '.enable-edit .edit_element', function(e){
      e.preventDefault();
      formEditor = $(this).closest('.editor-section');
      formElement = $(this);
      let field = JSON.parse(formElement.find('input.element-setting').val());
      $('.value-items').html('');
      $('form#elementForm').trigger('reset');
      $('.field-name').val(field.name ?? (field.type == 'submit' ? field.type : ''));
      $('.field-type option[value="'+field.type+'"]').attr("selected", "selected").prop("selected", "selected").trigger('change');
      $('.field-width[value="'+field.width+'"]').attr("checked", "checked").prop("checked", "checked");
      $('.field-required[value="'+(field.required ? 'required' : 'optional')+'"]').attr("checked", "checked").prop("checked", "checked");
      $('.field-placeholder').val(field.placeholder ? field.placeholder : (field.type == 'submit' ? field.value : ''));
      $('#inputModal').modal('show');
      $('.field-saver').removeClass('create-new-field').addClass('update-new-field').text('Save field');
      $('.input_type_selector').hide();
      $('.field-delete').show().removeAttr('disabled');
      if(field.type == 'submit'){
         $('.field-delete').hide().attr('disabled', true);
      }
      updateOptions(field);
   });
   const updateOptions = function(field){
      let values = field.values ?? [];
      let option = $('.field-type option').filter(':selected');
      if(option.hasClass('values')){
         $('.value-items').html('');
         values.forEach(function(value){
            $('.value-items').append(`<div class="position-relative option-list col-auto slim-col"><i class="fa-solid fa-xmark close-value"></i><input type="text" name="values[]" class="form-control" value="${value}" placeholder="Enter value"></div>`);
         })
      }
   }
   $(document).on('click', '.update-new-field', async function(){
      for (const el of document.getElementById('elementForm').querySelectorAll("[required]")) {
         if (!el.reportValidity()) {
            return;
         }
      }
      let field = JSON.parse(formElement.find('input.element-setting').val());
      let values = $("input[name='values[]']").map(function(){return $(this).val();}).get();
      field['name'] = $('.field-name').val();
      field['width'] = $("input[name=field_width]:checked").val();
      field['placeholder'] = field.type == 'submit' ? '' : $('.field-placeholder').val();
      field['values'] = values;
      field['required'] = $("input[name=field_required]:checked").val() == 'required' ? true : false;
      field['value'] = field.type == 'submit' ? $('.field-placeholder').val() : '';
      console.log(field);
      formElement.find('input.element-setting').val(JSON.stringify(field));
      updateFormElements();
      
      $('#inputModal').modal('hide');
   });
   $('.field-delete').on('click', async function(){
      formElement.remove();
      await updateFormElements();
      formEditor.find('.empty__form').hide();
      if(!formEditor.find('.form-container').children().length){
         formEditor.find('.empty__form').show();
      }

   });
   const updateFormElements = async function(){
      let newFormSettings = [];
      await formEditor.find('input.element-setting').each(function(){
         newFormSettings.push(JSON.parse($(this).val()));
      });
      formEditor.find('input.form-element').val(JSON.stringify(newFormSettings));
      renderForm(newFormSettings, formEditor.find('.form-editor'));
   }
   $(document).on('click', '.empty__form', function(){
      let editorSection = $(this).closest('.editor-section');
      editorSection.find('.update-form').click();
      editorSection.find('.new-element').click();
   });
   const makeSortable = function(sorter){
      sorter.find(".form-container").sortable({
         handle : '.grip-handle',
         scroll: false,
         stop : async function(evt, ui){
            formEditor = ui.item.closest('.editor-section');
            await updateFormElements();
            makeSortable(sorter);
         },
      });
   }
   $('.field-type').on('change', function(){
      let option = $('.field-type option').filter(':selected');
      $('.value-adder').hide();
      $('.value-items').html('');
      if(option.hasClass('values')){
         $('.value-items').append(`<div class="position-relative option-list col-auto slim-col"><i class="fa-solid fa-xmark close-value"></i><input type="text" name="values[]" class="form-control" value="" placeholder="Enter value"></div>`);
         $('.value-adder').show();
      }  
   });
   $('.add-value').on('click', function(e){
      e.preventDefault();
      $('.value-items').append(`<div class="position-relative option-list col-auto slim-col"><i class="fa-solid fa-xmark close-value"></i><input type="text" name="values[]" class="form-control" value="" placeholder="Enter value"></div>`);
   })
   $(document).on('click', 'i.close-value', function(){
      $(this).parent().remove();
   });
   $(function(){
      $('.editor-container').sortable({
         handle : '.section-divider',
         scroll: false,
         start: function( event, ui ) {
            ui.item.addClass('dragging'); 
         },
         stop: function( event, ui ) {
            ui.item.removeClass('dragging'); 
         }
      })
   })
</script>
@endpush