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
        var quiz_form=$("#formmaker-form") || "None";
        if (quiz_form!= "None"){//init hide the quiz
            quiz_form.hide();
            var checkboxes =$('input'); //remove correct value until a button is clicked
            for (var i=0; i<checkboxes.length; i++)  {
              if (checkboxes[i].type == 'checkbox')   {
                checkboxes[i].checked = false;
                checkboxes[i].addEventListener("click",function(){this.disabled = true;},false);
              }
            }
        }
        var vid = $(".video_with_quiz")[0] || $("video")[0] || "None"; //currently default to all videos
        var executed = false;
        var full_screen_flag = false;
        var full_screen_button = $('#full_screen')[0] || "None";
        function get_score(num) {
            var q_count = num*1.0 || 0;
            var wrong_answer_count = 0;
            var score_message = "";
            for (var i=0; i<checkboxes.length; i++)  {
                if (checkboxes[i].type == 'checkbox' && checkboxes[i].checked && checkboxes[i].disabled != true) {
                    wrong_answer_count=wrong_answer_count+1.0;
                }
            }
            if (q_count > 0)
            {
                if (wrong_answer_count > q_count) {score_message = "Your score is too low. You can refresh the page to listen to the video again.";}
                else {
                    score_message = "Your score is"+parseInt((q_count-wrong_answer_count)/wrong_answer_count*100);
                }
            }
            alert(score_message);
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
                // $('button .uk-button-primary:first').addEventListener("click", 
                //     function() {get_score(quiz_steps.length)});
                  
            }
        }

        })
           } //with video
        });


})(jQuery);


