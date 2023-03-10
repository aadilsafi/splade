$((function () {
    "use strict";
    var e = "ltr";
    "rtl" == $("html").data("textdirection") && (e = "rtl");
    var t = document.getElementById("slider-handles"),
        n = document.getElementById("slider-snap"),
        i = document.getElementById("tap"),
        o = document.getElementById("drag"),
        r = document.getElementById("drag-fixed"),
        d = document.getElementById("hover"),
        l = document.getElementById("hover-val"),
        a = document.getElementById("combined"),
        c = document.getElementById("pips-range");
    void 0 !== typeof t && null !== t && noUiSlider.create(t, {
        start: [4e3, 8e3],
        direction: e,
        range: {
            min: [2e3],
            max: [1e4]
        }
    }), void 0 !== typeof n && null !== n && noUiSlider.create(n, {
        start: [0, 500],
        direction: e,
        snap: !0,
        connect: !0,
        range: {
            min: 0,
            "10%": 50,
            "20%": 100,
            "30%": 150,
            "40%": 500,
            "50%": 800,
            max: 1e3
        }
    }), void 0 !== typeof i && null !== i && noUiSlider.create(i, {
        start: [20, 40],
        direction: e,
        behaviour: "tap",
        connect: !0,
        range: {
            min: 10,
            max: 50
        }
    }), void 0 !== typeof o && null !== o && noUiSlider.create(o, {
        start: [40, 60],
        direction: e,
        behaviour: "drag",
        connect: !0,
        range: {
            min: 20,
            max: 80
        }
    }), void 0 !== typeof r && null !== r && noUiSlider.create(r, {
        start: [40, 60],
        direction: e,
        behaviour: "drag-fixed",
        connect: !0,
        range: {
            min: 20,
            max: 80
        }
    }), void 0 !== typeof d && null !== d && (noUiSlider.create(d, {
        start: 20,
        direction: e,
        behaviour: "hover-snap",
        range: {
            min: 0,
            max: 100
        }
    }), d.noUiSlider.on("hover", (function (e) {
        l.innerHTML = e
    }))), void 0 !== typeof a && null !== a && noUiSlider.create(a, {
        start: [40, 60],
        direction: e,
        behaviour: "drag-tap",
        connect: !0,
        range: {
            min: 20,
            max: 80
        }
    }), void 0 !== typeof c && null !== c && noUiSlider.create(c, {
        start: 10,
        step: 10,
        range: {
            min: 0,
            max: 100
        },
        tooltips: !0,
        direction: e,
        pips: {
            mode: "steps",
            stepped: !0,
            density: 5
        }
    });
    var m = document.getElementById("default-color-slider"),
        u = document.getElementById("secondary-color-slider"),
        s = document.getElementById("success-color-slider"),
        p = document.getElementById("info-color-slider"),
        v = document.getElementById("warning-color-slider"),
        g = document.getElementById("danger-color-slider"),
        y = {
            start: [40, 60],
            connect: !0,
            behaviour: "drag",
            connect: !0,
            step: 10,
            tooltips: !0,
            range: {
                min: 0,
                max: 100
            },
            pips: {
                mode: "steps",
                stepped: !0,
                density: 5
            },
            direction: e
        };
    void 0 !== typeof m && null !== m && noUiSlider.create(m, y), void 0 !== typeof u && null !== u && noUiSlider.create(u, y), void 0 !== typeof s && null !== s && noUiSlider.create(s, y), void 0 !== typeof p && null !== p && noUiSlider.create(p, y), void 0 !== typeof v && null !== v && noUiSlider.create(v, y), void 0 !== typeof g && null !== g && noUiSlider.create(g, y);
    var f = document.getElementById("slider-vertical"),
        h = document.getElementById("connect-upper"),
        E = document.getElementById("slider-tooltips"),
        S = document.getElementById("vertical-limit");
    void 0 !== typeof f && null !== f && (f.style.height = "200px", noUiSlider.create(f, {
        start: 20,
        direction: e,
        orientation: "vertical",
        range: {
            min: 0,
            max: 100
        }
    })), void 0 !== typeof h && null !== h && (h.style.height = "200px", noUiSlider.create(h, {
        start: 30,
        direction: e,
        orientation: "vertical",
        connect: "upper",
        range: {
            min: 0,
            max: 100
        }
    })), void 0 !== typeof E && null !== E && (E.style.height = "200px", noUiSlider.create(E, {
        start: [20, 80],
        direction: e,
        orientation: "vertical",
        tooltips: [wNumb({
            decimals: 1
        }), wNumb({
            decimals: 1
        })],
        range: {
            min: 0,
            max: 100
        }
    })), void 0 !== typeof S && null !== S && (S.style.height = "200px", noUiSlider.create(S, {
        start: [40, 60],
        direction: e,
        orientation: "vertical",
        limit: 40,
        behaviour: "drag",
        connect: !0,
        range: {
            min: 0,
            max: 100
        }
    }));
    var U = document.getElementById("slider-select"),
        x = document.getElementById("slider-with-input"),
        B = document.getElementById("slider-input-number");
    if (void 0 !== typeof x && null !== x && (noUiSlider.create(x, {
            start: [10, 30],
            direction: e,
            connect: !0,
            range: {
                min: -20,
                max: 40
            }
        }), x.noUiSlider.on("update", (function (e, t) {
            var n = e[t];
            t ? B.value = n : U.value = Math.round(n)
        }))), void 0 !== typeof x && null !== x) {
        for (var I = -20; I <= 40; I++) {
            var b = document.createElement("option");
            b.text = I, b.value = I, U.appendChild(b)
        }
        U.addEventListener("change", (function () {
            x.noUiSlider.set([this.value, null])
        }))
    }
    void 0 !== typeof B && null !== B && B.addEventListener("change", (function () {
        x.noUiSlider.set([null, this.value])
    }))
}));
