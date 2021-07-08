/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/handlers/devices.js ***!
  \******************************************/
$('.del_device').on('click', function () {
  var _this = this;

  var device_id = $(this).val();
  $.ajax({
    url: del_device_handler_link,
    data: {
      'device_id': device_id
    }
  }).done(function (result) {
    $(_this).parent().parent().remove();
    console.log('Device id' + device_id + ' is deleted.');
  });
});
$('.edit_device').on('click', function () {
  console.log('edit device'); // let device = {};
  // $(this).parent().siblings().each((i, el) => {
  //     let prop_name = $(el).attr('name');
  //     let prop_val = $(el).text().trim();
  //     if(prop_val.length > 0){
  //         device[prop_name] = pror_val;
  //     }
  // })

  $(this).parent().siblings(':not(.control)').each(function (i, el) {
    var prop_name = $(el).attr('name');
    var prop_val = $(el).text().trim();
    $(el).empty();
    $(el).append('<input type="text" class="form-control" value="' + prop_val + '">');
  });
});
/******/ })()
;