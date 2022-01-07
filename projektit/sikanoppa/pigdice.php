<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link type="text/css" rel="stylesheet" href="../css/styles.css">
    <link type="text/css" rel="stylesheet" href="../css/reset.css">
    <link href="../../inc/img/favicon2.png" rel="icon">
    <title>Sikanoppa</title>
</head>
<body class="pigBody">
    <header class="pigHeader">
        <h1 class="pigTitle">Pig (Dice game)</h1>
        <a class="goback" href="../../index.php">Takaisin</a>
    </header>

    <main class="pigMain">
        <section class="pigRules">
            <h1 class="rulesTitle">Rules</h1>
            <div class="rulesDiv">
                <h2 class="rulesPT">Rules for one dice</h2>
                <ul class="rulesP">
                    <li>Press roll if you are the active player</li>
                    <li>If you roll 2-6, that gets added to your current score</li>
                    <li>If you roll 1, you loose all your current score and your turn ends</li>
                    <li>If you want to save your current score, press hold</li>
                    <li>Pressing hold passes turn to the other player</li>
                    <li>First to get the chosen score, wins the game</li>
                </ul>
            </div>
            <div class="rulesDiv">
                <h2 class="rulesPT">Rules for two dices</h2>
                <ul class="rulesP">
                    <li>Press roll if you are the active player</li>
                    <li>If you roll 3-11, that gets added to your current score</li>
                    <li>If you roll 2 or 12, you loose all your current score and your turn ends</li>
                    <li>If you want to save your current score, press hold</li>
                    <li>Pressing hold passes turn to the other player</li>
                    <li>First to get the chosen score, wins the game</li>
                </ul>
            </div>
            <div class="rulesDiv">
                <h2 class="rulesPT">Choose rules</h2>
                <ul class="rulesP">
                    <li><span class="ruleSpan">Points to win: </span><button class="rule-btn" id="_50">50</button><button class="rule-btn" id="_100">100</button><button class="rule-btn" id="_200">200</button><button class="rule-btn" id="_500">500</button><span class="ruleSpan">Currently: </span><span class="ruleSpan" id="currentPoint">100</span></li>
                    <br>
                    <li><span class="ruleSpan">Dice amount: </span><button class="rule-btn" id="_1">One</button><button class="rule-btn" id="_2">Two</button><span class="ruleSpan">Currently: </span><span class="ruleSpan" id="diceAmount">1</span></li>
                </ul>
            </div>
            <div class="resetDiv">
                <h3>You can reset the game and rules by pressing this button</h3>
                <button class="pigReset">Reset</button>
            </div>
        </section>
        <section class="pigGame">
            <div class="pigPlayer pigP1">
                <h2 class="playerName" id="player1">Player 1</h2>
                <p class="playerStatus" id="p1Status"></p>
                <span class="playerScore">Score: </span><span class="playerScore" id="scoreP1">0</span><br>
                <span class="playerCurrent">Current: </span><span class="playerCurrent" id="currentP1">0</span>
            </div>
                
            <div class="pigDisplay">
                <div class="pigDices">
                    <img id="pigDice" src="">
                    <img id="pigDice2" src="">
                </div>

                <button class="pigButton" id="pigRoll">Roll</button>
                <button class="pigButton" id="pigHold">Hold</button>
                <div class="rolledStatus">
                    <h1 class="rollSta"></h1>
                    <h1 class="turnOver"></h1>
                </div>
            </div>

            <div class="pigPlayer pigP2">
                <h2 class="playerName" id="player2">Player 2</h2>
                <p class="playerStatus" id="p2Status"></p>
                <span class="playerScore">Score: </span><span class="playerScore" id="scoreP2"> 0</span><br>
                <span class="playerCurrent">Current: </span><span class="playerCurrent" id="currentP2"> 0</span>
            </div>
        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2"
    crossorigin="anonymous"></script>
    
    <script src="script/pigdice.js" type="text/javascript"></script>
</body>
</html>