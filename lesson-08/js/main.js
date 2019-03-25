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
  $(document).on('click', '.delete-product-from-cart', function(ev) {
    ev.preventDefault();
    var e = $(this);
    if (confirm('Уверены?')) {
      $.ajax({
        url: '/cart.php?action=delete',
        data: {
          'id_product': e.attr('data-id')
        },
        type: 'post',
        dataType: 'json',
        success: function(json) {
          if (json.result == 1) {
            $('#cart-block').html(json.html);
          } else {
            alert(json.errorMessage);
          }
        },
        error: function() {
          alert('Сбой сервера');
        }
      });
    }
  });
});