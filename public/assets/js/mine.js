function notify (cap,msg,bgcolor,color) {
	    var not = $.Notify({
	    	caption: cap,
	        content: msg,
	        timeout: 5000,
	        style:{background:bgcolor,color:color}
	    });
}
$(function() {
    $("textarea").allowTabChar();
});
(function($) {
    function pasteIntoInput(el, text) {
        el.focus();
        if (typeof el.selectionStart == "number") {
            var val = el.value;
            var selStart = el.selectionStart;
            el.value = val.slice(0, selStart) + text + val.slice(el.selectionEnd);
            el.selectionEnd = el.selectionStart = selStart + text.length;
        } else if (typeof document.selection != "undefined") {
            var textRange = document.selection.createRange();
            textRange.text = text;
            textRange.collapse(false);
            textRange.select();
        }
    }

    function allowTabChar(el) {
        $(el).keydown(function(e) {
            if (e.which == 9) {
                pasteIntoInput(this, "\t");
                return false;
            }
        });

        // For Opera, which only allows suppression of keypress events, not keydown
        $(el).keypress(function(e) {
            if (e.which == 9) {
                return false;
            }
        });
    }

    $.fn.allowTabChar = function() {
        if (this.jquery) {
            this.each(function() {
                if (this.nodeType == 1) {
                    var nodeName = this.nodeName.toLowerCase();
                    if (nodeName == "textarea" || (nodeName == "input" && this.type == "text")) {
                        allowTabChar(this);
                    }
                }
            })
        }
        return this;
    }
})(jQuery);
(function($)
{
/**
* Auto-growing textareas; technique ripped from Facebook
*
*
* http://github.com/jaz303/jquery-grab-bag/tree/master/javascripts/jquery.autogrow-textarea.js
*/
$.fn.autogrow = function(options)
{
return this.filter('textarea').each(function()
{
var self = this;
var $self = $(self);
var minHeight = $self.height();
var noFlickerPad = $self.hasClass('autogrow-short') ? 0 : parseInt($self.css('lineHeight')) || 0;
var settings = $.extend({
preGrowCallback: null,
postGrowCallback: null
}, options );
var shadow = $('<div></div>').css({
position: 'absolute',
top: -10000,
left: -10000,
width: $self.width(),
fontSize: $self.css('fontSize'),
fontFamily: $self.css('fontFamily'),
fontWeight: $self.css('fontWeight'),
lineHeight: $self.css('lineHeight'),
resize: 'none',
'word-wrap': 'break-word'
}).appendTo(document.body);
var update = function(event)
{
var times = function(string, number)
{
for (var i=0, r=''; i<number; i++) r += string;
return r;
};
var val = self.value.replace(/&/g, '&amp;')
.replace(/</g, '&lt;')
.replace(/>/g, '&gt;')
.replace(/\n$/, '<br/>&nbsp;')
.replace(/\n/g, '<br/>')
.replace(/ {2,}/g, function(space){ return times('&nbsp;', space.length - 1) + ' ' });
// Did enter get pressed? Resize in this keydown event so that the flicker doesn't occur.
if (event && event.data && event.data.event === 'keydown' && event.keyCode === 13) {
val += '<br />';
}
shadow.css('width', $self.width());
shadow.html(val + (noFlickerPad === 0 ? '...' : '')); // Append '...' to resize pre-emptively.
var newHeight=Math.max(shadow.height() + noFlickerPad, minHeight);
if(settings.preGrowCallback!=null){
newHeight=settings.preGrowCallback($self,shadow,newHeight,minHeight);
}
$self.height(newHeight);
if(settings.postGrowCallback!=null){
settings.postGrowCallback($self);
}
}
$self.change(update).keyup(update).keydown({event:'keydown'},update);
$(window).resize(update);
update();
});
};
})(jQuery);
$(function() {
	$('#copas').autogrow();
});


$("#copylagi").on('focus',function () {
	$("#copylagi").select();
});

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-66290767-1', 'auto');
  ga('send', 'pageview');
