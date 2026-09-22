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
    <div class="questionsFrame">
        <h2 class="questionNumber">Question #</h2>
        <p class="questionText">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, incidunt.</p>
        <div class="anwsers">
            <form>
                <div class="ansA">
                    <input type="radio" id="otpA" name="ansOption" value="A">
                    <p class="letter">A)</p>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="ansB">
                    <input type="radio" id="otpB" name="ansOption" value="B">
                    <p class="letter">B)</p>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="ansA">
                    <input type="radio" id="otpC" name="ansOption" value="C">
                    <p class="letter">C)</p>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="ansA">
                    <input type="radio" id="otpD" name="ansOption" value="D">
                    <p class="letter">D)</p>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>    
            </form>
            <button class="submitBtn">Submit anwser</button>
        </div>
    </div>

    <script>
        var submitBtn = document.getElementsByClassName("submitBtn")[0];
        var radios = document.getElementsByName("ansOption");

        submitBtn.disabled = true;

        // enable the button once an option is picked
        radios.forEach(function(radio) {
            radio.addEventListener("change", function() {
                submitBtn.disabled = false;
            });
        });

        var correct = "A";

        submitBtn.addEventListener("click", function(){
            var selected = document.querySelector('input[name="ansOption"]:checked');

            if (selected) {
                console.log(selected.value);
            }

            //right anwser
            if(selected.value == correct){
                console.log("correct")
            }
            //wrong anwser
            if(selected.value != correct){
                console.log("incorrect")
            }
        });
    </script>
</body>
</html>