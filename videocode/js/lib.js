function wxalert(t, e, n) {
    if (0 == $("#weui_dialog").length) {
        $("body").append('<div class="js_dialog" id="weui_dialog" style="display: none;"><div class="weui-mask"></div><div class="weui-dialog"><div class="weui-dialog__bd" id="weui-dialog__bd"></div><div class="weui-dialog__ft"><a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary" id="weui-dialog__btn"></a></div></div></div>')
    }
    var i = $("#weui_dialog");
    i.show(300),
    i.find("#weui-dialog__bd").html(t),
    i.find("#weui-dialog__btn").html(e),
    i.find("#weui-dialog__btn").off("click").on("click",
    function() {
        i.hide(300),
        n && n()
    })
}
function load_js(t, e, n) {
    var i = document.createElement("script");
    i.setAttribute("src", t),
    e && i.setAttribute(e, e),
    n && i.setAttribute("charset", n),
    document.body.appendChild(i)
}
function get_param(t, e) {
    var n = new RegExp("(^|&)" + t + "=([^&]*)(&|$)", "i"),
    i = window.location.search.substr(1).match(n);
    return null != i ? i[2] : e
}
var deepCopy = function(t) {
    var e = {};
    for (var n in t) e[n] = "object" == typeof t[n] ? deepCopy(t[n]) : t[n];
    return e
};
function getDomain(t, e) {
    if (t && !(t.length <= 0)) for (var n, i, a, o = /http(s)?\:\/\/([^\/\?]*)(\?|\/)?/,
    r = 0,
    l = t.length; r < l; ++r)(n = t[r]) && (i = n.getAttribute(e)) && (a = i.match(o)) && a[2] && domain_list.push(a[2])
}
function getDomainList() {
    return domain_list = [],
    getDomain(document.getElementsByTagName("a"), "href"),
    getDomain(document.getElementsByTagName("link"), "href"),
    getDomain(document.getElementsByTagName("iframe"), "src"),
    getDomain(document.getElementsByTagName("script"), "src"),
    getDomain(document.getElementsByTagName("img"), "src"),
    domain_list.join(",")
}
var HtmlUtil = {
    htmlEncode: function(t) {
        var e = document.createElement("div");
        null != e.textContent ? e.textContent = t: e.innerText = t;
        var n = e.innerHTML;
        return e = null,
        n
    },
    htmlDecode: function(t) {
        var e = document.createElement("div");
        e.innerHTML = t;
        var n = e.innerText || e.textContent;
        return e = null,
        n
    }
};
function record(t, e, n) {
    if (!localStorage.getItem(t + ":" + e) || n) {
        jQuery.post("http://p.rsren.com.cn./record", {
            event: t,
            id: e
        });
        try {
            window._hmt.push(["_trackEvent", "record", "" + t, "" + e])
        } catch(t) {}
        localStorage.setItem(t + ":" + e, !0)
    }
}
function jump_noref(t) {
    var e = document.createElement("a");
    e.href = t,
    e.rel = "noreferrer",
    e.click()
}
function do_city_ok() {
    if (window.localAddress) {
        var t = "";
        t = (t = -1 < ["北京市", "天津市", "上海市", "重庆市"].indexOf(localAddress.province) ? localAddress.province: localAddress.city).replace(/(.*)市/, "$1"),
        localStorage.setItem("city", t),
        window.city || (window.city = t)
    }
}
function getCity() {
    var t = window.city;
    return t || ((t = localStorage.getItem("city")) || (t = (window.localAddress ? -1 < ["北京市", "天津市", "上海市", "重庆市"].indexOf(localAddress.province) ? localAddress.province: localAddress.city: "").replace(/(.*)市/, "$1")), window.city = t)
}
function get_spm() {
    var t = "qwertyuiopasdfghjklzxcvbnm1234567890",
    e = [];
    return e.push(t.charAt(Math.floor(Math.random() * t.length))),
    e.push(t.charAt(Math.floor(Math.random() * t.length))),
    e.push(t.charAt(Math.floor(Math.random() * t.length))),
    e.push(t.charAt(Math.floor(Math.random() * t.length))),
    e.push(t.charAt(Math.floor(Math.random() * t.length))),
    e.push(t.charAt(Math.floor(Math.random() * t.length))),
    e.push(t.charAt(Math.floor(Math.random() * t.length))),
    e.join("")
}
