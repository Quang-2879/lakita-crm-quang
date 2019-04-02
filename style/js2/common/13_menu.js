/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 $(document).on({
 mousemove: function () {
 if ($('div.mega-dropdown-menu').is(":visible")) {
 $(".black-over").css('bottom', '0%');
 console.log(1);
 } else {
 $(".black-over").css('bottom', '100%');
 }
 },
 click: function () {
 if ($('div.mega-dropdown-menu').is(":visible")) {
 $(".black-over").css('bottom', '0%');
 console.log(1);
 } else {
 $(".black-over").css('bottom', '100%');
 }
 }
 }, 'body');
 */

$('li.mega-dropdown').mouseover(() => $(".black-over").css('bottom', '0%')).mouseout(() => $(".black-over").css('bottom', '100%'));

/*
 setInterval(function(){
 if ($('div.mega-dropdown-menu').is(":visible")) {
 $(".black-over").css('bottom', '0%');
 } else {
 $(".black-over").css('bottom', '100%');
 }
 },100);
 */