!function($){var e=function(){var e=$(".section-wrapper-has-background");e.each(function(){var e=$(this).data("background");$(this).css("background-image","url("+e+")")})};$(".folded dt,.toggled dt").click(function(){$(this).toggleClass("unfolded").next("dd").toggleClass("unfolded")}),$(document).ready(function(){$("body").addClass("ready"),$(".home .spine-social-channels").clone().addClass("looseleaf").prependTo($(".socialize .column.one")),e(),$(".drop").click(function(){$(this).toggleClass("dropped")}),$(".action-item dt").on("click",function(){$(this).parents(".action-item").toggleClass("opened").siblings(".opened").removeClass("opened")}),$(document).mouseup(function(e){var n=$(".action-item");n.is(e.target)||0!==n.has(e.target).length||$(".action-item.opened").removeClass("opened")}),$(".fp-section").length&&$("main").fullpage({fixedElements:".main-header, .footer",verticalCentered:!1,touchSensitivity:10}),$(".row:first-of-type").hasClass("inspiring")&&$("body").addClass("inspiring-lead"),$(".slide").wrapInner('<span class="wrap"></span>'),$('[class^="id-"]').length&&$(".etape").click(function(){var e=$.grep(this.className.split(" "),function(e,n){return 0===e.indexOf("btn")}).join()})})}(jQuery);