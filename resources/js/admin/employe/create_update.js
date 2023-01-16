import Vue from 'vue';
import 'jquery';
import 'bootstrap';
import customModal from "../common/modal";

new Vue({
  el: '#vue-employe-create',
  delimiters: ['[[', ']]'],
  data: {
  },
  methods: {
    confirmBack(url) {
      customModal.initModal({
        'title': window.msgConfirmBack,
        'btnYesText': window.msgModalBtnYesText,
        'btnNoText': window.msgModalBtnNoText,
        'callbackYes': function () {
          window.location.href = url
        },
        'callbackNo': function () {
        },
      });

      customModal.showModal();
    }
  }
});
