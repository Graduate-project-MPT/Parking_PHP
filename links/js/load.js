document.onclick = function (e) {
  if (window.event) {
    e = event.srcElement;
  }
  else {
    e = e.target;
  }

  if (e.className && e.className.indexOf('mess_load') != -1) {
    var form = {};
    let str = e.getAttribute("name");
    form[str.substring(0, 9)] = parseInt(str.substring(9), 10);
    $.ajax({
      url: '../load_php/MessageLoad.php',
      type: "POST",
      data: $.param(form),
      success: function (data) {
        $('.mess_load').after(data);
        $('.mess_load').removeClass('hide');
        $('.mess_load').addClass('show');
        $('.mess_load').removeClass('mess_load');
      }
    });
  }
}