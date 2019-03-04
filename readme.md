# Bees In The Trap
A game created by Harrison C Parker based on the 
waxim/[beegame](https://github.com/waxim/beegame/blob/master/BeeGame.md) 
technical test.

### Starting the game
1. run `composer install` in the root directory.
2. run `./beesinthetrap new-game`.

### Commands
- `hit` - Hits a random bee.
  - `hit {number}` - Hits the bee with that number associated.
  - `hit {bee type}` - Hits a bee of that bee type.
    - Bee types: `DroneBee`, `WorkerBee`, `QueenBee`.
- `examine` - Gives a summary of the beehive.
- `exit` - Exits the game.