$(function () {
  $('#comment-form').on('submit', function (e) {
    e.preventDefault();
    var $form = $(this);
    var $btn = $('#submit-comment');
    var $result = $('#comment-result');

    $btn.prop('disabled', true).text('Posting...');

    $.ajax({
      method: 'POST',
      url: $form.attr('action'),
      data: $form.serialize(),
      dataType: 'json'
    }).done(function (resp) {
      if (resp.success) {
        // prepend new comment
        $('#comments-list').prepend(resp.html);
        var count = parseInt($('#comments-count').text() || '0', 10) + 1;
        $('#comments-count').text(count);
        $form[0].reset();
        $result.html('<div class="alert alert-success small">Comment posted.</div>');
      } else if (resp.errors) {
        $result.html('<div class="alert alert-danger small">' + resp.errors.join('<br>') + '</div>');
      } else {
        $result.html('<div class="alert alert-danger small">' + (resp.error || 'Unknown error') + '</div>');
      }
    }).fail(function () {
      $result.html('<div class="alert alert-danger small">Request failed.</div>');
    }).always(function () {
      $btn.prop('disabled', false).text('Post Comment');
      setTimeout(function(){ $result.fadeOut(400, function(){ $(this).html('').show(); }); }, 2500);
    });
  });
});
