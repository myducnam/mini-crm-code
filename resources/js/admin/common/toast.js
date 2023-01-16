import 'bootstrap/js/src/toast';

const toast = {
  show(type, message) {
    const $toast = $(`.js-ajax-toast-${type}`);
    $toast.css('pointer-events', 'auto');
    $toast.find('.toast-body').text(message);
    $toast.toast('show');

    // hidden
    $toast.on('hidden.bs.toast', () => {
      $toast.css('pointer-events', 'none');
    });
  }
}

export default toast;