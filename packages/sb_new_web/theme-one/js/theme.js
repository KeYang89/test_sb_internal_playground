(function($){

    $(function(){
        // full screen mode

        // fit footer
        (function(main, meta, fn){

            if (!main.length) return;

            fn = function() {

                main.css('min-height','');

                meta = document.body.getBoundingClientRect();

                if (meta.height < window.innerHeight) {
                    main.css('min-height', (main.outerHeight() + (window.innerHeight - meta.height))+'px');
                }

                return fn;
            };

            UIkit.$win.on('load resize', fn());

        })($('#tm-main'));
    });
    $(window).load(function(){
        var quiz_form=$(".quiz-over-video").eq(0) || "None";
        var sb_selected = [];
        var answered = 0;
        var quiz_steps = 4; //default amount
        if (quiz_form!= "None"){//init hide the quiz
            quiz_form.hide();
            var submit_button = $('.quiz-over-video .uk-button-primary')[0];
            $("<div id='video_quiz_score'></div>").insertBefore($('video'));
            submit_button.disabled = true;
            $('.quiz-over-video .uk-form-controls').addClass("unanswered");
            var checkboxes =$('.quiz-over-video input'); //remove correct value until a button is clicked
            for (var i = 0; i<checkboxes.length; i++)  {
              if (checkboxes[i].type == 'checkbox')   {
                if (checkboxes[i].checked){
                    sb_selected.push($(checkboxes[i]).parent());
                }
                checkboxes[i].checked = false;
                //user makes a selection, disable the selection
                checkboxes[i].addEventListener("click",function(){
                    this.disabled = true;
                    //'this' refers to a jQuery object, not an element
                    var user_selected = $(this).parent();
                    var current_question_set = user_selected.parent().parent();
                    current_question_set.removeClass("unanswered");
                    current_question_set.addClass("answered");
                    answered = answered + 1;
                    render_result(sb_selected,user_selected);
                    if (answered>=quiz_steps){
                        submit_button.disabled = false;
                        submit_button.addEventListener("click",get_score);
                    }
                },false);

                }
            }
        }
        var vid = $(".video_with_quiz")[0] || $("video")[0] || "None"; //currently default to all videos
        var executed = false;
        var full_screen_flag = false;
        var full_screen_button = $('#full_screen')[0] || "None";
        function render_result(sb_selected,user_selected){
            user_selected.get(0).style.color = "red";
            user_selected.addClass("user_selected");
            sb_selected.map(function(x) {
            if (x.parent().parent().hasClass("answered")){
                x.addClass("sb_selected");
                x[0].style.color = "green";
             }
           })
           $('.answered input').each(function(){this.disabled = true})
        }
        function get_score() {
           var score = $('.user_selected.sb_selected').length;
           $("#video_quiz_score").html("<strong>Your score is: </strong>"+score);
        }
        function dynamic_id(item, index) {
            var index_id=index+1;
            $("<input class='timeline_input' name='timeline' type='radio' id='"+index_id+"'><label class='uk-form-label-process' for="+index_id+">Question"+index_id+"</label>").insertBefore(item);      
        }
        function zoom_vid(){
            if (full_screen_flag==false){
            $(".uk-width-medium-1-4").hide();
            $(".uk-width-medium-3-4")[0].style.width="100%";
            $(".uk-width-medium-3-4 video")[0].style.width="100%";
            }
            else {
            $(".uk-width-medium-1-4").show();
            $(".uk-width-medium-3-4")[0].style.width="75%";
            }
            full_screen_flag=!full_screen_flag;
         }
        if (full_screen_button != "None") {
        full_screen_button.addEventListener("click", zoom_vid);
        }
        if (vid != "None" && quiz_form!= "None"){ //with video
        vid.addEventListener("timeupdate", function(){
        if(this.currentTime >= vid.duration/100) {
            this.pause();
            vid.style.opacity = 0.1;
            if (!executed){
                executed=true;
                quiz_form.show();
                var quiz_row=$(".quiz-over-video .uk-form-row");
                var arr = Array.prototype.slice.call(quiz_row);
                arr.map(dynamic_id);
                var last_row=quiz_row.last();
                $("<div class='timeline_line'></div>").insertAfter(last_row);
                var quiz_steps = $("input[type=radio]");
                quiz_steps.eq(0).attr("checked", "checked"); 
                quiz_num = quiz_steps.length;          
            }
        }

        })
        } //with video
        });


})(jQuery);


