// npm package: flatpickr
// github link: https://github.com/flatpickr/flatpickr

$(function() {
  'use strict';

  // date picker
  if($('#flatpickr-date').length) {
    flatpickr("#flatpickr-date", {
      wrap: true,
      dateFormat: "Y-m-d",
    });
  }

  // date range picker
  if($('#flatpickr-date-range').length) {
    flatpickr("#flatpickr-date-range", {
      mode: "range",
      wrap: true,
      dateFormat: "Y-m-d",
    });
  }

  // date range picker
  if($('.min-date-range').length) {
    flatpickr(".min-date-range", {
      mode: "range",
      wrap: true,
      dateFormat: "Y-m-d",
      minDate: "today",
    });
  }

  // time picker
  if($('#flatpickr-time').length) {
    flatpickr("#flatpickr-time", {
      wrap: true,
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
    });
  }

});
