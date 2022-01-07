$(document).ready(function() {

const $1 = $('#1');
const $2 = $('#2');
const $3 = $('#3');
const $4 = $('#4');
const $5 = $('#5');
const $6 = $('#6');
const $7 = $('#7');
const $8 = $('#8');
const $9 = $('#9');

let time;
let time2;

const $lock1 = $('.lock1');
const $lock2 = $('.lock2');
const $lock3 = $('.lock3');
let locked1 = false;
let locked2 = false;
let locked3 = false;
document.getElementById('lockSta').innerHTML = "Locks: Disabled!";
document.getElementById('betSta').innerHTML = "Current Bet: ";

let _1, _2, _3, _4, _5, _6, _7, _8, _9;

let hasLocked = false;
let currentBet;
let win1;
let win2;
let win3;
let totalWin;

const cherry = 0;
const star = 1;
const seven = 2;
const bar = 3;

const bet1 = 1;
const bet2 = 2;
const bet3 = 3;
const bet5 = 5;
const bet10 = 10;

$('.lock').prop('disabled', true);

_1 = roll();
_4 = roll();
_7 = roll();
_2 = roll();
_5 = roll();
_8 = roll();
_3 = roll();
_6 = roll();
_9 = roll();

$1.attr('src', 'img/symbol' + _1 + '.png');
$4.attr('src', 'img/symbol' + _4 + '.png');
$7.attr('src', 'img/symbol' + _7 + '.png');
$2.attr('src', 'img/symbol' + _2 + '.png');
$5.attr('src', 'img/symbol' + _5 + '.png');
$8.attr('src', 'img/symbol' + _8 + '.png');
$3.attr('src', 'img/symbol' + _3 + '.png');
$6.attr('src', 'img/symbol' + _6 + '.png');
$9.attr('src', 'img/symbol' + _9 + '.png');

let coins = 500;
document.getElementById('numCoins').innerHTML = coins;

$('.instru').hide();


$('.info').on('click', event => {
    $(event.currentTarget).siblings().slideToggle();
});


$('#bet1').on('click', event => {
    $(event.currentTarget).addClass('selected-bet');
    $(event.currentTarget).siblings().removeClass('selected-bet');
    currentBet = 1;
    document.getElementById('betSta').innerHTML = "Current Bet: 1";
});

$('#bet2').on('click', event => {
    $(event.currentTarget).addClass('selected-bet');
    $(event.currentTarget).siblings().removeClass('selected-bet');
    currentBet = 2;
    document.getElementById('betSta').innerHTML = "Current Bet: 2";
});

$('#bet3').on('click', event => {
    $(event.currentTarget).addClass('selected-bet');
    $(event.currentTarget).siblings().removeClass('selected-bet');
    currentBet = 3;
    document.getElementById('betSta').innerHTML = "Current Bet: 3";
});

$('#bet5').on('click', event => {
    $(event.currentTarget).addClass('selected-bet');
    $(event.currentTarget).siblings().removeClass('selected-bet');
    currentBet = 5;
    document.getElementById('betSta').innerHTML = "Current Bet: 5";
});

$('#bet10').on('click', event => {
    $(event.currentTarget).addClass('selected-bet');
    $(event.currentTarget).siblings().removeClass('selected-bet');
    currentBet = 10;
    document.getElementById('betSta').innerHTML = "Current Bet: 10";
});

$lock1.on('click', () => {
    if (locked2 && locked3){
        disableError();
    } else {
        $lock1.toggleClass('locked', 'lock');
        $lock1.text($lock1.text() == 'LOCK' ? 'LOCKED' : 'LOCK');
        locked1 = !locked1; 
    }
});

$lock2.on('click', () => {
    if (locked1 && locked3){
        disableError();
    } else {
        $lock2.toggleClass('locked', 'lock');
        $lock2.text($lock2.text() == 'LOCK' ? 'LOCKED' : 'LOCK');
        locked2 = !locked2;
    }
})

$lock3.on('click', () => {
    if (locked1 && locked2){
        disableError();
    } else {
        $lock3.toggleClass('locked', 'lock');
        $lock3.text($lock3.text() == 'LOCK' ? 'LOCKED' : 'LOCK');
        locked3 = !locked3;
    }
})



$('#roll-btn').on('click', () => {
    if (currentBet <= coins){
        disableRoll();
        coins -= currentBet;
        document.getElementById('numCoins').innerHTML = coins;
        
        if (locked1 === false){
            _1 = roll();
            _4 = roll();
            _7 = roll();

            changeImg(_1, _4, _7, $1, $4, $7);
        } else {
            locked1 = true;
        }
        if (locked2 === false){
            _2 = roll();
            _5 = roll();
            _8 = roll();

            changeImg(_2, _5, _8, $2, $5, $8);
        } else {
            locked2 = true;
        }
        if (locked3 === false){
            _3 = roll();
            _6 = roll();
            _9 = roll();

            changeImg(_3, _6, _9, $3, $6, $9);
        } else {
            locked3 = true;
        }
        
        win1 = checkWin(_1, _2, _3, currentBet);
        win2 = checkWin(_4, _5, _6, currentBet);
        win3 = checkWin(_7, _8, _9, currentBet);
        
        totalWin = calculateWin(win1, win2, win3);


        hasLocked = checkLock(locked1, locked2, locked3);

        locked1 = resetLock($lock1);
        locked2 = resetLock($lock2);
        locked3 = resetLock($lock3);

        if (totalWin > 0){
            coins += totalWin;
            document.getElementById('numCoins').innerHTML = coins;
            document.getElementById('slotM').innerHTML = "You won " + totalWin + " coins!!";
            hasLocked = true;
            document.getElementById('lockSta').innerHTML = "Locks: Disabled!";
            document.getElementById('lockSta').style.color = 'red';
            $('.lock').prop('disabled', true);
        } else {
            document.getElementById('slotM').innerHTML = "No Win";
        }
    } else {
        disableError2();
    }
});



function roll() {
    return Math.floor(Math.random() * 4);
}

function disableRoll(){
    $('#roll-btn').prop('disabled', true);
        time = setTimeout(() => {
        $('#roll-btn').prop('disabled', false);
      }, 1000);
      
}

function disableError(){
    document.getElementById('errorMs').innerHTML = "You can only lock 2 columns at a time!";
    time2 = setTimeout(() => {
        document.getElementById('errorMs').innerHTML = "";
    }, 3000);
}

function disableError2(){
    document.getElementById('errorMs').innerHTML = "Bet not chosen or not enough coins!";
    time2 = setTimeout(() => {
        document.getElementById('errorMs').innerHTML = "";
    }, 3000);
}

function checkWin(num1, num2, num3, bet){
    if (num1 == num2 && num2 == num3){
        if (num1 == cherry){
            return bet * 2;
        } else if (num1 == star){
            return bet * 3;
        } else if (num1 == seven){
            return bet * 4;
        } else if (num1 == bar){
            return bet * 6;
        }
    } else {
        return 0;
    }
}

function checkLock(lock1, lock2, lock3){
    if (lock1 == true || lock2 == true || lock3 == true){
        $('.lock').prop('disabled', true);
        document.getElementById('lockSta').innerHTML = "Locks: Disabled!";
        document.getElementById('lockSta').style.color = 'red';
        return true;
    } else {
        $('.lock').prop('disabled', false);
        document.getElementById('lockSta').innerHTML = "Locks: Available!";
        document.getElementById('lockSta').style.color = 'green';
        return false;
    }
}

function resetLock(lock){
    lock.removeClass('locked');
    lock.text('LOCK');
    return false;
}

function calculateWin(win1, win2, win3){
    return win1 + win2 + win3;
}

function changeImg(num1, num2, num3, str1, str2, str3){
    str1.attr('src', 'img/symbol' + num1 + '.png');
    str2.attr('src', 'img/symbol' + num2 + '.png');
    str3.attr('src', 'img/symbol' + num3 + '.png');
}
});



















