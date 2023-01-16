import Vue from 'vue';
import 'jquery';
import 'bootstrap';
import customModal from '../common/modal';

new Vue({
  el: '#vue-company-index',
  delimiters: ['[[', ']]'],
  methods: {
    openModalConfirmRemoveCompany(e) {
      const $target = $(e.target);
      const $form = $target.closest('form');

      let modalConfig = {
        'title': window.msgConfirmRemove,
        'body': null,
        'btnYesText': window.msgModalBtnYesText,
        'callbackYes': () => {
          $form.submit();
        },
        'btnNoText': window.msgModalBtnNoText,
        'callbackNo': function () {
        },
      };

      customModal.initModal(modalConfig);
      customModal.showModal();
    }
  }
});
