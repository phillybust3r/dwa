/**
* A simple memory card game
*
* @class Memory
* @constructor set_board
*
* Usage:
* 	Create two divs, one with id "board", one with id "miss"
* 	Initiate game, specifying how many cards you want to play with:
* 	Memory.set_board("board", "miss", 10);
* 
* 
*/

var Hangman = {
	
	// {int} Keep a running total of points
	misses: 0,
	
	// {Object} HTML Objects
	board: '',
	miss: '',
	
	// {array} To label the cards with
	alphabet: ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'],
	
	
	words: ['GIFTS', 'WREATH', 'THANKSGIVING', 'CHRISTMAS', 'MISTLETOE'],
	
	word_index: 0,
	
	word: '',
	
	// this keeps track of the number of words guessed
	guess_count: 0,
	
	guessed: '',
	
	
	// the maximum number of misses allowed
	max_misses: 7,
	
	
	
	
	word_to_guess: '',
	
	// this is the array for the tiles
	tileArr: [],
	
	// this keeps track of the position of matches
	matches: [],
	
		
	/*-------------------------------------------------------------------------------------------------
	@param {string} id_of_board
	@param {string} id_of_miss
	@param {int}    how_many_cards
	@return void
	-------------------------------------------------------------------------------------------------*/
	set_board: function(id_of_board, id_of_miss, id_of_word, id_of_guessed) {
			
		// First, identify the board and the miss objects
		this.board      = $('#' + id_of_board);
		this.miss = $('#' + id_of_miss);
		this.word =  $('#' + id_of_word);
		this.guessed = $('#' + id_of_guessed);
		
		this.words = this.shuffle(this.words);

		


		var tilesStr = String();
		
		this.setup_word();
			
		for (var i = 0; i < (this.alphabet).length; i++) {
		
			this.tileArr[i] = "<div class='tile clickable' id='tile" + this.alphabet[i] + "'>" + "<img src='/images/" + this.alphabet[i] + ".png'" + " alt='" + this.alphabet[i] + "' height='40' width='40'" + "/>" + "</div>";
			
			if (i == 12) {
				this.tileArr[i] = this.tileArr[i] + "<br><br><br>";
			}
			
		}
		
	
		tilesStr = "<div id='alphabetwrapper'>";
	
		for(var tile in this.tileArr) {
			tilesStr = tilesStr + this.tileArr[tile];
		}
		
		tilesStr = tilesStr + "</div>";
		
		console.log(tilesStr);
	
	
		
		// Now inject the cards string into the game board
		this.board.html(tilesStr);
		
		// Set up the event listener for the cards
		// Have to use "Memory" instead of "this" because in this context "this" is referring to the event handler, not the class
		// Also, have to use "on" method instead of "click" because we'll be adding and removing the "clickable" class and will need to re-register the listener
		// See http://api.jquery.com/on/ for more details
		$('.clickable').on('click', function() {
			Hangman.choose_a_card($(this));
		});
		
	 
	},
	/*-------------------------------------------------------------------------------------------------
	@param {Object}: HTML element; the card that was clicked
	-------------------------------------------------------------------------------------------------*/
	choose_a_card: function(cardObj) {
	
		console.log("NUM MISSES: " + this.misses);
		
	
		if (parseInt(this.misses) < this.max_misses) {
	
			var cardObjStr = cardObj.html();		
		
			// the letter selected is at position 30		
			var letter_clicked = cardObjStr[30];
		
			console.log("LETTER: " + letter_clicked);
		
			var found = false;
		
			// find match
			for (var i = 0; i <	this.word_to_guess.length; i++) {
				console.log(this.word_to_guess[i]);
				if (letter_clicked == this.word_to_guess[i]) {
				
					this.update_word(letter_clicked, i);
					found = true;
				}
			
				
			}
		
			// Flip the card and remove the clickable class so it can't be clicked again
			cardObj.addClass('flipped');
			cardObj.removeClass('clickable');
		
			if (!found) {
				// Update the miss
				this.misses++;	
			}
		
			// Update the miss
			this.miss.html(this.misses);
		
			this.word_guessed();
		
		}
		else {
		
			console.log("GAME OVER");
			
			var gameOver = "<div class='gameOver' id='gameOver'> <img src='/images/gameover.png' alt='GAME OVER' height='250' width='500'/></div>";
			
			this.word.html(gameOver);

		}		
	},
	/*-------------------------------------------------------------------------------------------------
	From: http://dzone.com/snippets/array-shuffle-javascript
	-------------------------------------------------------------------------------------------------*/
	shuffle: function(obj){ 
    	for(var j, x, i = obj.length; i; j = parseInt(Math.random() * i), x = obj[--i], obj[i] = obj[j], obj[j] = x);
    	return obj;
    },
	
	
	 update_word: function(matched, index){
	
		// update the matches
		this.matches[index] = true;
		
		var wordStr = String();
		
		
		for (var i = 0; i < this.word_to_guess.length; i++) {
			
			// display the matched letter
			if (this.matches[i]) {
			
				wordStr += "<div class='word' id='word" + this.word_to_guess[i] + "'>" + "<img src='/images/" + this.word_to_guess[i] + ".png'" + " alt='" + this.word_to_guess[i] + "' height='100' width='100'" + "/>" + "</div>";
						
			}
			// display a red block
			else {
				wordStr += "<div class='word' id='word" + this.word_to_guess[i] + "'>" + "<img src='/images/blank.png'" + " alt='" + this.word_to_guess[i] + "' height='100' width='100'" + "/>" + "</div>";
			}			
		}
						
		this.word.html(wordStr);
	
	},
	
	setup_word: function() {
	
			
		this.word_to_guess = this.words[this.word_index];
		
		console.log("WORD INDEX: " + this.word_index);
	
		var wordArr = [];
		
		var wordStr = String();
		
		for (var i = 0; i < this.word_to_guess.length; i++) {
			console.log(this.word_to_guess[i]);
			
			this.matches[false];
			
			wordArr[i] = "<div class='word' id='word" + this.word_to_guess[i] + "'>" + "<img src='/images/blank.png'" + " alt='" + this.word_to_guess[i] + "' height='100' width='100'" + "/>" + "</div>";
			
			wordStr = wordStr + wordArr[i];	

		}
			
		this.word.html(wordStr);
		
	},
	
	word_guessed: function() {
	
		var count = 0;
		for (var i = 0; i < this.word_to_guess.length; i++) {
			if (this.matches[i]) {
				count++;
			}
		}
		if (count == this.word_to_guess.length) {
			this.guess_count++;

			this.guessed.html(this.guess_count);
			
			// increment to the next word
			this.word_index++;
		}
	}

	
	
}; // eoc





