import datepicker from 'js-datepicker';
import moment from 'moment';
import 'jquery';
import 'bootstrap';
import 'bootstrap-show-password';
import 'admin-lte';
import 'select2';
import 'simplebar';
import "bootstrap-datepicker";
import "bootstrap-datepicker/dist/locales/bootstrap-datepicker.ja.min";

// toast
$('.js-toast').toast('show');

// event bind
$(function () {
  // select2
  $('.js-select2').select2({
    width: '100%'
  });

  // datepicker
  $('.js-datepicker').each(function (index, input) {
    const option = {
      formatter: (input, date) => {
        input.value = moment(date).format('YYYY-MM-DD');
      },
    }
    input.value
      ? datepicker(input, option).setDate(moment(input.value).toDate(), true)
      : datepicker(input, option);
  });

  // datepicker
  $('.js-datepicker-mmdd').each(function (index, input) {
    const option = {
      formatter: (input, date) => {
        input.value = moment(date).format('MMDD');
      },
    }
    input.value
      ? datepicker(input, option).setDate(moment(input.value).toDate(), true)
      : datepicker(input, option);
  });

  // bootstrap datepicker
  $.fn.bsDatepicker = $.fn.datepicker.noConflict();
  $('.bs-datepicker-yyyymm').bsDatepicker({
    format: "yyyy-mm",
    viewMode: "months",
    minViewMode: "months",
    language: 'ja',
    autoclose: true
  });

  // group radio
  const groupRadio = $('.form-group-radio');
  $('label input[type="radio"]', groupRadio).each(function (index, input) {
    if($(this).is(':checked')) {
      $(this).parent().addClass('active');
      return false;
    }
  });

  $('label input[type="radio"]', groupRadio).on('click', function(){
    $('label', groupRadio).removeClass('active');

    if ($(this).is(':checked')) {
      $(this).parent().addClass('active');
    }
  });
});

// sidebar treeview
$(window).on('DOMContentLoaded', function () {
  // 要素を取得
  const $sections = $('.js-treeview-section');
  const $toggles = $('.js-treeview-toggle');
  const $navLinks = $('.js-nav-link');

  // storageからデータを取得
  let openTreeviewNames = localStorage.getItem('treeviewNames')
    ? localStorage.getItem('treeviewNames').split(',')
    : [];

  // メニューを展開
  $sections.each((_, section) => {
    const $section = $(section);

    if (openTreeviewNames.includes($section.attr('data-treeview-name'))) {
      $section.addClass('menu-open menu-open-override');
    }
  });

  // activeなlinkのstyle変更
  $navLinks.each((_, navLink) => {
    const $navLink = $(navLink);
    const navLinkUrl = `${$navLink.attr('href')}/`;
    const currentUrl = `${location.href}/`;

    if (currentUrl.indexOf(navLinkUrl) !== -1) {
      $navLink.addClass('active');
    }
  });

  // logoutしたらstorageを削除
  if (0 === $('.js-button-logout').length) {
    localStorage.removeItem('treeviewNames');
  }

  // storageにデータをセット
  $toggles.on('click', function () {
    const treeviewName = $(this).attr('data-treeview-name');
    const $section = $(`.js-treeview-section[data-treeview-name="${treeviewName}"]`)

    if (openTreeviewNames.includes(treeviewName)) {
      $section.removeClass('menu-open-override');
      openTreeviewNames = openTreeviewNames.filter(name => name !== treeviewName);
    } else {
      $section.addClass('menu-open-override');
      openTreeviewNames.push(treeviewName);
    }

    localStorage.setItem('treeviewNames', openTreeviewNames.join(','));
  });
});
