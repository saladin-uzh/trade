var main=function(){var e=function(){$(".five-percent .value").text(function(){var e=0;return c.each(function(){$(this).is(".checked")&&(e+=parseInt($(this).children(".price-start").text()))}),.05*e+" грн."})},c=$(".lots tbody tr"),t=$("#bank-details"),i=$("#application");c.click(function(){var c=$(this).children(".check"),t=c.children("input");$(this).toggleClass("checked"),$(this).is(".checked")?(t.attr("checked","checked"),t.val("selected")):(t.removeAttr("checked"),t.val("")),e()}),t.change(function(){var e=$(this).val(),c=$(".bank-details");c.text(e),""!==e.trim()?c.css({color:"deepskyblue"}):c.css({color:"#97a29e"})}),i.children("#reset").click(function(){var t=$(".bank-details"),i=$(".lots td.check input");c.removeClass("checked"),i.removeAttr("checked"),e(),t.css({color:"#97a29e"}),t.text("Банківські реквізити заявника")})};$(document).ready(main);