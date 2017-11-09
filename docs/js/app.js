"use strict";
function loadCanvas() {
  var e = localStorage.getItem("canvas"),
    a = new Image();
  (a.src = e), (a.onload = function() {
    ctx.drawImage(a, 0, 0);
  }), (document.getElementById("canvasImg").src = e || error);
}
function loadCanvasBg() {
  var e = localStorage.getItem("canvasBg"),
    a = new Image();
  (a.src = e), (a.onload = function() {
    ctxBg.drawImage(a, 0, 0);
  }), (document.getElementById("canvasBgImg").src = e || error);
}
function textCanvasLayerState(){
    if (canText) {
      return addText();
    }
    else {
      return hideTextCanvas();
    }
}
function svgLayerState(){
    if (canShape) {
      return addShape();
    }
    else {
      return hideShape();
    }
}
function addShape(){
  $("#drawSvg").show();
}
function hideShape(){
  $("#drawSvg").hide();
}
function draw(e) {
  textCanvasLayerState();
  svgLayerState();
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
var c = canvas.toDataURL("image/png"),
    l = canvasBg.toDataURL("image/png");
  (document.getElementById("canvasImg").src = c), (document.getElementById(
    "canvasBgImg"
  ).src = l);
}
function activeTool(e, a) {
  a ? e.classList.add("active") : e.classList.remove("active");
}
function erase() {
  textCanvasLayerState();
  svgLayerState();
  (canErase = !canErase), activeTool(eraser, canErase), canErase
    ? (
        (canSpray = !1),
        activeTool(sprayTool, canSpray),
        sprayPanel.classList.add("hide"),
        textPanel.classList.add("hide"),
        shapePanel.classList.add("hide"),
        brushPanel.classList.remove("hide"),
        (ctx.globalCompositeOperation = "destination-out")
      )
    : (ctx.globalCompositeOperation = "source-over");
}
function rain() {
  textCanvasLayerState();
  svgLayerState();
  (canRain = !canRain), activeTool(rainbow, canRain), canRain
    ? ((canSpray = !1), activeTool(sprayTool, canSpray), (changeHue = !0))
    : (changeHue = !1);
}
function showBrush() {
  textCanvasLayerState();
  svgLayerState();
  (showBrushPanel = !showBrushPanel), activeTool(
    brushTool,
    showBrushPanel
  ), activeTool(panelCross, showBrushPanel), showBrushPanel
    ? (
        (canSpray = !1),
        activeTool(sprayTool, canSpray),
        sprayPanel.classList.add("hide"),
        textPanel.classList.add("hide"),
        shapePanel.classList.add("hide"),
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
function selectColorOp() {
  textCanvasLayerState();
  svgLayerState();
}
function selectColor() {
  textCanvasLayerState();
  svgLayerState();
  (canRain = !1), activeTool(rainbow, canRain), (changeHue = !1);
}
function changeBrushSize() {
 textCanvasLayerState();
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
  textCanvasLayerState();
  svgLayerState();
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
  textCanvasLayerState();
  svgLayerState();
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
function shapeOn() {
 (canShape = !canShape), activeTool(shapeTool, canShape), canShape
    ? (
        brushPanel.classList.add("hide"),
        textPanel.classList.add("hide"),
        shapePanel.classList.remove("hide"),
        sprayPanel.classList.add("hide"),
        $('.shapePanel .tool').addClass("shadow-pulse")
   )
    : shapePanel.classList.add("hide");
    textCanvasLayerState();
    svgLayerState();
}
function drawpoly(newshape,isClose,isCloud){
      var polyshape;
      if (isClose) {
      polyshape = shapeStyle(newshape.polygon(),isCloud);
      }
      else {
      polyshape = shapeStyle(newshape.polyline(),isCloud);
      }
      polyEnd(polyshape,isCloud);
}

var pointX = null, pointY = null, 
prev_pointX = null, prev_pointY = null, 
middleX = null, middleY=null; //for curves

function polyEnd(polyshape,isCloud){
  $("#hint").html("Hit Enter when you finish editing the shape");
  $("#hint").show(600);
  polyshape.on('drawpoint', function(e){
    if (isCloud){
        pointX = e.detail.p.x;
        pointY = e.detail.p.y;
       
        if (middleX && middleY) {
          if (prev_pointX && prev_pointY){
              var dString='M'+pointX+','+pointY+' '+'Q'+middleX+','+middleY+' '+prev_pointX+','+prev_pointY;
                  var path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                  path.setAttribute('d',dString);
                  renderLines(path,true);
                  $('#drawSvg > svg')[0].appendChild(path);
                  middleX=null;
                  middleY=null;
                }//end prev if
              prev_pointX=middleX;
              prev_pointY=middleY;
              }//end mid if
          middleX=pointX;
          middleY=pointY;
      }//end isCloud
     });
     polyshape.on('drawstart', function(e){
          if (isCloud){
              middleX = e.detail.p.x;
              middleY = e.detail.p.y;
          }    
           document.addEventListener('keydown', function(e){
              if(e.keyCode == 13){
                  polyshape.draw('done');
                  polyshape.off('drawstart');
                  $('.shapePanel .tool').removeClass("active");
                  $("#hint").html("Then Click 'Save'");
                  if (isCloud){
                    $('#drawSvg > svg > .cloudSketch').remove();
                  }

              }
          });
      });

      polyshape.on('drawstop', function(){
      // remove listener
      });

}

function shapeStyle(s, isCloud){
  var _s= s.draw();
  _s = renderFill(_s);
  if (isCloud){
   return renderSketchLines(_s);
  }
  _s = renderLines(_s, isCloud);
  return _s;
}
function renderSketchLines(_s){
 //temporary lines for cloud shape
    $('#drawSvg > svg > polyline').addClass('cloudSketch');
    return  _s.attr('stroke-linejoin','round')
    .attr('stroke-linecap','round')
    .attr('stroke','grey')
    .attr('stroke-dasharray','10')
    .attr('shape-rendering', 'geometricPrecision');
}
function renderLines(_s, isCloud){
  var lineWeight = parseInt($('#shapeStroke').val());
    var isDashed = $('#shapeDashedOn').prop('checked');
    if (isNaN(lineWeight) || lineWeight < 0) {
      lineWeight = 1;
    }
    var strokeColor=colorPicker.value;
    if (!isCloud){
        _s=_s.attr('stroke-width',lineWeight)
                .attr('stroke',strokeColor)

        if (isDashed) {
           return _s.attr('stroke-dasharray','10 5');
        }
        else {
          return _s;
        }
      }
    else {
       var styleString = "stroke:"+strokeColor+";stroke-width:"+lineWeight+";fill:none";
       return _s.setAttribute('style',styleString);
      }
}
function renderFill(_s){
  var fillOp=fillOpacity.value;
  return _s.attr('fill',fillColor).attr('fill-opacity',fillOp);
}

function showReminder() {
    if ($('#drawSvg > svg').length > 1){
    //unsaved SVG detected 
    $('.cover').html("<div id='reminderSaveShape'>Save the current editing?<br /><button onclick='saveShapeCanvas()'>Save</button> <button class='cancel' onclick='removeShapeNode()'>No</button></div>")
    $('.cover').show();
  }
}
function shapeToolOn(shape){
  $('.shapePanel .tool').removeClass("active");
  $('.'+shape).addClass("active");
  var newshape = SVG("drawSvg").size('100%', '100%');
  $("#submitShape").css("background","green");
  $("#submitShape").css("color","white");
  $(".tool").click(function() {
    showReminder();
  })

  switch (shape) {
        case "rectangle": shapeStyle(newshape.rect(),false); break;
        case "circle": shapeStyle(newshape.circle(),false); break;
        case "polygon": drawpoly(newshape,true,false);break;
        case "polyline": drawpoly(newshape,false,false);break;
        case "ellipse": shapeStyle(newshape.ellipse(),false); break;
        case "cloud":  drawpoly(newshape,false,true); break;
        default: console.log("Illegal Shape!");
   }

}
function textOn() {
 (canText = !canText), activeTool(textTool, canText), canText
    ? (
        brushPanel.classList.add("hide"),
        textPanel.classList.remove("hide"),
        shapePanel.classList.add("hide"),
        sprayPanel.classList.add("hide")
   )
    : textPanel.classList.add("hide");
    textCanvasLayerState();
    svgLayerState();
}
function sprayOn() {
  textCanvasLayerState();
  svgLayerState();
  (canSpray = !canSpray), activeTool(sprayTool, canSpray), canSpray
    ? (
        (showBrushPanel = !1),
        brushPanel.classList.add("hide"),
        textPanel.classList.add("hide"),
        shapePanel.classList.add("hide"),
        activeTool(brushTool, showBrushPanel),
        sprayPanel.classList.remove("hide")
      )
    : sprayPanel.classList.add("hide");
}
function changeSpray() {
  textCanvasLayerState();
  svgLayerState();
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
  console.log(e);
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
  ctxBg = canvasBg.getContext("2d"),
  colorPicker = document.querySelector(".colorSelector"),
  colorPickerOp = document.querySelector(".colorSelectorOp"),
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
  textTool = document.querySelector(".text"),
  textPanel = document.querySelector(".textPanel"),
  textCross = document.querySelector("#textPanelCross"),
  shapeTool = document.querySelector(".shape"),
  shapePanel = document.querySelector(".shapePanel"),
  shapeCross = document.querySelector("#shapePanelCross"),
  dlToolLink = document.querySelector("#download"),
  rectTool = document.querySelector(".rectangle"),
  polyTool = document.querySelector(".polygon"),
  polylineTool = document.querySelector(".polyline"),
  ellipseTool = document.querySelector(".ellipse"),
  cloudTool = document.querySelector(".cloud"),
  circleTool = document.querySelector(".circle"),
  shapeFill = document.querySelector('#shapeFill'),
  fillOpacity = document.querySelector("#fillOpacity"),
  fillColor = 'none',
  error = "watermark/error.png";
  loadCanvasBg(),
  loadCanvas(), 
  (canvas.width = 800),
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
),colorPickerOp.addEventListener(
  "click",
  selectColorOp
), colorPickerOp.addEventListener(
  "mousemove",
  selectColorOp
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
), textTool.addEventListener(
  "click",
  textOn
), textCross.addEventListener(
  "click",
  textOn
), shapeTool.addEventListener(
  "click",
  shapeOn
), shapeCross.addEventListener(
  "click",
  shapeOn
), sprayCross.addEventListener(
"click", 
sprayOn), rectTool.addEventListener(
  "click",
  function(){shapeToolOn("rectangle");}, false
), polyTool.addEventListener(
  "click",
  function(){shapeToolOn("polygon");}, false
), ellipseTool.addEventListener(
  "click",
  function(){shapeToolOn("ellipse");}, false
), circleTool.addEventListener(
  "click",
   function(){shapeToolOn("circle");}, false
), cloudTool.addEventListener(
  "click",
   function(){shapeToolOn("cloud");}, false
), polylineTool.addEventListener(
  "click",
   function(){shapeToolOn("polyline");}, false
);
var canSpray = !1;
var canText = !1;
var canShape = !1;
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

$('#shapeFillOn').on('click', function(e) {
    if ( $(this).prop('checked')) {
      shapeFill.disabled = true;
      fillOpacity.disabled = true;
    }
    else {
      fillColor=colorPickerOp.value;
      shapeFill.disabled = false;
      fillOpacity.disabled = false;
    }
  });


 $("#submitShape").click(function () {
    saveShapeCanvas();
    shapeOn();
});

function saveShapeCanvas(){
    var node=document.querySelector('#drawSvg > svg');
    $('.cover').hide();
    $("#hint").hide(100);
    var svgString = new XMLSerializer().serializeToString(node);
    var DOMURL = self.URL || self.webkitURL || self;
    var img = new Image();
    var svg = new Blob([svgString], {type: "image/svg+xml;charset=utf-8"});
    var url = DOMURL.createObjectURL(svg);
    var adjusted_left = $("#drawSvg").offset().left-$("#draw").offset().left;
    var adjusted_top= $("#drawSvg").offset().top-$("#draw").offset().top;
    img.onload = function() {
          ctx.drawImage(img,adjusted_left,adjusted_top);
          removeShapeNode();  
      };
    img.src = url;
}

function removeShapeNode(){
  var node=document.querySelector('#drawSvg > svg');
  node.remove();
  $('.cover').hide();
  $("#hint").hide(100);
}
