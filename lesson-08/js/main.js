$(function() {
  $('.add-product-in-cart').click(function(ev) {
    ev.preventDefault();
    var e = $(this);
    $.ajax({
      url: '/cart.php?action=add',
      data: {
        'id_product': e.attr('data-id'),
        'quantity': e.attr('data-q')
      },
      type: 'post',
      dataType: 'json',
      success: function(json) {
        if (json.result == 1) {
          alert('Товар добавлен в корзину');
        } else {
          alert(json.errorMessage);
        }
      },
      error: function() {
        alert('Сбой сервера');
      }
    });
  });
});