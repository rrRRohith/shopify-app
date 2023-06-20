/*
  jquery.popline.decoration.js 1.0.0

  Version: 1.0.0
  Updated: Sep 10th, 2014

  (c) 2014 by kenshin54
*/
;(function($) {

  $.popline.addButton({
    bold: {
      iconClass: "fa fa-bold",
      mode: "edit",
      action: function(event) {
        document.execCommand("bold");
      }
    },

    italic: {
      iconClass: "fa fa-italic",
      mode: "edit",
      action: function(event) {
        document.execCommand("italic");
      }
    },

    strikethrough: {
      iconClass: "fa fa-strikethrough",
      mode: "edit",
      action: function(event) {
        document.execCommand("strikethrough");
      }
    },

    underline: {
      iconClass: "fa fa-underline",
      mode: "edit",
      action: function(event) {
        document.execCommand("underline");
      }
    },
    button: {
      iconClass: "fa fa-paint-brush textCOLOR",
      mode: "edit",
      action: function(event) {
        changeColor(event);
      }
    },

  });
})(jQuery);
const changeColor = function(event){
  $(".context-menu").hide(100);
  event.preventDefault();
  $('.colorPCIKER').remove();
  let colorPICKER  = $(`<div class="colorPCIKER" style="display:none"></div>`);
  $('body').append(colorPICKER);
    colorPICKER.finish().toggle(100).css({
      top: event.pageY + "px",
      left: event.pageX + "px"
    });
    $('.colorPCIKER').colorPick({
      'initialColor' : '#333',
        'onColorSelected': async function() {
          document.execCommand('ForeColor', false, this.color);
        } 
    });
  $('ul.popline').hide();
  $('.colorPCIKER').click();
  return;
}
$(function(){
  $('.change-color').on('click', async function(e){
      await changeColor(e);
  });
})