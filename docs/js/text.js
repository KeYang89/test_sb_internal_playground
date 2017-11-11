"use strict";
// text_canvas related variables
var source_canvas = $("#draw");
var _source_canvas = source_canvas[0];
var text_canvas = $("#drawText");
var _text_canvas = text_canvas[0];
// an array to hold text objects
var texts = [];
function fixIEtextarea(t) {
    if (isIE){
        $('#textPanel').attr('draggable', t);
        if (t === 'true'){
            $("#textPanel").removeClass('nodrag');
        }
        else{
            $("#hint").html("Drag and drop disabled for now. Click 'Add and test'.");
            $("#hint").show();
            $("#textPanel").addClass('nodrag');
        }
    }
}
function addText() {
    text_canvas.show();

}
function hideTextCanvas() {
    text_canvas.hide();
}
$(document).ready(function() {
    var text_ctx = _text_canvas.getContext("2d");
    var text_scrollX = text_canvas.scrollLeft();
    var text_scrollY = text_canvas.scrollTop();

    // variables to save last mouse position
    // used to see how far the user dragged the mouse
    // and then move the text by that distance
    var text_startX;
    var text_startY;

    // this var will hold the index of the hit-selected text
    var selectedText = -1;
    // clear the text_canvas & redraw all texts
    function clearCanvas(c,_c){        
        c.clearRect(0, 0, _c.width, _c.height);
    }
    function drawText(c) {
        clearCanvas(c,_text_canvas);
        for (var i = 0; i < texts.length; i++) {
            var text = texts[i];
            c.fillStyle =  colorPicker.value;
            c.fillText(text.text, text.x, text.y);
        }

    }

    // test if x,y is inside the bounding box of texts[textIndex]
    function textHittest(x, y, textIndex) {
        var text = texts[textIndex];
        return (x >= text.x && x <= text.x + text.width && y >= text.y - text.height && y <= text.y);
    }

    // handle mousedown events
    // iterate through texts[] and see if the user
    // mousedown'ed on one of them
    // If yes, set the selectedText to the index of that text
    function handleMouseDown(e) {
        $("#submitTextOnCanvas").css("background","green");
        $("#submitTextOnCanvas").css("color","white");
        $("#hint").html("Then click 'Save'");
        e.preventDefault();
        text_startX = parseInt(e.clientX - text_canvas.offset().left);
        text_startY = parseInt(e.clientY - text_canvas.offset().top);
        console.log(text_startY);
        // Put your mousedown stuff here
        for (var i = 0; i < texts.length; i++) {
            if (textHittest(text_startX, text_startY, i)) {
               console.log("text-e");
        
                selectedText = i;
            }
        }
    }

    // done dragging
    function handleMouseUp(e) {
        e.preventDefault();
        selectedText = -1;
    }

    // also done dragging
    function handleMouseOut(e) {
        e.preventDefault();
        selectedText = -1;
    }

    // handle mousemove events
    // calc how far the mouse has been dragged since
    // the last mousemove event and move the selected text
    // by that distance
    function handleMouseMove(e) {
        if (selectedText < 0) {
            return;
        }
        e.preventDefault();
        var mouseX = parseInt(e.clientX - text_canvas.offset().left);
        var mouseY = parseInt(e.clientY - text_canvas.offset().top);

        // Put your mousemove stuff here
        var dx = mouseX - text_startX;
        var dy = mouseY - text_startY;
        text_startX = mouseX;
        text_startY = mouseY;

        var text = texts[selectedText];
        text.x += dx;
        text.y += dy;
        drawText(text_ctx);
    }

    // listen for mouse events
    text_canvas.mousedown(function (e) {
        handleMouseDown(e);
    });
    text_canvas.mousemove(function (e) {
        handleMouseMove(e);
    });
    text_canvas.mouseup(function (e) {
        handleMouseUp(e);
    });
    text_canvas.mouseout(function (e) {
        handleMouseOut(e);
    });

    $("#submitText").click(function () {
        fixIEtextarea('true');
        // calc the y coordinate for this text on the text_canvas
        $("#hint").html("Drag and drop the text on the right place");
        $("#hint").show(600);
        var y = texts.length * 20 + 20;
        // get the text from the input element
        var text = {
            text: $("#theText").val(),
            x: 20,
            y: y
        };

        // calc the size of this text for hit-testing purposes
       
        var fontSize=parseInt($("#fontSize").val());
        if (isNaN(fontSize) || fontSize < 0){
            fontSize=16;
        }

        var font_selector = document.getElementById('selectFontFamily');
        var font_family = font_selector.options[font_selector.selectedIndex].value;
        text_ctx.font=fontSize+'px'+' '+font_family;
        text.width = text_ctx.measureText(text.text).width;
        text.height = 16;

        // put this new text in the texts array
        texts.push(text);

        // redraw everything
        drawText(text_ctx);
        $("#submitTextOnCanvas").show();
    });
    $("#submitTextOnCanvas").click(function () {
        $("#hint").hide(600);

        ctx.drawImage(_text_canvas, 0, 0);
        clearCanvas(text_ctx,_text_canvas);
        textOn();
        texts=[];
        $("#submitTextOnCanvas").hide();
    });
    
    $('.auto-text-area').click(function(){
       $('.auto-text-area').addClass('line-pulse')
        fixIEtextarea('false');
    });
    $('.auto-text-area').on('keyup',function(){
            fixIEtextarea('false');
            $(this).css('height','auto');
            $(this).height(this.scrollHeight);
        });

});