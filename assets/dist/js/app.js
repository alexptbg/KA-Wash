$(document).ready(function() {
  "use strict";
  $(".animsition").animsition({
    inClass: "fade-in",
    outClass: "fade-out",
    inDuration: 1500,
    outDuration: 800,
    linkElement: ".animsition-link",
    loading: !0,
    loadingParentElement: "body",
    loadingClass: "animsition-loading",
    loadingInner: "",
    timeout: !1,
    timeoutCountdown: 5e3,
    onLoadEvent: !0,
    browser: ["animation-duration", "-webkit-animation-duration"],
    overlay: !1,
    overlayClass: "animsition-overlay-slide",
    overlayParentElement: "body",
    transition: function(e) {
      window.location.href = e
    }
  }), $(function() {
    $(window).bind("load resize", function() {
      var e = 70,
        n = this.window.innerWidth > 0 ? this.window.innerWidth : this.screen.width;
      768 > n ? ($("div.navbar-collapse").addClass("collapse"), e = 100) : $("div.navbar-collapse").removeClass("collapse");
      var i = (this.window.innerHeight > 0 ? this.window.innerHeight : this.screen.height) - 1;
      i -= e, 1 > i && (i = 1), i > e && $("#page-wrapper").css("min-height", i + "px")
    });
    for (var e = window.location, n = $("ul.nav a").filter(function() {
        return this.href === e
      }).addClass("active").parent();;) {
      if (!n.is("li")) break;
      n = n.parent().addClass("in").parent()
    }
  }), "addEventListener" in document && document.addEventListener("DOMContentLoaded", function() {
    FastClick.attach(document.body)
  }, !1), $("body").append('<div id="toTop" class="btn back-top"><span class="ti-arrow-up"></span></div>'), $(window).on("scroll", function() {
    0 !== $(this).scrollTop() ? $("#toTop").fadeIn() : $("#toTop").fadeOut()
  }), $("#toTop").on("click", function() {
    return $("html, body").animate({
      scrollTop: 0
    }, 600), !1
  }), $("#side-menu").metisMenu();
  var e = window.innerHeight;
  $("#fullscreen-searchform").css("top", e / 2), jQuery(window).resize(function() {
    e = window.innerHeight, $("#fullscreen-searchform").css("top", e / 2)
  }), $(".search-trigger").click(function() {
    console.log("Open Search, Search Centered"), $("div.fullscreen-search-overlay").addClass("fullscreen-search-overlay-show")
  }), $("a.fullscreen-close").click(function() {
    console.log("Closed Search"), $("div.fullscreen-search-overlay").removeClass("fullscreen-search-overlay-show")
  }), $("#menu-toggle").on("click", function(e) {
    e.preventDefault(), $("#wrapper").toggleClass("toggled")
  }), $("ul.dropdown-menu [data-toggle=dropdown]").on("click", function(e) {
    e.preventDefault(), e.stopPropagation(), $(this).parent().siblings().removeClass("open"), $(this).parent().toggleClass("open")
  }), $(".material-ripple").on("click", function(e) {
    var n = $(this);
    0 === n.find(".material-ink").length && n.prepend("<div class='material-ink'></div>");
    var i = n.find(".material-ink");
    if (i.removeClass("animate"), !i.height() && !i.width()) {
      var t = Math.max(n.outerWidth(), n.outerHeight());
      i.css({
        height: t,
        width: t
      })
    }
    var o = e.pageX - n.offset().left - i.width() / 2,
      l = e.pageY - n.offset().top - i.height() / 2,
      s = n.data("ripple-color");
    i.css({
      top: l + "px",
      left: o + "px",
      background: s
    }).addClass("animate")
  }), $(function() {
    var e = function(e) {
        e.requestFullscreen ? e.requestFullscreen() : e.webkitRequestFullscreen ? e.webkitRequestFullscreen() : e.mozRequestFullScreen ? e.mozRequestFullScreen() : e.msRequestFullscreen ? e.msRequestFullscreen() : console.log("Fullscreen API is not supported.")
      },
      n = function() {
        document.exitFullscreen ? document.exitFullscreen() : document.webkitExitFullscreen ? document.webkitExitFullscreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.msExitFullscreen ? document.msExitFullscreen() : console.log("Fullscreen API is not supported.")
      },
      i = document.getElementById("fullscreen"),
      t = document.getElementById("fullscreen");
    i.addEventListener("click", function(n) {
      n.preventDefault(), e(document.documentElement)
    }), t.addEventListener("click", function(e) {
      e.preventDefault(), n()
    })
  }), $(".lobidrag").lobiPanel({
    sortable: !0,
    close: false,
    editTitle: false,
    unpin: false,
    expand: false,
    minimize: false,
    /*
    editTitle: {
      icon: "ti-pencil"
    },
    */
    /*
    unpin: {
      icon: "ti-move"
    },
    */
    reload: {
      icon: "ti-reload"
    },
    /*
    minimize: {
      icon: "ti-minus",
      icon2: "ti-plus"
    },
    */
    /*
    close: {
      icon: "ti-close",
    },
    */
    /*
    expand: {
      icon: "ti-fullscreen",
      icon2: "ti-fullscreen"
    }
    */
  }), $(".lobidisable").lobiPanel({
    reload: !1,
    close: !1,
    editTitle: !1,
    sortable: !0,
    unpin: {
      icon: "ti-move"
    },
    minimize: {
      icon: "ti-minus",
      icon2: "ti-plus"
    },
    expand: {
      icon: "ti-fullscreen",
      icon2: "ti-fullscreen"
    }
  })
});
$(function () {
    if(jQuery().validationEngine) {
        $("#forms").validationEngine({promptPosition : "bottomLeft:10"});;
    }
    $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
    $('.tooltip').tooltip({ trigger: "hover" });
    $('.dropdown').click(function() {
        $(this).tooltip('hide');
    });
    $('.buttons a').click(function() {
        $(this).tooltip('hide');
    });
    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
            modal.css('display', 'block');
        // Dividing by two centers the modal exactly, but dividing by three 
        // or four works better for larger screens.
        //dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 4));
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2)+' !important');
    }
    // Reposition when a modal is shown
    $('.modal').on('show.bs.modal', reposition);
    // Reposition when the window is resized
    $(window).on('resize', function() {
        $('.modal:visible').each(reposition);
    });
    $(".modal").on("hidden.bs.modal", function(){
        //$(".modal-body").html("");
        $(this).find('.modal-body').empty();
    });
    $(document).on("keypress", function(e) {
    	//console.log(e);
        if (e.ctrlKey && (e.which === 108)) {//l
            console.log( "You pressed CTRL + L" );
            window.location.href = "lock.php";
        }
    });
    $(".login-wrapper").fadeIn("slow");
});
