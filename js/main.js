/**
 * Custom scripts
 */

 jQuery(document).ready(function($){
    function parseUri (str) {
        var o   = parseUri.options,
            m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
            uri = {},
            i   = 14;

        while (i--) uri[o.key[i]] = m[i] || "";

        uri[o.q.name] = {};
        uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
            if ($1) uri[o.q.name][$1] = $2;
        });

        return uri;
    };

    parseUri.options = {
        strictMode: false,
        key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
        q:   {
            name:   "queryKey",
            parser: /(?:^|&)([^&=]*)=?([^&]*)/g
        },
        parser: {
            strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
            loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
        }
    };

    $('script').each(function() {
        var find = 'respond',
            parent_url = window.location.pathname;
            src = $(this).attr('src');

        if(typeof src !== 'undefined' && src.indexOf(find) != -1) {
            var url = parseUri(src),
                main = parseUri('<?php bloginfo("wpurl"); ?>'),
                replace = src.replace(url.host, main.host);

            $(this).attr('src', replace);

            var link1 = $('#respond-proxy').attr('href');
            var link1ok = link1.replace(main.host, url.host);
            var link2 = $('#respond-redirect').attr('href');
            var link2ok = link2.replace(url.host, main.host);

            $('#respond-proxy').attr('href', link1ok);
            $('#respond-redirect').attr('href', link2ok);
        }
    });
    $(document).foundation('topbar', {
        custom_back_text: true,
        back_text: "<?php _e('Back', 'smart_theme'); ?>",
        scrolltop: false,
        mobile_show_parent_link: true,
    });
});