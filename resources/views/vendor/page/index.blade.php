<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/shopify.min.css') }}" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<input type="hidden" name="template_contents" value='@json($page->template_contents)'>
<div class="page-container">
    @if($page->template_contents)
        @foreach($page->template_contents as $key => $content)
            @if($content->section_type == 'banner')
                @include('vendor.page.sections.banner')
            @elseif($content->section_type == 'text' || $content->section_type == 'html')
                @include('vendor.page.sections.text')
            @elseif($content->section_type == 'textImage')
                @include('vendor.page.sections.textImage')
            @elseif($content->section_type == 'columns')
                @include('vendor.page.sections.columns')
            @elseif($content->section_type == 'products')
                @include('vendor.page.sections.products')
            @elseif($content->section_type == 'form')
                @include('vendor.page.sections.form')
            @endif
        @endforeach
    @endif
</div>
<style>
p.error-box.form-error {
    color: #f44336;
}
p.error-box.form-success {
    color: #8bc34a;
}
</style>
<script>
$(function(){
    initRenderForm();
})
const initRenderForm = function(){
    $('.indig-form').each(function(){
        let formData = JSON.parse($(this).find('.form-element').val());
        renderForm(formData, $(this).find('.form-elements'));
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
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} item_element">
      ${placeholder ? `<label for="item__${i}_${name}">${placeholder}</label> ` : ''}
      <input ${required ? 'required' : ''} ${type !== 'submit' ? `name="${name}"` : ''} type="${type}" autocomplete="off" class="form-control ${type == 'submit' ? 'btn btn-dark' : ''}" id="item__${i}_${name}" value="${value}" placeholder="${placeholder}">
      </div>`;
   };
   const renderText = function(ele, i){
      let width = ele.width ?? '100';
      let required = ele.required ?? false;
      let placeholder = ele.placeholder ?? null; 
      let widthClass = formWidths[width] ?? formWithDefault;
      let name = ele.name ?? i;
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} position-relative item_element">
      ${placeholder ? `<label for="item__${i}_${name}">${placeholder}</label> ` : ''}
      <textarea name="${name}" ${required ? 'required' : ''} autocomplete="off" class="form-control" id="item__${i}_${name}" placeholder="${placeholder}"></textarea>
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
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} position-relative item_element">
      ${placeholder ? `<label for="item__${i}_${name}">${placeholder}</label> ` : ''}
      <select ${required ? 'required' : ''} name="${name}" autocomplete="off" class="form-control" id="item__${i}_${name}" placeholder="${placeholder}">
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
            <input ${required ? 'required' : ''} class="form-check-input" type="radio" id="item__${i}_${name}_${value}" name="${name}" value="${value}">
            <label class="form-check-label" for="item__${i}_${name}_${value}">${value}</label>
            </div>`;
      });
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} position-relative item_element">
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
      let countValue = values.length;
      values.forEach(function(value){
         options += `<div class="form-check">
            <input ${required ? 'required' : ''} class="form-check-input" type="checkbox" id="item__${i}_${name}_${value}" name="${name} ${countValue > 1 ? '[]' : ''}" value="${value}">
            <label class="form-check-label" for="item__${i}_${name}_${value}">${value}</label>
            </div>`;
      });
      return `<div class="${widthClass} form-group mb-2 item__${i}_${name} position-relative item_element">
      ${placeholder ? `<label for=item__${i}_${name}">${placeholder}</label> ` : ''}
      <div class="checkbox-group">
         ${options}
      </div>
      </div>`;
   };
</script>
<script>
const leadgen = 'https://leadgenpro.ca';
$(function(){
   $('form.indig-form').on('submit', async function(e){
      e.preventDefault();
      let data = $(this).serialize();
      let btn = $(this).find('input[type=submit]');
      btn.parent().find('.error-box').remove();
      let btnPrevTest = btn.val();
      btn.val('Sending respose ....').attr('disabled', true);
      let searchParams = new URLSearchParams(window.location.search)
      let ref = searchParams.get('ref');
      let ip = $("input#ip").val();
      let url = window.location.href.split('?')[0];
      let reffer   = '123';
      let successurl = $(this).find("input[name='success_url']").val();  
      let ser_infp = $('#lead_info').val();

      let device = 'desktop';
            
      if(navigator.userAgentData.mobile)
         device = 'mobile';
            
      let language = navigator.language || navigator.userLanguage;
      let browser  = navigator.userAgent.split(')').reverse()[0].match(/(?!Gecko|Version|[A-Za-z]+?Web[Kk]it)[A-Z][a-z]+\/[\d.]+/g)[0].split('/');
      let platform = navigator.platform;
      let name = $(this).find('input[name=firstname]').val() + ' ' + $(this).find('input[name=lastname]').val(); 

      let datastring = $(this).serialize()+ '&name='+ name + '&ip=' + ip + '&referrer_domain=' + ref + '&url=' + url + '&server_info=' + ser_infp + '&device='+ device +'&language='+ language +'&browser='+ browser +'&platform='+ platform;
      $('.form-error').hide();

      try{
         await jQuery.ajax({
            type: "GET",
            url: "https://leadgenpro.ca/leadgeneration",
            data: datastring,
            success: function(data,status) {
               if(status == 'success'){  
                  errorBox(btn, 'Your response has been sent successfully.', 'success');
               }
               else{
                  btn.removeAttr('disabled', true);
                  errorBox(btn, 'Something went wrong, please try again later.', 'error');
               }
            },
            error : function(data, status){
               btn.removeAttr('disabled', true);
               errorBox(btn, 'Something went wrong, please try again later.', 'error');
            }
         });
      }
      catch(err){
         btn.removeAttr('disabled', true);
         errorBox(btn, 'Something went wrong, please try again later.', 'error');
      }
      btn.val(btnPrevTest);
   });
});
const errorBox = function(btn, message, type){
   btn.parent().find('.error-box').remove();
   btn.after(`<p class="error-box form-${type}">${message}</p>`)
}
$(function(){
    jQuery.getJSON("https://jsonip.com/?callback=?", function (data) {
        $('body').append($('<input id="ip" name="ip" type="hidden">').val(data.ip));  
        jQuery.getJSON('https://ipapi.co/'+data.ip+'/json',function(data2){
            $('body').append($('<input id="lead_info" name="lead_info" type="hidden">').val(JSON.stringify(data2)));
        });     
    });
})
$(function(){
   if(!localStorage.getItem('visited')) {
      let page_identity = location.protocol + '//' + location.host + location.pathname;
      jQuery.ajax({
            type: "GET",
            url: `${leadgen}/vistingincrement`,
            data: {page_identity : page_identity},
            success : function(r){
               console.log(r)
            },
            error : function(r){
               console.log(r)
            }
      });
      localStorage.setItem('visited', true);
   } 
});
</script>