// These are the various "screens" that can popup throughout the game.

// The main intro screen, shows the backdrop and a message to tap.
void showIntro()
{
    if (audioEnabled) { audioMenu.play(); }

    // Backdrop
    image(imgMenu, 0, 0);
    
    // Drop shadow
    fill(0);
    rect((width / 2) - 175 + 1, (height / 2) - 25 + 280 + 1, 350, 35, 10);
    
    // Main rectagle (rounded)
    fill(255);
    rect((width / 2) - 175, (height / 2) - 25 + 280, 350, 35, 10);
    
    // Text
    textSize(20);
    textAlign(CENTER);
    fill(0);
    text("Нажми, чтобы начать новую игру!", width / 2, (height / 2) + 280);
}

// This draws the white rectangle popup on the page, with a fancy drop shadow.
void drawMessageArea()
{
    // Drop Shadow
    fill(0);
    rect((width / 2) - (messageWidth / 2) + 3, (height / 2) - (messageHeight /2) + 3, messageWidth, messageHeight, 10);

    fill(255);
    rect((width / 2) - (messageWidth / 2), (height / 2) - (messageHeight /2), messageWidth, messageHeight, 10);
}

// This draws a message, for loading messages, etc.
void drawMessage(String message)
{
    fill(255);
    rect((width / 2) - 100, (height / 2) - 10, 200, 20, 3);
    
    textFont(fontSerif);
    textSize(20);
    textAlign(CENTER);
    fill(0);
    text(message, width / 2, (height / 2) + 5);
}

// The game over screen, plays the relevant audio and shows the score status.
void gameOver()
{
    if (audioEnabled) { audioGameOver.play(); }

    image(imgBackgroundOver, 0, 0);

    drawMessageArea();

    fill(0);
    textFont(fontSerif);
    textSize(50);
    textAlign(CENTER);
    text("ИГРА ОКОНЧЕНА", width / 2, (height / 2) - 40);

    textSize(25);
    textAlign(LEFT);
    text("Итоговый счет:", width / 2 - (messageWidth / 2) + 100, (height / 2));

    textSize(20);
    textAlign(LEFT);
    image(imgMoneyIcon, width / 2 - (messageWidth / 2) + 75, (height / 2) + 10);
    text ("Ты заработал $" + levelScore + ".", width / 2 - (messageWidth / 2) + 100, (height/2) + 30);
    image(imgZombieIcon, width / 2 - (messageWidth / 2) + 75, (height / 2) + 33);
    text ("Ты 'позаботился' о " + levelKills + " мертвецах.", width / 2 - (messageWidth / 2) + 100, (height/2) + 50);

    textSize(16);
    textAlign(CENTER);
    text("Нажми, чтоб начать новую игру!", width / 2, (height / 2) + 80);
}

// The level start screen. Shows how many zombies there will be, and how much extra ammo the player
// gets.
void levelStartScreen()
{
    if (audioEnabled) { if (audioMenu.paused) { audioMenu.play(); } } // Restart menu audio.

    drawMessageArea();

    fill(0);
    textFont(fontSerif);
    textSize(50);
    textAlign(CENTER);

    text("Уровень " + currentLevelNumber + ", Готов?", width / 2, height / 2 - 40);

    textSize(22);
    textAlign(LEFT);
    image(imgAmmoIconBlack, width / 2 - (messageWidth / 2) + 75, (height / 2) - 17);
    text("Ты получил " + currentLevel.getExtraAmmo() + " пуль.", width / 2 - (messageWidth / 2) + 100, (height / 2));
    image(imgZombieIcon, width / 2 - (messageWidth / 2) + 75, (height / 2) + 8);
    text("Здесь нужно 'позаботиться' о " + currentLevel.totalZombies() + " зомби.", width / 2 - (messageWidth / 2) + 100, (height / 2) + 25);

    textSize(20);
    textAlign(CENTER);
    text("Нажми, чтобы начать!", width / 2, (height / 2) + 75);
}

// End of Level, shows the score and how the level ended (all zombies killed, or daylight arrived).
void endOfLevel()
{
    drawMessageArea();

    fill(0);
    textFont(fontSerif);
    textSize(50);
    textAlign(CENTER);
    text("Уровень " + currentLevelNumber + " пройден!", width / 2, (height / 2) - 50);

    textSize(20);
    textAlign(CENTER);

    if (currentState == GameState.END_LEVEL_ALL_DEAD)
    {
        text("Ты убил всех зомби!", width/2, (height/2) - 20);
    }
    else if (currentState == GameState.END_LEVEL_DAYLIGHT)
    {
        text("Ты не дожил до рассвета!", width/2, (height/2) - 20);
    }

    textAlign(LEFT);
    image(imgMoneyIcon, width / 2 - (messageWidth / 2) + 75, (height / 2) - 5);
    text ("Ты заработал $" + levelScore + ".", width / 2 - (messageWidth / 2) + 100, (height/2) + 15);
    image(imgZombieIcon, width / 2 - (messageWidth / 2) + 75, (height / 2) + 18);
    text ("Ты 'позаботился' о " + levelKills + " мертвецах.", width / 2 - (messageWidth / 2) + 100, (height/2) + 35);

    textSize(20);
    textAlign(CENTER);
    text("Нажми, чтобы вернуться к уровню " + (currentLevelNumber+1) + "!", width / 2, (height / 2) + 75);
}

// Completed the game!! Impossible to reach in the demo due to level 3, but will work if you give
// proper level definitions. Could have a scoreboard and stuff here.
void completedGame()
{
    background(0);
    fill(255);

    textFont(fontSerif);
    textSize(50);
    textAlign(CENTER);
    text("Ты прошел игру!", width / 2, height / 2);

    textSize(30);
    textAlign(CENTER);
    text("Итоговый счёт - $" + totalScore + " Убийств: " + totalKills, width / 2, (height / 2) + 40);
}
