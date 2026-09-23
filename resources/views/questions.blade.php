<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> 
    @vite(['resources/css/questions.css', 'resources/js/questions.js'])
</head>
<body>

    <header class="topBar">
        <div class="logo">
            <img src="https://flagcdn.com/w40/hr.png" alt="logo" class="logoImg">
        </div>
        <h2 class="questionNumber">Country Quiz</h2>
        <p class="scores">Your scores: <span>50</span></p>
        <div class="hearts">
            <span>&#10084;</span>
            <span>&#10084;</span>
            <span>&#10084;</span>
        </div>
        <div class="profile">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="black" stroke-width="1.5">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
            </svg>
        </div>
    </header>

    <div class="questionsFrame">

        <h1 class="questionText">What is capital city of Croatia?</h1>

        <div class="anwsers">
            <div class="answerGroup">
                <div class="ansA" data-value="A">
                    <p class="letter">A</p>
                    <p>Split</p>
                </div>
                <div class="ansB" data-value="B">
                    <p class="letter">B</p>
                    <p>Zadar</p>
                </div>
                <div class="ansC" data-value="C">
                    <p class="letter">C</p>
                    <p>Zagreb</p>
                </div>
                <div class="ansD" data-value="D">
                    <p class="letter">D</p>
                    <p>Dubrovnik</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        var answers = document.querySelectorAll(".ansA, .ansB, .ansC, .ansD");
        var correct = "C";
        var answered = false;

        answers.forEach(function(answer) {
            answer.addEventListener("click", function() {

                if (answered) {
                    return;
                }
                answered = true;

                var value = answer.getAttribute("data-value");

                //right anwser
                if(value == correct){
                    answer.classList.add("correct");
                }
                //wrong anwser
                if(value != correct){
                    answer.classList.add("incorrect");
                }
            });
        });
    </script>
</body>
</html>