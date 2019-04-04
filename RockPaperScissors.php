<?php


echo "Let's play Rock, Paper, Scissors!!\nTo start, just type 'ready'.\n";


function beginGame(){
    $beginGame = getInput();
    if ($beginGame === 'ready') {
        printLine("Good luck...pick your weapon.");
        startGame();
    } else {
        echo "Try again!\n";
        beginGame();
    }
}

function startGame(){
    $choices = ['rock', 'paper', 'scissors'];
    $randomChoice = random_int(0, 2);
    $computerChoice = $choices[$randomChoice];

    $userChoice = getInput();
    if ($userChoice !== 'rock' || $userChoice !== 'paper' || $userChoice !== 'scissors'){
        echo "Try again.\n";
    }
    echo 'Computer chose: ' . $computerChoice . "\n";
    winningComparison($userChoice, $computerChoice);
}

//function userChoice(){
////    $userChoice = getInput();
////    if ($userChoice !== 'rock' || $userChoice !== 'paper' || $userChoice !== 'scissors'){
////        echo "Try again.\n";
////}



function printLine($msg){
    echo $msg . PHP_EOL;
}


/**
 * @param $input
 * @param $choices $choices[]
 */

function winningComparison($input, $computerChoices){
    if ($input === $computerChoices){
        echo 'Tie!';
    } elseif ($input === 'rock' && $computerChoices === 'paper'){
        echo 'You lose!';
    } elseif ($input === 'paper' && $computerChoices === 'scissors'){
        echo 'You lose!';
    } elseif ($input === 'scissors' && $computerChoices === 'rock'){
        echo 'You lose!';
    } else {
        echo 'You win!';
        return;
    }
}


function checkResponse($response, $expected){
    return $response === strtolower($expected);
}


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