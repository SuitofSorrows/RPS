<?php


echo "Let's play Rock, Paper, Scissors!!\nTo start, just type 'ready'.\n";


$wins = 0;
$losses = 0;

// Launches game based on response
function beginGame(){
    $beginGame = getInput();
    if ($beginGame === 'ready') {
        weaponSelect();
        startGame();
    } else {
        printLine("Try again, and this time...follow the instructions!\n");
        beginGame();
    }
}

// Main function of the game; Takes user input, random choice for computer
function startGame(){
    $choices = ['rock', 'paper', 'scissors'];
    $randomChoice = random_int(0, 2);
    $computerChoice = $choices[$randomChoice];

    $userChoice = getInput();
    if ($userChoice !== 'rock' && $userChoice !== 'paper' && $userChoice !== 'scissors' && $userChoice === ''){
        printLine("Try again.\n");
    }
    printLine('Computer chose: ' . $computerChoice . "\n");
    winningComparison($userChoice, $computerChoice);
    endGame();
}


function printLine($msg){
    echo $msg . PHP_EOL;
}

// Evaluates user and computer choice to determine winner
/**
 * @param $input
 * @param $computerChoices
 */

function winningComparison($input, $computerChoices){
    global $wins, $losses;

    if ($input === $computerChoices){
        printLine('Tie!');
    } elseif ($input === 'rock' && $computerChoices === 'paper'){
        printLine('You lose!');
        $losses++;
    } elseif ($input === 'paper' && $computerChoices === 'scissors'){
        printLine('You lose!');
        $losses++;
    } elseif ($input === 'scissors' && $computerChoices === 'rock'){
        printLine('You lose!');
        $losses++;
    } else {
        printLine('You win!');
        $wins++;
    }
    displayScore($wins, $losses);
}

// Ends the game if 5 win limit is met
function endGame() {
    global $wins, $losses;

    if ($wins === 5) {
        printLine('Congratulations!! You\'re the big winner!!');
        againMessage();
        playAgain();
    } elseif ($losses === 5) {
        printLine('Sorry, better luck next time!!');
        againMessage();
        playAgain();
    }
    else {
        printLine("Don't stop now, it's best of 5! Go again...");
        startGame();
    }
}

// Input to play again or quit
function playAgain() {
    $playAgain = getInput();
    if ($playAgain === 'yes') {
        resetScore();
        weaponSelect();
        startGame();
    } elseif ($playAgain === 'no') {
        quitMessage();
    } else {
        printLine('Please answer \'Yes\' or \'No\'.');
    }
}

function resetScore() {
    global $wins, $losses;

    if ($wins === 5) {
        $wins = 0;
        $losses = 0;
    } elseif ($losses === 5) {
        $wins = 0;
        $losses = 0;
    }
}

// Messages to display based on situation
function againMessage() {
    printLine('Would you like to play again? Type \'Yes\' or \'No\'');
}

function weaponSelect() {
    printLine('Good luck...pick your weapon.');
}

function quitMessage() {
    printLine('See you next time!');
}

function displayScore($win, $loss){
    printLine("\nWins: {$win} \nLosses: {$loss}");
}

// Input for terminal
function getInput(){
    $stdin = fopen('php://stdin' , 'rb');
    $input = '';
    $isValid = false;
    while (!$isValid) {
        $input = trim(fgets($stdin));
        $isValid = true;
    }
    return strtolower($input);
}

beginGame();