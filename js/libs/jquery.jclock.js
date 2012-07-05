/*
* jQuery jclock - Clock plugin - v 2.3.2
* http://plugins.jquery.com/project/jclock
*
* Copyright (c) 2007-2011 Doug Sparling <http://www.dougsparling.com>
* Licensed under the MIT License:
* http://www.opensource.org/licenses/mit-license.php
*/
(function($) {
 
  $.fn.jclock = function(options) {
    var version = '2.3.2';
 
    // options
    var opts = $.extend({}, $.fn.jclock.defaults, options);
         
    return this.each(function() {
      $this = $(this);
      $this.timerID = null;
      $this.running = false;
 
      // Record keeping for seeded clock
      $this.increment = 0;
      $this.lastCalled = new Date().getTime();
 
      var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
 
      $this.format = o.format;
      $this.utc = o.utc;
      // deprecate utc_offset (v 2.2.0)
      $this.utcOffset = (o.utc_offset != null) ? o.utc_offset : o.utcOffset;
      $this.seedTime = o.seedTime;
      $this.timeout = o.timeout;
 
      $this.css({
        fontFamily: o.fontFamily,
        fontSize: o.fontSize,
        backgroundColor: o.background,
        color: o.foreground
      });
 
      // %a
      $this.daysAbbrvNames = new Array(7);
      $this.daysAbbrvNames[0] = "Sam";
      $this.daysAbbrvNames[1] = "Lun";
      $this.daysAbbrvNames[2] = "Mar";
      $this.daysAbbrvNames[3] = "Mer";
      $this.daysAbbrvNames[4] = "Jeu";
      $this.daysAbbrvNames[5] = "Ven";
      $this.daysAbbrvNames[6] = "Sam";
 
      // %A
      $this.daysFullNames = new Array(7);
      $this.daysFullNames[0] = "Dimanche";
      $this.daysFullNames[1] = "Lundi";
      $this.daysFullNames[2] = "Mardi";
      $this.daysFullNames[3] = "Mercredi";
      $this.daysFullNames[4] = "Jeudi";
      $this.daysFullNames[5] = "Vendredi";
      $this.daysFullNames[6] = "Samedi";
 
      // %b
      $this.monthsAbbrvNames = new Array(12);
      $this.monthsAbbrvNames[0] = "Jan";
      $this.monthsAbbrvNames[1] = "Fev";
      $this.monthsAbbrvNames[2] = "Mar";
      $this.monthsAbbrvNames[3] = "Avr";
      $this.monthsAbbrvNames[4] = "Mai";
      $this.monthsAbbrvNames[5] = "Jui";
      $this.monthsAbbrvNames[6] = "Jui";
      $this.monthsAbbrvNames[7] = "Aou";
      $this.monthsAbbrvNames[8] = "Sep";
      $this.monthsAbbrvNames[9] = "Oct";
      $this.monthsAbbrvNames[10] = "Nov";
      $this.monthsAbbrvNames[11] = "Dec";
 
      // %B
      $this.monthsFullNames = new Array(12);
      $this.monthsFullNames[0] = "Janvier";
      $this.monthsFullNames[1] = "Fevrier";
      $this.monthsFullNames[2] = "Mars";
      $this.monthsFullNames[3] = "Avril";
      $this.monthsFullNames[4] = "Mai";
      $this.monthsFullNames[5] = "Juin";
      $this.monthsFullNames[6] = "Juillet";
      $this.monthsFullNames[7] = "Aout";
      $this.monthsFullNames[8] = "Septembre";
      $this.monthsFullNames[9] = "Octobre";
      $this.monthsFullNames[10] = "Novembre";
      $this.monthsFullNames[11] = "Decembre";
 
      $.fn.jclock.startClock($this);
 
    });
  };
       
  $.fn.jclock.startClock = function(el) {
    $.fn.jclock.stopClock(el);
    $.fn.jclock.displayTime(el);
  }
 
  $.fn.jclock.stopClock = function(el) {
    if(el.running) {
      clearTimeout(el.timerID);
    }
    el.running = false;
  }
 
  /* if the frequency is "once every minute" then we have to make sure this happens
   * when the minute changes. */  
  // got this idea from digiclock http://www.radoslavdimov.com/jquery-plugins/jquery-plugin-digiclock/
  function getDelay(timeout) {
	  if (timeout == 60000) {
		  var now = new Date();
		  timeout = 60000 - now.getSeconds() * 1000; // number of seconds before the next minute
	  }
	  return timeout;
  }
  
  $.fn.jclock.displayTime = function(el) {
    var time = $.fn.jclock.currentTime(el);
    var formatted_time = $.fn.jclock.formatTime(time, el);
    el.attr('currentTime', time.getTime())
    el.html(formatted_time);
    el.timerID = setTimeout(function(){$.fn.jclock.displayTime(el)}, getDelay(el.timeout));
  }

  $.fn.jclock.currentTime = function(el) {
    if(typeof(el.seedTime) == 'undefined') {
      // Seed time not being used, use current time
      var now = new Date();
    } else {
      // Otherwise, use seed time with increment
      el.increment += new Date().getTime() - el.lastCalled;
      var now = new Date(el.seedTime + el.increment);
      el.lastCalled = new Date().getTime();
    }
 
    if(el.utc == true) {
      var localTime = now.getTime();
      var localOffset = now.getTimezoneOffset() * 60000;
      var utc = localTime + localOffset;
      var utcTime = utc + (3600000 * el.utcOffset);
      var now = new Date(utcTime);
    }

    return now
  }
 
  $.fn.jclock.formatTime = function(time, el) {
 
    var timeNow = "";
    var i = 0;
    var index = 0;
    while ((index = el.format.indexOf("%", i)) != -1) {
      timeNow += el.format.substring(i, index);
      index++;
 
      // modifier flag
      //switch (el.format.charAt(index++)) {
      //}
      
      var property = $.fn.jclock.getProperty(time, el, el.format.charAt(index));
      index++;
      
      //switch (switchCase) {
      //}
 
      timeNow += property;
      i = index
    }
 
    timeNow += el.format.substring(i);
    return timeNow;
  };
 
  $.fn.jclock.getProperty = function(dateObject, el, property) {
 
    switch (property) {
      case "a": // abbrv day names
          return (el.daysAbbrvNames[dateObject.getDay()]);
      case "A": // full day names
          return (el.daysFullNames[dateObject.getDay()]);
      case "b": // abbrv month names
          return (el.monthsAbbrvNames[dateObject.getMonth()]);
      case "B": // full month names
          return (el.monthsFullNames[dateObject.getMonth()]);
      case "d": // day 01-31
          return ((dateObject.getDate() < 10) ? "0" : "") + dateObject.getDate();
      case "H": // hour as a decimal number using a 24-hour clock (range 00 to 23)
          return ((dateObject.getHours() < 10) ? "0" : "") + dateObject.getHours();
      case "I": // hour as a decimal number using a 12-hour clock (range 01 to 12)
          var hours = (dateObject.getHours() % 12 || 12);
          return ((hours < 10) ? "0" : "") + hours;
      case "l": // hour as a decimal number using a 12-hour clock (range 1 to 12)
          var hours = (dateObject.getHours() % 12 || 12);
          //return ((hours < 10) ? "0" : "") + hours;
          return hours;
      case "m": // month number
          return (((dateObject.getMonth() + 1) < 10) ? "0" : "") + (dateObject.getMonth() + 1);
      case "M": // minute as a decimal number
          return ((dateObject.getMinutes() < 10) ? "0" : "") + dateObject.getMinutes();
      case "p": // either `am' or `pm' according to the given time value,
          // or the corresponding strings for the current locale
          return (dateObject.getHours() < 12 ? "am" : "pm");
      case "P": // either `AM' or `PM' according to the given time value,
          return (dateObject.getHours() < 12 ? "AM" : "PM");
      case "S": // second as a decimal number
          return ((dateObject.getSeconds() < 10) ? "0" : "") + dateObject.getSeconds();
      case "y": // two-digit year
          return dateObject.getFullYear().toString().substring(2);
      case "Y": // full year
          return (dateObject.getFullYear());
      case "%":
          return "%";
    }
 
  }
       
  // plugin defaults (24-hour)
  $.fn.jclock.defaults = {
    format: '%H:%M:%S',
    utcOffset: 0,
    utc: false,
    fontFamily: '',
    fontSize: '',
    foreground: '',
    background: '',
    seedTime: undefined,
    timeout: 1000 // 1000 = one second, 60000 = one minute
  };
 
})(jQuery);
