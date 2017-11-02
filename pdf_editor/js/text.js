"use strict";
// text_canvas related variables
var text_canvas = $("#draw");
function addText() {
    text_canvas.show();
}
    var _text_canvas = text_canvas[0];
    var text_ctx = _text_canvas.getContext("2d");
    // variables used to get mouse position on the text_canvas
    var text_canvasOffset = text_canvas.offset();
    var text_offsetX = text_canvasOffset.left;
    var text_offsetY = text_canvasOffset.top;
    var text_scrollX = text_canvas.scrollLeft();
    var text_scrollY = text_canvas.scrollTop();

    // variables to save last mouse position
    // used to see how far the user dragged the mouse
    // and then move the text by that distance
    var text_startX;
    var text_startY;

    // an array to hold text objects
    var texts = [];

    // this var will hold the index of the hit-selected text
    var selectedText = -1;
    // clear the text_canvas & redraw all texts
    function drawText(c) {
        //text_ctx.clearRect(0, 0, _text_canvas.width, _text_canvas.height);
        for (var i = 0; i < texts.length; i++) {
            var text = texts[i];
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
        e.preventDefault();
        text_startX = parseInt(e.clientX - text_offsetX);
        text_startY = parseInt(e.clientY - text_offsetY);
        // Put your mousedown stuff here
        for (var i = 0; i < texts.length; i++) {
            if (textHittest(text_startX, text_startY, i)) {
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
        var mouseX = parseInt(e.clientX - text_offsetX);
        var mouseY = parseInt(e.clientY - text_offsetY);

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

        // calc the y coordinate for this text on the text_canvas
        var y = texts.length * 20 + 20;

        // get the text from the input element
        var text = {
            text: $("#theText").val(),
            x: 20,
            y: y
        };

        // calc the size of this text for hit-testing purposes
        text_ctx.font = "16px verdana";
        text.width = text_ctx.measureText(text.text).width;
        text.height = 16;

        // put this new text in the texts array
        texts.push(text);

        // redraw everything
        drawText(text_ctx);
    });
    $('.auto-text-area').on('keyup',function(){
            $(this).css('height','auto');
            $(this).height(this.scrollHeight);
        });

