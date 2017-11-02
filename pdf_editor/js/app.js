"use strict";
function loadCanvas() {
  var e = localStorage.getItem("canvas"),
    a = new Image();
  (a.src = e), (a.onload = function() {
    ctx.drawImage(a, 0, 0);
  }), (document.getElementById("canvasImg").src = e || error);
}

function draw(e) {
  if (!isDrawing) return changeBrushSize(), void changeBrushOpacity();
  if (canSpray)
    for (var a = density; a--; ) {
      (ctx.strokeStyle = "transparent"), (ctx.fillStyle = colorPicker.value);
      var t = getRandomInt(-radius, radius),
        s = getRandomInt(-radius, radius);
      ctx.fillRect(lastX + t, lastY + s, 1, 1);
    }
  (ctx.lineWidth = brushSize.value), ctx.beginPath(), ctx.moveTo(
    lastX,
    lastY
  ), ctx.lineTo(e.offsetX, e.offsetY), ctx.stroke();
  var r = [e.offsetX, e.offsetY];
  console.log(r);
  if (
    (
      (lastX = r[0]),
      (lastY = r[1]),
      changeBrushSize(),
      changeBrushOpacity(),
      !0 === changeHue
    )
  )
    (ctx.strokeStyle =
      "hsla(" + hue + ", 100%, 50%, " + brushOpacity.value + ")"), ++hue >=
      360 && (hue = 0);
  else {
    var o = colorPicker.value.replace("#", ""),
      n = rgbToHsl(o);
    ctx.strokeStyle =
      "hsla(" +
      n[0] +
      "," +
      n[1] +
      "%," +
      n[2] +
      "%," +
      brushOpacity.value +
      ")";
  }
  var c = canvas.toDataURL("image/png");
  (document.getElementById("canvasImg").src = c);
}
function activeTool(e, a) {
  a ? e.classList.add("active") : e.classList.remove("active");
}
function erase() {
  (canErase = !canErase), activeTool(eraser, canErase), canErase
    ? (
        (canSpray = !1),
        activeTool(sprayTool, canSpray),
        sprayPanel.classList.add("hide"),
        brushPanel.classList.remove("hide"),
        (ctx.globalCompositeOperation = "destination-out")
      )
    : (ctx.globalCompositeOperation = "source-over");
}
function rain() {
  (canRain = !canRain), activeTool(rainbow, canRain), canRain
    ? ((canSpray = !1), activeTool(sprayTool, canSpray), (changeHue = !0))
    : (changeHue = !1);
}
function showBrush() {
  (showBrushPanel = !showBrushPanel), activeTool(
    brushTool,
    showBrushPanel
  ), activeTool(panelCross, showBrushPanel), showBrushPanel
    ? (
        (canSpray = !1),
        activeTool(sprayTool, canSpray),
        sprayPanel.classList.add("hide"),
        brushPanel.classList.remove("hide")
      )
    : brushPanel.classList.add("hide");
}
function showNav() {
  (showNavPanel = !showNavPanel), activeTool(
    navTool,
    showNavPanel
  ), showNavPanel
    ? navPanel.classList.remove("hide")
    : navPanel.classList.add("hide");
}
function selectColor() {
  (canRain = !1), activeTool(rainbow, canRain), (changeHue = !1);
}
function changeBrushSize() {
  (brushSizePreview.style.width =
    brushSize.value + "px"), (brushSizePreview.style.height =
    brushSize.value + "px");
  var e = colorPicker.value.replace("#", ""),
    a = rgbToHsl(e);
  (ctx.strokeStyle =
    "hsla(" +
    a[0] +
    "," +
    a[1] +
    "%," +
    a[2] +
    "%," +
    brushOpacity.value +
    ")"), (brushSizePreview.style.background = ctx.strokeStyle);
}
function changeBrushOpacity() {
  var e = colorPicker.value.replace("#", ""),
    a = rgbToHsl(e);
  (ctx.strokeStyle =
    "hsla(" +
    a[0] +
    "," +
    a[1] +
    "%," +
    a[2] +
    "%," +
    brushOpacity.value +
    ")"), changeBrushSize();
}
function bgToolOn() {
  if ((isBgTool = !isBgTool)) {
    bgTool.classList.add("active"), ctxBg.rect(
      0,
      0,
      canvas.width,
      canvas.height
    ), (ctxBg.fillStyle = colorPicker.value), ctxBg.fill();
    var e = canvasBg.toDataURL("image/png");
    (document.getElementById("canvasBgImg").src = e), setTimeout(function() {
      bgTool.classList.remove("active");
    }, 250);
  }
}
function sprayOn() {
  (canSpray = !canSpray), activeTool(sprayTool, canSpray), canSpray
    ? (
        (showBrushPanel = !1),
        brushPanel.classList.add("hide"),
        activeTool(brushTool, showBrushPanel),
        sprayPanel.classList.remove("hide")
      )
    : sprayPanel.classList.add("hide");
}
function changeSpray() {
  (radius = sprayRadius.value), (density = sprayDensity.value);
}
function clearCanvas() {
  (isClearTool = !isClearTool), isClearTool &&
    (
      clearTool.classList.add("active"),
      setTimeout(function() {
        clearTool.classList.remove("active");
      }, 250)
    ), ctx.clearRect(0, 0, canvas.width, canvas.height), ctxBg.clearRect(
    0,
    0,
    canvas.width,
    canvas.height
  );
  var e = canvas.toDataURL("image/png"),
    a = canvasBg.toDataURL("image/png");
  (document.getElementById("canvasImg").src = e), (document.getElementById(
    "canvasBgImg"
  ).src = a);
}
function saveCanvas() {
  localStorage.setItem("canvas", canvas.toDataURL()), localStorage.setItem(
    "canvasBg",
    canvasBg.toDataURL()
  ), (isSaveTool = !isSaveTool) &&
    (
      saveTool.classList.add("active"),
      setTimeout(function() {
        saveTool.classList.remove("active");
      }, 250)
    );
}
function downloadCanvas(e, a, t) {
  (e.href = document.getElementById(a).toDataURL()), (e.download = t);
}
function rgbToHsl(e) {
  var a = parseInt(e, 16),
    t = (a >> 16) & 255,
    s = (a >> 8) & 255,
    r = 255 & a;
  (t /= 255), (s /= 255), (r /= 255);
  var o = Math.max(t, s, r),
    n = Math.min(t, s, r),
    c = void 0,
    l = void 0,
    i = (o + n) / 2;
  if (o === n) c = l = 0;
  else {
    var u = o - n;
    switch (((l = i > 0.5 ? u / (2 - o - n) : u / (o + n)), o)) {
      case t:
        c = (s - r) / u + (s < r ? 6 : 0);
        break;
      case s:
        c = (r - t) / u + 2;
        break;
      case r:
        c = (t - s) / u + 4;
    }
    c /= 6;
  }
  return [Math.floor(360 * c), Math.floor(100 * l), Math.floor(100 * i)];
}
function getRandomInt(e, a) {
  return Math.floor(Math.random() * (a - e + 1)) + e;
}
function dragStart(e) {
  var a = window.getComputedStyle(e.target, null),
    t =
      parseInt(a.getPropertyValue("left")) -
      e.clientX +
      "," +
      (parseInt(a.getPropertyValue("top")) - e.clientY) +
      "," +
      e.target.id;
  e.dataTransfer.setData("Text", t);
}
function drop(e) {
  var a = e.dataTransfer.getData("Text").split(","),
    t = document.getElementById(a[2]);
  return (t.style.left = e.clientX + parseInt(a[0], 10) + "px"), (t.style.top =
    e.clientY + parseInt(a[1], 10) + "px"), e.preventDefault(), !1;
}
function dragOver(e) {
  return e.preventDefault(), !1;
}
var canvas = document.querySelector("#draw"),
  canvasBg = document.querySelector("#canvasBg"),
  ctx = canvas.getContext("2d"),
  colorPicker = document.querySelector(".colorSelector"),
  brushSize = document.querySelector(".brushSize"),
  brushSizePreview = document.querySelector(".brushSizePreview"),
  brushOpacity = document.querySelector(".brushOpacity"),
  brushTool = document.querySelector(".brush"),
  brushPanel = document.querySelector(".brushPanel"),
  navPanel = document.querySelector(".imgNav"),
  panelCross = document.querySelector("#panelCross"),
  navCross = document.querySelector("#imgNavCross"),
  sprayCross = document.querySelector("#sprayPanelCross"),
  bgTool = document.querySelector(".bg"),
  navTool = document.querySelector(".nav"),
  clearTool = document.querySelector(".clear"),
  saveTool = document.querySelector(".save"),
  sprayTool = document.querySelector(".spray"),
  sprayDensity = document.querySelector(".sprayDensity"),
  sprayRadius = document.querySelector(".sprayRadius"),
  sprayPanel = document.querySelector(".sprayPanel"),
  dlToolLink = document.querySelector("#download"),
  error = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/390561/error.png";
  loadCanvas(), 
  //(canvas.width = 800), (canvas.height = 450), 
  (ctx.strokeStyle =
  "#BADA55"), (ctx.lineJoin = "round"), (ctx.lineCap =
  "round"), (ctx.lineWidth = brushSize.value);
