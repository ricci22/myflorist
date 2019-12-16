<script>
  function startTime() {
    var today = new Date();
    var wd = convertDateToString(today.getDay());
    var d = today.getDate();
    var mo = convertMonthToString(today.getMonth());
    var y = today.getFullYear();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
      h + ":" + m + ":" + s + " " + wd + ", " + mo + " " + d + ", " + y;
    var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }
  function convertDateToString(i) {
    var weekday = ['Sunday', 'Monday', 'Tuesday',
      'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    return weekday[i];
  }
  function convertMonthToString(i) {
    var month = ['January', 'February', 'March', 'April', 'May', 'June',
      'July', 'August', 'September', 'October', 'November', 'December']
    return month[i];
  }
</script>

<body onload="startTime()">
  <div id="txt"></div>
</body>