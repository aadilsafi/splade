! function (a, e, t) {
    "use strict";
    var i = t(".flatpickr-basic"),
        r = t(".flatpickr-time"),
        c = t(".flatpickr-date-time"),
        l = t(".flatpickr-multiple"),
        m = t(".flatpickr-range"),
        n = t(".flatpickr-human-friendly"),
        p = t(".flatpickr-disabled-range"),
        o = t(".flatpickr-inline");
    i.length && i.flatpickr(), r.length && r.flatpickr({
        enableTime: !0,
        noCalendar: !0
    }), c.length && c.flatpickr({
        enableTime: !0
    }), l.length && l.flatpickr({
        weekNumbers: !0,
        mode: "multiple",
        minDate: "today"
    }), m.length && m.flatpickr({
        mode: "range"
    }), n.length && n.flatpickr({
        altInput: !0,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d"
    }), p.length && p.flatpickr({
        dateFormat: "Y-m-d",
        disable: [{
            from: (new Date).fp_incr(2),
            to: (new Date).fp_incr(7)
        }]
    }), o.length && o.flatpickr({
        inline: !0
    }), t(".pickadate").pickadate(), t(".format-picker").pickadate({
        format: "mmmm, d, yyyy"
    }), t(".pickadate-limits").pickadate({
        min: [2019, 3, 20],
        max: [2019, 5, 28]
    }), t(".pickadate-disable").pickadate({
        disable: [1, [2019, 3, 6],
            [2019, 3, 20]
        ]
    }), t(".pickadate-translations").pickadate({
        formatSubmit: "dd/mm/yyyy",
        monthsFull: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthsShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Juin", "Juil", "Aou", "Sep", "Oct", "Nov", "Dec"],
        weekdaysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
        today: "aujourd'hui",
        clear: "clair",
        close: "Fermer"
    }), t(".pickadate-months").pickadate({
        selectYears: !1,
        selectMonths: !0
    }), t(".pickadate-months-year").pickadate({
        selectYears: !0,
        selectMonths: !0
    }), t(".pickadate-short-string").pickadate({
        weekdaysShort: ["S", "M", "Tu", "W", "Th", "F", "S"],
        showMonthsShort: !0
    }), t(".pickadate-firstday").pickadate({
        firstDay: 1
    }), t(".pickatime").pickatime(), t(".pickatime-format").pickatime({
        format: "T!ime selected: h:i a",
        formatLabel: "HH:i a",
        formatSubmit: "HH:i",
        hiddenPrefix: "prefix__",
        hiddenSuffix: "__suffix"
    }), t(".pickatime-formatlabel").pickatime({
        formatLabel: function (a) {
            var e = (a.pick - this.get("now").pick) / 60,
                t = e < 0 ? " !hours to now" : e > 0 ? " !hours from now" : "now";
            return "h:i a <sm!all>" + (e ? Math.abs(e) : "") + t + "</sm!all>"
        }
    }), t(".pickatime-min-max").pickatime({
        min: new Date(2015, 3, 20, 7),
        max: new Date(2015, 7, 14, 18, 30)
    }), t(".pickatime-intervals").pickatime({
        interval: 150
    }), t(".pickatime-disable").pickatime({
        disable: [3, 5, 7, 13, 17, 21]
    }), t(".pickatime-close-action").pickatime({
        closeOnSelect: !1,
        closeOnClear: !1
    })
}(window, document, jQuery);
