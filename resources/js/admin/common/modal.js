import 'jquery';
import 'bootstrap';

const modal = {
  initModal(config) {
    const $adminConfirmModal = $('#adminConfirmModal');
    if (!$adminConfirmModal) return;

    const $modalTitle = $adminConfirmModal.find('.modal-title').first();
    const $modalBody = $adminConfirmModal.find('.modal-body').first();
    const $btnYes = $adminConfirmModal.find('.btn-yes').first();
    const $btnNo = $adminConfirmModal.find('.btn-no').first();

    const closeModal = () => $adminConfirmModal.modal('hide');

    const title = config['title'] || null;
    const body = config['body'] || null;
    let btnYesText = config['btnYesText'] || null;
    let btnNoText = config['btnNoText'] || null;
    const callbackYes = config['callbackYes'];
    const callbackNo = config['callbackNo'];
    const showBtnYes = btnYesText || callbackYes

    // Set title
    if (title) {
      $modalTitle.removeClass('d-none').html(title);
    } else {
      $modalTitle.addClass('d-none');
    }

    // Set body
    if (body) {
      $modalBody.removeClass('d-none').html(body);
    } else {
      $modalBody.addClass('d-none');
    }

    // Set btn no
    if (!btnNoText) {
      btnNoText = $btnNo.attr('data-default-text')
    }

    $btnNo.off();
    $btnNo.text(btnNoText)
      .on('click', function (e) {
        e.preventDefault();

        if (typeof callbackNo === 'function') {
          callbackNo();
        }

        closeModal();
      });

    // Set btn yes
    if (!showBtnYes) {
      $btnYes.addClass('d-none');
      return;
    }

    $btnYes.off();

    if (!btnYesText) {
      btnYesText = $btnYes.attr('data-default-text')
    }

    $btnYes.removeClass('d-none')
      .text(btnYesText)
      .on('click', function (e) {
        e.preventDefault();

        if (typeof callbackYes === 'function') {
          callbackYes();
        }

        closeModal();
      });
  },

  showModal() {
    $('#adminConfirmModal').modal('show');
  }
}

export default modal;
