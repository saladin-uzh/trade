var main=function(){var t=null;$("#jur, #fiz").click(function(){var a=$("input:checked").attr("id"),e=$("#register");t!==a&&(e.slideUp(500,function(){e.load("assets/"+a+".html",function(){e.slideDown(500),e.css("display","flex")})}),t=a)}),$("#register").submit(function(t){var a=!1,e=!1,r=!1,s=!1,n=!1,i=!1,l={mail:$(".error-mail"),password:$(".error-pass"),address:$(".error-address"),number:$(".error-number"),name:$(".error-name"),post:$(".error-post")},p=function(){var t=$("#email").val();$.ajax({async:!1,url:"scripts/php/regDataValid.php",type:"POST",dataType:"text",data:{value:t,type:"email"},success:function(t){switch(t){case"permitted":a=!0,l.mail.hide(300);break;case"denied":l.mail.show(300);break;default:$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}},error:function(t,a,e){$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "'+a+'":<br>'+t.status+" - "+e+'<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}})},o=function(){var t=$("#number").val();$.ajax({async:!1,url:"scripts/php/regDataValid.php",type:"POST",dataType:"text",data:{value:t,type:"number"},success:function(t){switch(t){case"permitted":e=!0,l.number.hide(300);break;case"denied":l.number.show(300);break;default:$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}},error:function(t,a,e){$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "'+a+'":<br>'+t.status+" - "+e+'<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}})},d=function(){var t=$("#j-zip").val()+", "+$("#j-country").val()+", "+$("#j-region").val()+" область, ";""!==$("#j-district").val()&&(t+=$("#j-district").val()+" район, "),t+=$("#j-city").val()+", вул. "+$("#j-street").val()+", "+$("#j-streetnum").val()+"/"+$("#j-doornum").val(),$.ajax({async:!1,url:"scripts/php/regDataValid.php",type:"POST",dataType:"text",contentType:'text/plain; charset="utf-8"',data:{value:t,type:"address"},success:function(t){switch(t){case"permitted":r=!0,l.address.hide(300);break;case"denied":l.address.show(300);break;default:$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}},error:function(t,a,e){$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "'+a+'":<br>'+t.status+" - "+e+'<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}})},c=function(){var t=$("#full-name").val();$.ajax({async:!1,url:"scripts/php/regDataValid.php",type:"POST",dataType:"text",contentType:'text/plain; charset="utf-8"',data:{value:t,type:"name"},success:function(t){switch(t){case"permitted":n=!0,l.name.hide(300);break;case"denied":l.name.show(300);break;default:$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Не вдалося підключитися до бази даних:<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}},error:function(t,a,e){$("main").empty().html('<h1>Виникла проблема!</h1><p class="status" style="font-size: 30px; font-weight: bold; margin: 0 auto; padding: 10px; text-align: center;">Сервер надіслав відповідь "'+a+'":<br>'+t.status+" - "+e+'<br>Спробуйте <a href="reg.html">Перезавантажити сторінку.</a><br>Якщо проблема не зникне, зверніться, будь ласка, до адміністрації сайту.</p>')}})},u=function(){var t=$("#password").val();$("#password-confirm").val()===t?(s=!0,l.password.hide(300)):l.password.show(300)},h=function(){""!==$("#country").val()&&""!==$("#city").val()&&""!==$("#zip").val()&&""!==$("#street").val()&&""!==$("#streetnum").val()||(""===$("#country").val()&&""===$("#city").val()&&""===$("#region").val()&&""===$("#zip").val()&&""===$("#street").val()&&""===$("#streetnum").val()&&""===$("#doornum").val()?(l.post.hide(300),i=!0):(l.post.show(300),i=!1))};(function(){return c(),p(),o(),u(),d(),h(),n&&a&&e&&s&&r&&i})()||t.preventDefault()})};$(document).ready(main);