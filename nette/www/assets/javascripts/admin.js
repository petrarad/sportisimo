function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

jQuery(document).ready(function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);

    jQuery('.flash').each(function() {
        let $this = jQuery(this)
        jQuery.jGrowl($this.text());
        $this.remove();
    });

    jQuery('.toggle[data-target]').each(function() {

        let $this = jQuery(this)
        let $target = jQuery($this.data('target'))
        let toggleIndicatorClass = $this.data('toggle-indicator') || 'toggle-active'
        let toggleClass = $this.data('toggle-class') || 'toggle'
        let persistentKey = $this.data('toggle-persistent')
        $this.on('click', function() {
            if($this.hasClass(toggleIndicatorClass)) {
                $target.removeClass(toggleClass)
                $this.removeClass(toggleIndicatorClass)
                if(persistentKey) {
                    setCookie(persistentKey, 0, 90);
                }
            } else {
                $target.addClass(toggleClass)
                $this.addClass(toggleIndicatorClass)
                if(persistentKey) {
                    setCookie(persistentKey, 1, 90);
                }
            }
        })
    })

})