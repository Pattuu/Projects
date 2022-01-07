<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link type="text/css" rel="stylesheet" href="../css/styles.css">
    <link type="text/css" rel="stylesheet" href="../css/reset.css">
    <link href="../../inc/img/favicon2.png" rel="icon">
    <title>Pelikone</title>
</head>
<body class="slotmachinebody">
    <header class="slotmachead">
        <h1 class="slotmacheader">Slot machine</h1>
        <a class="goback" href="../../index.php">Takaisin</a>
    </header>

    <main class="slotmachinemain">
        <div class="instructions">
            <img class="instru" src="img/instructions.png">
            <img class="info" src="img/info.png">
        </div>
        <div class="coins">
            <h2 id="numCoins"></h2>
            <img src="img/coin.png">
        </div>

        <div class="bets">
            <button class="bet-btn" id="bet1">Bet 1</button>
            <button class="bet-btn" id="bet2">Bet 2</button>
            <button class="bet-btn" id="bet3">Bet 3</button>
            <button class="bet-btn" id="bet5">Bet 5</button>
            <button class="bet-btn" id="bet10">Bet 10</button>
        </div>

        <div class="rolls">
            <div class="roll roll1">
                <div class="square top">
                    <img id="1" src="img/symbol3.png">
                </div>
                <div class="square mid">
                    <img id="4" src="img/symbol3.png">
                </div>
                <div class="square bot">
                    <img id="7" src="img/symbol3.png">
                </div>
            </div>
            <div class="roll roll2">
                <div class="square top">
                    <img id="2" src="img/symbol3.png">
                </div>
                <div class="square mid">
                    <img id="5" src="img/symbol3.png">
                </div>
                <div class="square bot">
                    <img id="8" src="img/symbol3.png">
                </div>
            </div>
            <div class="roll roll3">
                <div class="square top">
                    <img id="3" src="img/symbol3.png">
                </div>
                <div class="square mid">
                    <img id="6" src="img/symbol3.png">
                </div>
                <div class="square bot">
                    <img id="9" src="img/symbol3.png">
                </div>
            </div>
        </div>
        <div class="slotMsg">
            <div class="slotMsgs">
                <marquee class="slotMs" id="slotT">Thank you for playing!!</marquee>
                <h1 class="slotMs" id="slotM">Wins</h1>
                <h1 class="slotMs" id="errorMs"></h1>
                <h1 class="slotMs" id="lockSta">Locks: </h1>
                <h1 class="slotMs" id="betSta">Current Bet: </h1>
            </div>
        </div>
        <div class="locks">
            <button class="lock lock1">LOCK</button>
            <button class="lock lock2">LOCK</button>
            <button class="lock lock3">LOCK</button>
        </div>
        <div class="play">
            <button id="roll-btn">ROLL</button>
        </div>
    </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2"
    crossorigin="anonymous"></script>
    
    <script src="script/slotmachine.js" type="text/javascript"></script>
</body>
</html>