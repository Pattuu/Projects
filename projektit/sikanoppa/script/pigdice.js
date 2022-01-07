$(document).ready(function() {

let gamePlaying, scoreP1, scoreP2, activePlayer, roundScore, rolled, rolled2, twoDices, timesRolled, totalScore;
let pointsToWin, twoRolls, timeT, timeR;
const $roll = $('#pigRoll');
const $hold = $('#pigHold');
const $img1 = $('#pigDice');
const $img2 = $('#pigDice2');
const $current1 = $('#currentP1');
const $current2 = $('#currentP2');
const $score1 = $('#scoreP1');
const $score2 = $('#scoreP2');
const $player1 = $('#player1');
const $player2 = $('#player2');
const $dice = $('#_1');
const $dice2 = $('#_2');
const $pointsW50 = $('#_50');
const $pointsW100 = $('#_100');
const $pointsW200 = $('#_200');
const $pointsW500 = $('#_500');
const $currentP = $('#currentPoint');
const $dices = $('#diceAmount');
const $reset = $('.pigReset');
const $rollSta = $('.rollSta');
const $turn = $('.turnOver');


init();

$reset.on('click', () => {
    init();
});

$pointsW50.on('click', event => {
    checkScores(scoreP1, scoreP2, roundScore);
    $(event.currentTarget).addClass('active-btn');
    $(event.currentTarget).siblings().removeClass('active-btn');
    pointsToWin = 50;
    $currentP.text(pointsToWin);
});

$pointsW100.on('click', () => {
    checkScores(scoreP1, scoreP2, roundScore);
    $(event.currentTarget).addClass('active-btn');
    $(event.currentTarget).siblings().removeClass('active-btn');
    pointsToWin = 100;
    $currentP.text(pointsToWin);
});

$pointsW200.on('click', () => {
    checkScores(scoreP1, scoreP2, roundScore);
    $(event.currentTarget).addClass('active-btn');
    $(event.currentTarget).siblings().removeClass('active-btn');
    pointsToWin = 200;
    $currentP.text(pointsToWin);
});

$pointsW500.on('click', () => {
    checkScores(scoreP1, scoreP2, roundScore);
    $(event.currentTarget).addClass('active-btn');
    $(event.currentTarget).siblings().removeClass('active-btn');
    pointsToWin = 500;
    $currentP.text(pointsToWin);
});

$dice.on('click', event => {
    checkScores(scoreP1, scoreP2, roundScore);
    $(event.currentTarget).addClass('active-btn');
    $(event.currentTarget).siblings().removeClass('active-btn');
    twoDices = false;
    $dices.text('1');
    $img2.hide();
});

$dice2.on('click', event => {
    checkScores(scoreP1, scoreP2, roundScore);
    $(event.currentTarget).addClass('active-btn');
    $(event.currentTarget).siblings().removeClass('active-btn');
    twoDices = true;
    $dices.text('2');
    $img2.show();
});

$roll.on('click', () => {
if(gamePlaying){   
    if (twoDices){
        //stopMessage(timeT);
        //stopMessage(timeR);
        rolled = roll();
        rolled2 = roll();

        changeImg($img1, rolled);
        changeImg($img2, rolled2);

        twoRolls = rolled + rolled2;
        rollMessage(rolled, rolled2);
        if (twoRolls === 2 || twoRolls === 12){
            turnMessage();
            nextPlayer();
        } else {
            roundScore += twoRolls;
            if (activePlayer === 0){
                $current1.text(roundScore);
                totalScore = roundScore + scoreP1;
                if(totalScore >= pointsToWin){
                    $player1.text('Winner!');
                    gamePlaying = false;
                }
            } else {
                $current2.text(roundScore);
                totalScore = roundScore + scoreP2;
                if(totalScore >= pointsToWin){
                    $player2.text('Winner!');
                    gameplaying = false;
                }
            }
        }
    } else {
        //stopMessage(timeT);
        //stopMessage(timeR);
        rolled = roll();
        rollMessage(rolled);
        changeImg($img1, rolled);
        timesRolled++;
        if (rolled === 1){
            turnMessage();
            nextPlayer();
        } else {
            roundScore += rolled;
            if (activePlayer === 0){
                $current1.text(roundScore);
                totalScore = roundScore + scoreP1;
                if(totalScore >= pointsToWin){
                    $player1.text('Winner!');
                    gamePlaying = false;
                }
            } else {
                $current2.text(roundScore);
                totalScore = roundScore + scoreP2;
                if(totalScore >= pointsToWin){
                    $player2.text('Winner!');
                    gamePlaying = false;
                }
            }
        }  
    }
} else {

}
});

$hold.on('click', () => {
if(gamePlaying){
    hideImg();

    if (activePlayer === 0){
        scoreP1 += roundScore;
        $score1.text(scoreP1);
        if (scoreP1 >= pointsToWin){
            $player1.text('Winner!');
            gamePlaying = false;
        } else {
            nextPlayer();
        }
    } else {
        scoreP2 += roundScore;
        $score2.text(scoreP2);
        if (scoreP2 >= pointsToWin){
            $player2.text('Winner!');
            gamePlaying = false;
        } else {
            nextPlayer();
        }
    }
}
});


function init(){
    gamePlaying = true;
    scoreP1 = 0;
    scoreP2 = 0;
    activePlayer = 0;
    roundScore = 0;
    twoDices = false;
    timesRolled = 0;
    pointsToWin = 100;

    $img2.hide();

    $player1.text('Player 1');
    $player2.text('Player 2');

    $currentP.text(100);
    $dices.text('1');

    $score1.text('0');
    $score2.text('0');

    $current1.text('0');
    $current2.text('0');

    $player1.addClass('active-player');
    $player2.removeClass('active-player');

    $pointsW100.addClass('active-btn');
    $pointsW100.siblings().removeClass('active-btn');

    $dice.addClass('active-btn');
    $dice.siblings().removeClass('active-btn');

    hideImg();

}

function checkScores(s1, s2, round){
    if(s1 > 0 || s2 > 0 || round > 0){
        init();
    }else{
        return;
    }
}

function roll() {
    return Math.floor(Math.random() * 6) + 1;
}


function nextPlayer(){
    roundScore = 0;
    if(activePlayer === 0){
        $player1.removeClass('active-player');
        $current1.text('0');
        activePlayer = 1;
        $player2.addClass('active-player');
        hideImg();
    } else {
        $player2.removeClass('active-player');
        $current2.text('0');
        activePlayer = 0;
        $player1.addClass('active-player');
        hideImg();
    }
}


function hideImg(){
    $img1.attr('src', '');
    $img2.attr('src', '');
}

function changeImg(img ,num){
    img.attr('src', 'img/dice' + num + '.png');
}

function rollMessage(num, num2 = 0){
    let total = num + num2;
    $rollSta.text('Rolled ' + total);
    timeR = setTimeout(() => {
        $rollSta.text('');
    }, 2000);
}

function turnMessage(){
    $turn.text('Turn Over');
    timeT = setTimeout(() => {
        $turn.text('');
    }, 2000);
}

function stopMessage(time){
    clearTimeout(time);
}
});