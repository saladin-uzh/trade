$(document).ready(function(){$(".fullscreen").click(function(){var e=document.documentElement;e.webkitRequestFullscreen?e.webkitRequestFullscreen():e.mozRequestFullscreen?e.mozRequestFullscreen():e.requestFullscreen(),$("#fullscreen").fadeOut(500)}),$("video").attr("autoplay","autoplay")});