"use strict";
window.addEventListener("load", function(){
    $(".loader").fadeOut("fast");
 });
const sidePanel = $('.side-panel');
const profilePanel = $('.profle-panel');
const adjustPanel = function(){
    if(forceHideSide)
        return;

    let width = $(window).width();
    if(parseInt(width) >= 992){
        sidePanel.show("slide", { direction: "left" });
    }
    else{
        sidePanel.hide("slide", { direction: "left" });
    }
}
let forceHideSide = false;
const hideSide = function(){
    $('body').addClass('force-hide-side');
    forceHideSide = true;
    sidePanel.hide("slide", { direction: "left" });
}
$(document).on('click', '.side-toggler', function(){
    sidePanel.toggle("slide", { direction: "left" });
})
$(window).resize(function() {
    adjustPanel();
});
$(function(){
    adjustPanel();
    setNavigation();
});
$(document).on('click', '.profile-toggle, .close-profile', function(){
    profilePanel.toggle("slide", { direction: "right" });
});
$(document).on('click', '.main-link', function(e){
    showSubmenu($(this).parent(), e);
});
$(document).on('click', '.main-link a', function(e){
    showSubmenu($(this).parent().parent(), e);
})
const showSubmenu = function (menu, e){
    $('.side-link').removeClass('active');
    menu.addClass('active');
    if(menu.find('.side-link-sub').length){
        e.preventDefault();
        return false;
    }
}
const setNavigation = function() {
    let path = window.location.href.replace(/\/+$/, '');
    path = decodeURIComponent(path);
    $(".side-link a").each(function () {
        let href = $(this).attr('href');
        href = decodeURIComponent(href);
        if (path == href) {
            $(this).addClass('active');
            $(this).parent().parent().addClass('active');
            return false;
        }
    });
}
$(document).on('click', 'a.confirm', function(e){
    e.preventDefault();
    let urlToRedirect = e.currentTarget.getAttribute('href');
    if(urlToRedirect == null || urlToRedirect == '' || !urlToRedirect)
        return false;
    Swal.fire({
      title: $(this).attr('data-title') ?? 'Are you sure ?',
      showCancelButton: true,
      showClass: {
          backdrop: 'swal2-noanimation', 
          popup: '',                     
          icon: ''                       
      },
      hideClass: {
          popup: '',
      },
      allowOutsideClick: false,
      cancelButtonText: $(this).attr('data-no') ?? 'Cancel',
      confirmButtonText: $(this).attr('data-yes') ?? 'Yes',
      }).then((result) => {
      if (result.value) {
        window.location.href = urlToRedirect;
      }
    });
  });
const tableResponsive = function (){
    $('.table-container td.first').each(function(){
        $(this).addClass('position-relative').append(`<a href="#" class="view-rows d-block d-sm-none"><i class="fa-solid fa-circle-plus"></i></a>`)
    });
}
$(function(){
    tableResponsive();
    $(document).on('click', '.view-rows', function(e){
        e.preventDefault();
        $(this).toggleClass('collapsed');
        $(this).parent().parent().toggleClass('collapsed')
    });
})
let selectionStart,
    selectionEnd;
$.fn.extend({
    isTextSelected: function () {
        var top = this.offset().top;
        var bottom = this.offset().top + this.height();
        
        console.log(window.getSelection());
            
        if ( (selectionStart > top && selectionStart < bottom ||
             selectionEnd > top && selectionEnd < bottom ||
            selectionStart < top && selectionEnd > bottom ||
            selectionEnd < top && selectionStart > bottom) && 
            window.getSelection().type != "Caret" )
        {
            return true;   
        }
        return false;
    }
});
function makeid(length = 5) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * 
        charactersLength));
    }
    return result;
}
