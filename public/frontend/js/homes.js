! function(a) {
    a.fn.animatedModal = function(n) {
        function o() {
            m.css({
                "z-index": e.zIndexOut
            }), e.afterClose()
        }

        function t() {
            e.afterOpen()
        }
        var i = a(this),
            e = a.extend({
                modalTarget: "animatedModal",
                position: "fixed",
                width: "100%",
                height: "100%",
                top: "0px",
                left: "0px",
                zIndexIn: "9999",
                zIndexOut: "-9999",
                color: "#39BEB9",
                opacityIn: "1",
                opacityOut: "0",
                animatedIn: "zoomIn",
                animatedOut: "zoomOut",
                animationDuration: ".6s",
                overflow: "auto",
                beforeOpen: function() {},
                afterOpen: function() {},
                beforeClose: function() {},
                afterClose: function() {}
            }, n),
            d = a(".close-" + e.modalTarget),
            s = a(i).attr("href"),
            m = a("body").find("#" + e.modalTarget),
            l = "#" + m.attr("id");
        m.addClass("animated"), m.addClass(e.modalTarget + "-off");
        var r = {
            position: e.position,
            width: e.width,
            height: e.height,
            top: e.top,
            left: e.left,
            "background-color": e.color,
            "overflow-y": e.overflow,
            "z-index": e.zIndexOut,
            opacity: e.opacityOut,
            "-webkit-animation-duration": e.animationDuration,
            "-moz-animation-duration": e.animationDuration,
            "-ms-animation-duration": e.animationDuration,
            "animation-duration": e.animationDuration
        };
        m.css(r), i.click(function(n) {
            n.preventDefault(), a("body, html").css({
                overflow: "hidden"
            }), s == l && (m.hasClass(e.modalTarget + "-off") && (m.removeClass(e.animatedOut), m.removeClass(e.modalTarget + "-off"), m.addClass(e.modalTarget + "-on")), m.hasClass(e.modalTarget + "-on") && (e.beforeOpen(), m.css({
                opacity: e.opacityIn,
                "z-index": e.zIndexIn
            }), m.addClass(e.animatedIn), m.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", t)))
        }), d.click(function(n) {
            n.preventDefault(), a("body, html").css({
                overflow: "auto"
            }), e.beforeClose(), m.hasClass(e.modalTarget + "-on") && (m.removeClass(e.modalTarget + "-on"), m.addClass(e.modalTarget + "-off")), m.hasClass(e.modalTarget + "-off") && (m.removeClass(e.animatedIn), m.addClass(e.animatedOut), m.one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", o))
        })
    }
}(jQuery);

! function(n, r) {
    function e(n) {
        return !!("" === n || n && n.charCodeAt && n.substr)
    }

    function t(n) {
        return p ? p(n) : "[object Array]" === l.call(n)
    }

    function o(n) {
        return n && "[object Object]" === l.call(n)
    }

    function a(n, r) {
        var e;
        n = n || {}, r = r || {};
        for (e in r) r.hasOwnProperty(e) && null == n[e] && (n[e] = r[e]);
        return n
    }

    function i(n, r, e) {
        var t, o, a = [];
        if (!n) return a;
        if (f && n.map === f) return n.map(r, e);
        for (t = 0, o = n.length; t < o; t++) a[t] = r.call(e, n[t], t, n);
        return a
    }

    function u(n, r) {
        return n = Math.round(Math.abs(n)), isNaN(n) ? r : n
    }

    function c(n) {
        var r = s.settings.currency.format;
        return "function" == typeof n && (n = n()), e(n) && n.match("%v") ? {
            pos: n,
            neg: n.replace("-", "").replace("%v", "-%v"),
            zero: n
        } : n && n.pos && n.pos.match("%v") ? n : e(r) ? s.settings.currency.format = {
            pos: r,
            neg: r.replace("%v", "-%v"),
            zero: r
        } : r
    }
    var s = {};
    s.version = "0.4.1", s.settings = {
        currency: {
            symbol: "$",
            format: "%s%v",
            decimal: ".",
            thousand: ",",
            precision: 2,
            grouping: 3
        },
        number: {
            precision: 0,
            grouping: 3,
            thousand: ",",
            decimal: "."
        }
    };
    var f = Array.prototype.map,
        p = Array.isArray,
        l = Object.prototype.toString,
        m = s.unformat = s.parse = function(n, r) {
            if (t(n)) return i(n, function(n) {
                return m(n, r)
            });
            if (n = n || 0, "number" == typeof n) return n;
            r = r || s.settings.number.decimal;
            var e = new RegExp("[^0-9-" + r + "]", ["g"]),
                o = parseFloat(("" + n).replace(/\((.*)\)/, "-$1").replace(e, "").replace(r, "."));
            return isNaN(o) ? 0 : o
        },
        d = s.toFixed = function(n, r) {
            r = u(r, s.settings.number.precision);
            var e = Math.pow(10, r);
            return (Math.round(s.unformat(n) * e) / e).toFixed(r)
        },
        g = s.formatNumber = s.format = function(n, r, e, c) {
            if (t(n)) return i(n, function(n) {
                return g(n, r, e, c)
            });
            n = m(n);
            var f = a(o(r) ? r : {
                    precision: r,
                    thousand: e,
                    decimal: c
                }, s.settings.number),
                p = u(f.precision),
                l = n < 0 ? "-" : "",
                h = parseInt(d(Math.abs(n || 0), p), 10) + "",
                y = h.length > 3 ? h.length % 3 : 0;
            return l + (y ? h.substr(0, y) + f.thousand : "") + h.substr(y).replace(/(\d{3})(?=\d)/g, "$1" + f.thousand) + (p ? f.decimal + d(Math.abs(n), p).split(".")[1] : "")
        },
        h = s.formatMoney = function(n, r, e, f, p, l) {
            if (t(n)) return i(n, function(n) {
                return h(n, r, e, f, p, l)
            });
            n = m(n);
            var d = a(o(r) ? r : {
                    symbol: r,
                    precision: e,
                    thousand: f,
                    decimal: p,
                    format: l
                }, s.settings.currency),
                y = c(d.format),
                b = n > 0 ? y.pos : n < 0 ? y.neg : y.zero;
            return b.replace("%s", d.symbol).replace("%v", g(Math.abs(n), u(d.precision), d.thousand, d.decimal))
        };
    s.formatColumn = function(n, r, f, p, l, d) {
        if (!n) return [];
        var h = a(o(r) ? r : {
                symbol: r,
                precision: f,
                thousand: p,
                decimal: l,
                format: d
            }, s.settings.currency),
            y = c(h.format),
            b = y.pos.indexOf("%s") < y.pos.indexOf("%v"),
            v = 0,
            x = i(n, function(n, r) {
                if (t(n)) return s.formatColumn(n, h);
                n = m(n);
                var e = n > 0 ? y.pos : n < 0 ? y.neg : y.zero,
                    o = e.replace("%s", h.symbol).replace("%v", g(Math.abs(n), u(h.precision), h.thousand, h.decimal));
                return o.length > v && (v = o.length), o
            });
        return i(x, function(n, r) {
            return e(n) && n.length < v ? b ? n.replace(h.symbol, h.symbol + new Array(v - n.length + 1).join(" ")) : new Array(v - n.length + 1).join(" ") + n : n
        })
    }, "undefined" != typeof exports ? ("undefined" != typeof module && module.exports && (exports = module.exports = s), exports.accounting = s) : "function" == typeof define && define.amd ? define([], function() {
        return s
    }) : (s.noConflict = function(e) {
        return function() {
            return n.accounting = e, s.noConflict = r, s
        }
    }(n.accounting), n.accounting = s)
}(this);

"use strict";


function init() {
    for (var e = document.getElementsByClassName("js--answer-image"), t = 0; t < e.length; t++) e[t].getAttribute("data-src") && (e[t].setAttribute("src", e[t].getAttribute("data-src")), e[t].removeAttribute("data-src"))
}
$(document).on("ready", function() {
    function e() {
        var e = $("#config"),
            t = {
                appType: e.data("type"),
                appLang: e.data("lang"),
                pricePerHour: e.data("pph"),
                useMultipliers: e.data("multi") || !1,
                currency: {
                    symbol: e.data("curr-symbol"),
                    symbolBefore: e.data("curr-symbol-before"),
                    thousand: e.data("curr-thousands"),
                    decimal: e.data("curr-decimal"),
                    exchangeRate: e.data("curr-exchange")
                },
                nextScreenDelay: 1e3
            };
        return accounting.settings.currency = {
            symbol: t.currency.symbol || "€",
            decimal: t.currency.decimal || ",",
            thousand: t.currency.thousand || ".",
            precision: 0,
            format: t.currency.symbolBefore ? "%s %v" : "%v %s"
        }, e.remove(), t
    }

    function t() {
        function e() {
            return M === !0
        }

        function t() {
            for (var e = m.useMultipliers, t = e ? 1 : 0, n = 0; n < j.length; n++) e ? t *= j[n].answerWeight : t += j[n].answerWeight * m.pricePerHour;
            return e ? t : t * m.currency.exchangeRate
        }

        function n() {
            var e = t();
            e = e > 1 ? accounting.formatMoney(e) : "", $(".js--price-progress").text(e)
        }

        function a() {
            d.all.hide()
        }

        function o() {
            a(), ga("multidomain.set", "page", "/ccm-" + m.appType), ga("multidomain.send", "pageview"), d.initial.fadeIn(600)
        }

        function r() {
            a(), d.results.fadeIn(600), ga("multidomain.set", "page", "/ccm-" + m.appType + "/result"), ga("multidomain.send", "pageview"), $(".js--form-questions").val(t()), $(".js--form-estimate").val(t())
        }

        function i(e) {
            a(), n(), ga("multidomain.set", "page", "/ccm-" + m.appType + "/step" + e), ga("multidomain.send", "pageview"), d.questions.filter('[data-question-id="' + e + '"]').fadeIn(600)
        }

        function s() {
            for (var e = j.length - 1; e >= 0; e--) {
                var n = j[e],
                    a = n.answerId,
                    o = n.answerText.trim(),
                    r = n.questionId,
                    i = d.results.find(".js--result").filter('[data-question-id="' + r + '"]');
                i.find(".js--result-answer").text(o), i.find(".js--result-image").attr({
                    src: "img/" + m.appType + "/answer-" + r + "-" + a + ".png",
                    alt: o
                })
            }
            var s = t();
            d.results.find(".js--total-price").text(accounting.formatMoney(s))
        }

        function u(e, t) {
            M = "undefined" != typeof t && t, a(), i(e)
        }

        function l() {
            s(), r()
        }

        function c() {
            u(1)
        }

        function f() {
            d.questions.find(".answer").removeClass("selected"), j = [], M = !1, o()
        }

        function g(e) {
            j.push(e)
        }

        function p() {
            j.pop(), n()
        }

        function v(e) {
            for (var t = j.length - 1; t >= 0; t--) j[t].questionId === e.questionId && (j[t] = e)
        }

        function h(e) {
            for (var t = j.length - 1; t >= 0; t--)
                if (j[t].questionId === e.questionId) return !1;
            return !0
        }

        function q(e, t) {
            var n = {
                questionId: e.data("question-id"),
                questionText: e.find(".question-title").text().trim(),
                answerId: t.data("answer-id"),
                answerText: t.text().trim(),
                answerWeight: t.data("answer-weight")
            };
            return e.data("pph") && (m.pricePerHour = n.answerWeight, n.answerWeight = 0), n
        }

        function w(t, n) {
            var a = d.questions.filter('[data-question-id="' + n + '"]'),
                o = a.find(".answer").filter('[data-answer-id="' + t + '"]'),
                r = q(a, o);
            a.find(".answer").removeClass("selected"), o.addClass("selected"), e() || !h(r.questionId) ? v(r) : g(r);
            var i = a.next().hasClass("results");
            setTimeout(function() {
                e() || i ? l() : u(n + 1)
            }, m.nextScreenDelay)
        }

        function T() {
            for (var e = $("#quoteForm"), t = e.find('[name="description"]').val(), n = e.find('[name="email"]').val(), a = e.find('[name="phone"]').val(), o = e.find('[name="name"]').val(), r = "", i = 0; i < j.length; i++) {
                var s = j[i];
                r += "<li>", r += "<span>" + s.questionId + " - " + s.questionText + ": </span>", r += "<b>" + s.answerText + "</b>", r += "</li>"
            }
            r = "<ul>" + r + "</ul>", e.find('input[name="questions"]').val(r);
            var u = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,
                l = u.test(n),
                c = !0;
            l && "" !== t && "" !== a && "" !== o || (c = !1), c && $.post("mailer.php", e.serialize(), function() {
                e.hide(), $(".form-sent-icon").fadeIn("fast")
            })
        }

        function y() {
            d.questions.each(function(e, t) {
                var n = $(t),
                    a = n.find(".answer").eq(0),
                    o = q(n, a);
                g(o)
            }), l()
        }
        var j = [],
            M = !1;
        return {
            start: c,
            restart: f,
            jumpToEnd: y,
            goToQuestion: u,
            selectAnswer: w,
            sendQuoteForm: T,
            removeLastAnswer: p
        }
    }

    function n() {
        ga("multidomain.send", "event", "GUI", "Button_Click", "start"), f.start()
    }

    function a(e) {
        var t = $(e.currentTarget),
            n = t.data("answer-id"),
            a = t.closest(".question").data("question-id");
        f.selectAnswer(n, a)
    }

    function o(e) {
        var t = $(e.currentTarget).closest(".result").data("question-id");
        f.goToQuestion(t, !0)
    }

    function r(e) {
        var t = $(e.currentTarget).closest(".question").data("question-id");
        t > 1 && f.goToQuestion(t - 1, !1), f.removeLastAnswer()
    }

    function i() {
        f.restart()
    }

    function s(e) {
        e.preventDefault(), $(".js--results-summary").slideToggle()
    }

    function u() {
        ga("multidomain.send", "event", "GUI", "Button_Click", "publish_project")
    }

    function l(e) {
        e.preventDefault(), f.sendQuoteForm()
    }

    function c() {
        var e = d.questions.eq(0).find(".question-title"),
            t = e.html().split(" ");
        t[1] = "<span>" + t[1] + "</span>", e.html(t.join(" ")), e.on("click", "span", function() {
            var e = (new Date).getTime(),
                t = $(this).data("lastTouch") || e + 1,
                n = e - t;
            n > 0 && n < 500 && f.jumpToEnd(), $(this).data("lastTouch", e)
        })
    }
    var d = {
            all: $(".section"),
            initial: $(".initial"),
            results: $(".results"),
            questions: $(".question")
        },
        m = e(),
        f = new t;
    d.initial.on("click", ".js--start", n), d.questions.on("click", ".js--answer", a), d.questions.on("click", ".js--previous", r), d.results.on("click", ".js--change", o), d.results.on("click", ".js--restart", i), d.results.on("click", ".js--toggle-results", s), d.results.on("click", ".js--start-project", u), $("#quoteForm").on("click", ".js--form-send", l), c();
    var g = {
        color: $("body").data("theme-color")
    };
    $("#legalModalTrigger").animatedModal({
        modalTarget: "legalModal",
        color: g.color
    }), $("#findUsModalTrigger").animatedModal({
        modalTarget: "findUsModal",
        color: g.color
    }), $("#aboutModalTrigger").animatedModal({
        modalTarget: "aboutModal",
        color: g.color
    }), $("#quoteModalTrigger").animatedModal({
        modalTarget: "quoteModal",
        color: g.color
    }), $("#moreInfoModalModalTrigger").animatedModal({
        modalTarget: "moreInfoModal",
        color: g.color
    }), $("#moreInfoModalModalTrigger").on("click", function() {
        $(".modal-more-info").show()
    })
}), window.onload = init;