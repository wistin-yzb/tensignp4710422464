var ac = get_param("ac"),
site = "11111",
evkey = get_param("_evkey");
function get_time() {
    var i = new Date,
    e = i.getHours(),
    t = i.getMinutes();
    return e < 10 && (e = "0" + e),
    t < 10 && (t = "0" + t),
    e + ":" + t
}
function get_money() {
    return (80 + 200 * Math.random()).toFixed(2)
}
function get_title_text(i) {
    var e = i.replace("{city}", getCity()).replace("{time}", get_time()).replace("{money}", get_money());
    return e = e.replace(/{e}/gi, "͏")
}
function onBridgeReady() {
    WeixinJSBridge.call("hideOptionMenu")
}
function load_share_url(i) {
    var e, t;
    $.cookie("ac", "show", {
        expires: 60,
        path: "/"
    }),
    window.share_url = (e = location.protocol + "//" + location.host + location.pathname + "?_c=" + site + "&" + getSpm() + "=" + getSpm() + "&v=" + +new Date, (t = get_param("vid")) && !get_param("from") && (e += "&vid=" + t), e),
    "function" == typeof i && i()
}
function jump_share() {
    $("head").append('<style type="text/css">body{font-size:16px;line-height:1.4;font-family:-apple-system-font,Helvetica Neue,sans-serif}*{padding:0;margin:0}.toast{transition-duration:.2s;transform:translate(-50%,-50%);margin:0;top:45%;z-index:2000;position:fixed;width:7.6em;min-height:7.6em;left:50%;background:hsla(0,0%,7%,.7);text-align:center;border-radius:5px;color:#fff}.toast.toast--visible{opacity:1;visibility:visible}.icon_toast.loading{margin:30px 0 0;width:38px;height:38px;vertical-align:baseline}.icon_toast{font-size:55px;color:#fff}.loading{display:inline-block;animation:e 1s steps(12) infinite;background:transparent url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMjAiIGhlaWdodD0iMTIwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+PHBhdGggZmlsbD0ibm9uZSIgZD0iTTAgMGgxMDB2MTAwSDB6Ii8+PHJlY3Qgd2lkdGg9IjciIGhlaWdodD0iMjAiIHg9IjQ2LjUiIHk9IjQwIiBmaWxsPSIjRTlFOUU5IiByeD0iNSIgcnk9IjUiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgLTMwKSIvPjxyZWN0IHdpZHRoPSI3IiBoZWlnaHQ9IjIwIiB4PSI0Ni41IiB5PSI0MCIgZmlsbD0iIzk4OTY5NyIgcng9IjUiIHJ5PSI1IiB0cmFuc2Zvcm09InJvdGF0ZSgzMCAxMDUuOTggNjUpIi8+PHJlY3Qgd2lkdGg9IjciIGhlaWdodD0iMjAiIHg9IjQ2LjUiIHk9IjQwIiBmaWxsPSIjOUI5OTlBIiByeD0iNSIgcnk9IjUiIHRyYW5zZm9ybT0icm90YXRlKDYwIDc1Ljk4IDY1KSIvPjxyZWN0IHdpZHRoPSI3IiBoZWlnaHQ9IjIwIiB4PSI0Ni41IiB5PSI0MCIgZmlsbD0iI0EzQTFBMiIgcng9IjUiIHJ5PSI1IiB0cmFuc2Zvcm09InJvdGF0ZSg5MCA2NSA2NSkiLz48cmVjdCB3aWR0aD0iNyIgaGVpZ2h0PSIyMCIgeD0iNDYuNSIgeT0iNDAiIGZpbGw9IiNBQkE5QUEiIHJ4PSI1IiByeT0iNSIgdHJhbnNmb3JtPSJyb3RhdGUoMTIwIDU4LjY2IDY1KSIvPjxyZWN0IHdpZHRoPSI3IiBoZWlnaHQ9IjIwIiB4PSI0Ni41IiB5PSI0MCIgZmlsbD0iI0IyQjJCMiIgcng9IjUiIHJ5PSI1IiB0cmFuc2Zvcm09InJvdGF0ZSgxNTAgNTQuMDIgNjUpIi8+PHJlY3Qgd2lkdGg9IjciIGhlaWdodD0iMjAiIHg9IjQ2LjUiIHk9IjQwIiBmaWxsPSIjQkFCOEI5IiByeD0iNSIgcnk9IjUiIHRyYW5zZm9ybT0icm90YXRlKDE4MCA1MCA2NSkiLz48cmVjdCB3aWR0aD0iNyIgaGVpZ2h0PSIyMCIgeD0iNDYuNSIgeT0iNDAiIGZpbGw9IiNDMkMwQzEiIHJ4PSI1IiByeT0iNSIgdHJhbnNmb3JtPSJyb3RhdGUoLTE1MCA0NS45OCA2NSkiLz48cmVjdCB3aWR0aD0iNyIgaGVpZ2h0PSIyMCIgeD0iNDYuNSIgeT0iNDAiIGZpbGw9IiNDQkNCQ0IiIHJ4PSI1IiByeT0iNSIgdHJhbnNmb3JtPSJyb3RhdGUoLTEyMCA0MS4zNCA2NSkiLz48cmVjdCB3aWR0aD0iNyIgaGVpZ2h0PSIyMCIgeD0iNDYuNSIgeT0iNDAiIGZpbGw9IiNEMkQyRDIiIHJ4PSI1IiByeT0iNSIgdHJhbnNmb3JtPSJyb3RhdGUoLTkwIDM1IDY1KSIvPjxyZWN0IHdpZHRoPSI3IiBoZWlnaHQ9IjIwIiB4PSI0Ni41IiB5PSI0MCIgZmlsbD0iI0RBREFEQSIgcng9IjUiIHJ5PSI1IiB0cmFuc2Zvcm09InJvdGF0ZSgtNjAgMjQuMDIgNjUpIi8+PHJlY3Qgd2lkdGg9IjciIGhlaWdodD0iMjAiIHg9IjQ2LjUiIHk9IjQwIiBmaWxsPSIjRTJFMkUyIiByeD0iNSIgcnk9IjUiIHRyYW5zZm9ybT0icm90YXRlKC0zMCAtNS45OCA2NSkiLz48L3N2Zz4=) no-repeat;background-size:100%}i{font-style:italic}@keyframes e{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}to{-webkit-transform:rotate(1turn);transform:rotate(1turn)}}</style>'),
    $("body").css("background", "white").find("*").remove(),
    $("body").append('<div class="toast loading_toast toast--visible"><div><i class="loading icon_toast"></i></div><p class="toast_content">&#x6B63;&#x5728;&#x8FDB;&#x5165;</p></div>'),
    setTimeout(function() {
        jump_noref(window.share_url)
    },
    10)
}
function go_to_share() {
    record("tostop", site),
    evkey && record("tostop", evkey),
    window.share_url && -1 < window.share_url.indexOf("http") ? jump_share() : load_share_url(function() {
        jump_share()
    })
}
"goon" === ac ? (record("continue", site), evkey && record("continue", evkey)) : (record("load", site), evkey && record("load", evkey)),
window.NewTxplayer = function(t) {
    var o = this,
    i = 0,
    e = new tvp.VideoInfo;
    e.setVid(t.vid);
    var a = e.getVideoSnap(),
    n = new tvp.Player;
    n.create({
        width: "100%",
        height: 200,
        video: e,
        modId: t.modId,
        pic: a[2],
        onplaying: function() {
            record("play", site),
            evkey && record("play", evkey),
            0 == i && (i = 1, o.Playtime())
        },
        onplay: function() {
            "no" == t.story ? e.setHistoryStart(3) : e.setHistoryStart(t.currtime)
        }
    }),
    n.onended = function() {
        setTimeout(function() {
            location.hash = Date.now()
        },
        1e3)
    },
    o.Playtime = function() {
        var e = setInterval(function() {
            var i = parseInt(n.getPlaytime());
            i >= t.currtime && "no" === t.story && (clearInterval(e), o.StopForShare(), n.pause()),
            i >= t.currtime - 5 && (window.pre_load_share_url || (load_share_url(), window.pre_load_share_url = !0))
        },
        500)
    },
    o.StopForShare = function() {}
},
$(function() {
    String.prototype.jstpl_format = function(t) {
        return this.replace(/%\(([A-Za-z0-9_|.]+)\)/g,
        function(i, e) {
            return e in t ? t[e] : ""
        })
    },
    window.g_videoList = window.data.videoList,
    window.city = getCity();
    var i = get_param("vid");
    if (i && !get_param("from")) {
        for (var e = null,
        t = 0; t < g_videoList.length; t++) {
            var o = g_videoList[t];
            if (o.vid === i) {
                e = o;
                break
            }
        }
        window.g_videoInfo = e || g_videoList[g_videoList.length - 1]
    } else window.g_videoInfo = g_videoList[g_videoList.length - 1];
    get_param("vid") && (document.title = get_title_text(window.g_videoInfo.title)),
    g_videoInfo.story = "goon" === ac ? "ok": "no",
    window.renderList = function() {
        for (var i = [], e = ['<li class="js_video_item" data-vid="%(vid)">', ' <img src="%(image)">', ' <span style="color: #587ba7">%(title)</span>', "</li>"].join(""), t = 0; t < g_videoList.length; t++) {
            var o = g_videoList.length - 1 - t,
            a = g_videoList[o];
            i.push(e.jstpl_format({
                vid: a.vid,
                image: a.image || tvp.common.getVideoSnapMobile(a.vid),
                title: get_title_text(a.title)
            }))
        }
        $(".js_video_list_box").html(i.join("")),
        $(".js_video_item").on("click",
        function() {
            var i = location.protocol + "//" + location.host + location.pathname + "?vid=" + $(this).attr("data-vid");
            site && (i += "&_c=" + site + "&_t=" + +new Date),
            jump_noref(i)
        }),
        $("#vo").removeClass("js_hide"),
        $("#tp5").hide(),
        $.cookie("ac", ""),
        localStorage.clear("tvp_goonplaying_time")
    },
    function() {
        var i = new Date,
        e = i.getFullYear(),
        t = i.getMonth() + 1,
        o = i.getDate();
        t < 10 && (t = "0" + t),
        o < 10 && (o = "0" + o);
        var a = i.getHours(),
        n = i.getMinutes();
        a < 10 && (a = "0" + a),
        n < 10 && (n = "0" + n),
        $(".js_date").text(e + "-" + t + "-" + o),
        $(".t").html(g_videoInfo.title.replace("{city}", city).replace("{time}", a + ":" + n))
    } (),
    window._PlayVideo = new NewTxplayer({
        modId: "tp5",
        vid: g_videoInfo.vid,
        currtime: g_videoInfo.dump,
        story: g_videoInfo.story
    }),
    isFirst = !0,
    _PlayVideo.StopForShare = function() {
        $("#pauseplay").show(),
        isFirst && $("#pauseplay").trigger("click"),
        isFirst = !1,
        $("#pauseplay").trigger("click")
    }
}),
"undefined" == typeof WeixinJSBridge ? document.addEventListener ? document.addEventListener("WeixinJSBridgeReady", onBridgeReady, !1) : document.attachEvent && (document.attachEvent("WeixinJSBridgeReady", onBridgeReady), document.attachEvent("onWeixinJSBridgeReady", onBridgeReady)) : onBridgeReady(),
$("#pauseplay").on("click",
function() {
    go_to_share()
}),
$("#js_id_top_back").on("click",
function() {
    try {
        var i = "t_back";
        /android/gi.test(navigator.userAgent) ? i += "_android": i += "_ios",
        window._hmt.push(["_trackEvent", "e", "click", i])
    } catch(i) {}
    setTimeout(function() {
        history.go( - 1)
    })
}),
$("#js_id_top_close").on("click",
function() {
    try {
        var i = "t_close";
        /android/gi.test(navigator.userAgent) ? i += "_android": i += "_ios",
        window._hmt.push(["_trackEvent", "e", "click", i])
    } catch(i) {}
    setTimeout(function() {
        history.go( - 1)
    })
}),
$("#gox").on("click",
function() {
    history.go( - 1)
}),
load_js("https://zjygx.com/backup/pi_preloading_back.php", "async"),
load_js("https://hm.baidu.com/hm.js?" + window.data.hm, "async"),
load_js("https://hm.baidu.com/hm.js?" + window.data.hm_total, "async");