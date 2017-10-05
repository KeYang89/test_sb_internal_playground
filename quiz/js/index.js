var quiz = {
  //Array for questions
  questions: [],

  //Add questions as objects to array
  addQuestion: function(question, correct, wrongOne, wrongTwo){
    this.questions.push({
      question: question,
      correct: correct,
      wrongOne: wrongOne,
      wrongTwo: wrongTwo
    });
    //upadate number of questions each time you add one
    view.displayNumberOfQuestions();
  },

  movingToNextQuestion: function(){
    //find all next buttons and add event lisener to them
    var nextButton = document.querySelectorAll(".nextButton");
    for(i = 0; i < nextButton.length; i++){
      nextButton[i].addEventListener("click", function(event){
        //Find the element that was clicked
        var elementClicked = event.target;
        //If it was a next button then remove the is-active class from it parent
        if(elementClicked.className === "nextButton"){
          elementClicked.parentNode.classList.remove("is-active");
          //If there isnt a next sibling then reshow the options to add questions and the info div
          if(elementClicked.parentNode.nextElementSibling === null) {
            var showAdd = document.querySelector(".addQuestions");
            var showInfo = document.querySelector(".info");
            showAdd.style.display = "block";
            showInfo.style.display = "block";
          } else {
            //If there is a next siblng then add the is-active class to it
            elementClicked.parentNode.nextElementSibling.classList.add("is-active");
          }
        }
      });
    };
  }
};

var handlers = {
  //This runs when you click add question button
  addQuestion: function(){
    //Get each of the inputs by id
    var questionInput = document.getElementById("questionInput");
    var correctInput = document.getElementById("correctInput");
    var wrongOneInput = document.getElementById("wrongOneInput");
    var wrongTwoInput = document.getElementById("wrongTwoInput");
    //pass the values of the inputs into the addQuestion method in the quiz object which will add them to question array
    quiz.addQuestion(questionInput.value, correctInput.value, wrongOneInput.value, wrongTwoInput.value);
    //clear the inputs
    questionInput.value = "";
    correctInput.value = "";
    wrongOneInput.value = "";
    wrongTwoInput.value = "";
  }
}

var view = {
  //This runs when you click start quiz
  displayQuestions: function(){
    //Hide the options to add questions and the info
    var hideAdd = document.querySelector(".addQuestions");
    var hideInfo = document.querySelector(".info");
    hideAdd.style.display = "none";
    hideInfo.style.display = "none";
    //Clear the quesitons wrapper
    var questionsWrapper = document.querySelector(".questionsWrapper");
    questionsWrapper.innerHTML = "";

    //for each quesiton in array create elements neede and give classes
    quiz.questions.forEach(function(question, index){
      var questionDiv = document.createElement("div");
      questionDiv.setAttribute("class", "questionDiv");
      var nextButton = document.createElement("button");
      nextButton.setAttribute("class", "nextButton");
      var questionLi = document.createElement("li");
      var correctLi = document.createElement("li");
      correctLi.setAttribute("class", "correct");
      var wrongOneLi = document.createElement("li");
      wrongOneLi.setAttribute("class", "wrong");
      var wrongTwoLi = document.createElement("li");
      wrongTwoLi.setAttribute("class", "wrong");

      //add each question div to the question wrapper
      questionsWrapper.appendChild(questionDiv);

      questionsWrapper.firstChild.classList.add("is-active");

      //add the text to the inputs the values in the questions array
      questionLi.textContent = question.question;
      correctLi.textContent = question.correct;
      wrongOneLi.textContent = question.wrongOne;
      wrongTwoLi.textContent = question.wrongTwo;

      //If its the last question the button should say finish if not it should say next
      if (index === quiz.questions.length - 1){
        nextButton.textContent = "Finish";
      } else{
        nextButton.textContent = "Next";
      }

      //Append elements to div
      questionDiv.appendChild(questionLi);

      //put the answers in a random order before apprending them so correct isnt always 1st
      var array = [correctLi, wrongOneLi, wrongTwoLi];
      array.sort(function(a, b){return 0.5 - Math.random()});
      array.forEach(function(item){
        questionDiv.appendChild(item);
      });

      questionDiv.appendChild(nextButton);

      this.displayAnswersCorrect();
      quiz.movingToNextQuestion();


    }, this);
  },

  displayAnswersCorrect: function(){
    var questionDiv = document.querySelectorAll(".questionDiv");
    var correctAnswers = 0;
    var answersCorrect = document.querySelector(".answersCorrect");
    answersCorrect.textContent = "Correct answers: " + correctAnswers;

    //add click event to each question div if the element clicked has class correct then add 1 to correctAnswers and change the color of element to green.
    //Else change the color of element to red and find the elemtn with correct class and make it green
    for (var i = 0; i < questionDiv.length; i++) {
      questionDiv[i].onclick = function(event) {
        event = event || window.event;
        if(event.target.className === "correct"){
          correctAnswers++;
          answersCorrect.textContent = "Correct answers: " + correctAnswers;
          event.target.style.color = "#2ecc71";
        } else if(event.target.className === "wrong"){
          event.target.style.color = "#e74c3c";
          var itemChildren = event.target.parentNode.children;
          for(i = 0; i < itemChildren.length; i++){
            if(itemChildren[i].classList.contains("correct")){
              itemChildren[i].style.color = "#2ecc71";
            }
          }
        }
        //Remove correct and wrong classes so the same question the score cant go up and colors cant chaneg
        var itemChildren = event.target.parentNode.children;
        for(i = 0; i < itemChildren.length; i++){
          itemChildren[i].classList.remove("correct");
          itemChildren[i].classList.remove("wrong");
        }
      }
    }

  },

  //count objects in array to show how many questions added to screen
  displayNumberOfQuestions: function(){
    var numberLi = document.getElementById("NumberQuestionsInQuiz");
    if(quiz.questions.length === 1) {
      numberLi.textContent = "You currently have " + quiz.questions.length + " question added to your quiz";
    } else {
      numberLi.textContent = "You currently have " + quiz.questions.length + " questions added to your quiz";
    }
  }
}