var isBgTool = !1,
  isDrawing = !1,
  lastX = 0,
  lastY = 0,
  hue = 0,
  changeHue = !1,
  density = sprayDensity.value,
  radius = sprayRadius.value;
canvas.addEventListener("mousedown", function(e) {
  isDrawing = !0;
  var a = [e.offsetX, e.offsetY];
  (lastX = a[0]), (lastY = a[1]);
}), canvas.addEventListener("mousemove", draw), canvas.addEventListener(
  "mousedown",
  draw
), canvas.addEventListener("mouseup", function() {
  return (isDrawing = !1);
}), canvas.addEventListener("mouseout", function() {
  return (isDrawing = !1);
});
var eraser = document.querySelector(".eraser");
eraser.addEventListener("click", erase);
var canErase = !1,
  rainbow = document.querySelector(".rainbow"),
  canRain = !1;
rainbow.addEventListener("click", rain);
var showBrushPanel = !1;
brushTool.addEventListener("click", showBrush), panelCross.addEventListener(
  "click",
  showBrush
), navCross.addEventListener("click", showNav), navTool.addEventListener(
  "click",
  showNav
);
var showNavPanel = !0;
colorPicker.addEventListener(
  "click",
  selectColor
), colorPicker.addEventListener(
  "mousemove",
  selectColor
), brushSize.addEventListener(
  "mousemove",
  changeBrushSize
), brushSize.addEventListener(
  "click",
  changeBrushSize
), brushOpacity.addEventListener(
  "mousemove",
  changeBrushOpacity
), brushOpacity.addEventListener(
  "click",
  changeBrushOpacity
), bgTool.addEventListener("click", bgToolOn), sprayTool.addEventListener(
  "click",
  sprayOn
), sprayCross.addEventListener("click", sprayOn);
var canSpray = !1;
sprayRadius.addEventListener(
  "mousemove",
  changeSpray
), sprayRadius.addEventListener(
  "click",
  changeSpray
), sprayDensity.addEventListener(
  "mousemove",
  changeSpray
), sprayDensity.addEventListener("click", changeSpray);
var isClearTool = !1;
clearTool.addEventListener("click", clearCanvas);
var isSaveTool = !1;
saveTool.addEventListener("click", saveCanvas);
var isDlTool = !1,
  dlTool = document.querySelector(".dl");
dlToolLink.addEventListener(
  "click",
  function() {
    (isDlTool = !isDlTool), isDlTool &&
      (
        dlTool.classList.add("active"),
        setTimeout(function() {
          dlTool.classList.remove("active");
        }, 250)
      ), downloadCanvas(this, "draw", "test.png");
  },
  !1
);
