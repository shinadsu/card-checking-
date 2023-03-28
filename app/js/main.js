$(function() {
  $('#my-form').submit(function(event) {
    event.preventDefault();
    var expiryDate = $('#expiry-date').val();
    var cardNumber = $("#card-number").val();
    var currentDate = new Date();
    var expiryDateParts = expiryDate.split('/');
    var expiryMonth = parseInt(expiryDateParts[0]);
    var expiryYear = parseInt(expiryDateParts[1]);

    // Проверяем, истек ли срок действия карты
    if (expiryYear < currentDate.getFullYear() || 
        (expiryYear == currentDate.getFullYear() && expiryMonth < (currentDate.getMonth() + 1))) {
      alert('Срок вашей карты ' + cardNumber + ' истек, карта не действительная');
    } else {
      alert('Заявка Отправлена!')
      this.submit();
    }
  });

  $('#card-number').on('change', function(){
    var $element = $(this).val();
    $('#expiry-date').val($element);
    
  });
  $('#expiry-date').on('change', function(){
    var $element = $(this).val();
    $('#card-number').val($element);
  });
}); 