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
	
	// {int} Keep track of how many cards are flipped, so when two are flipped up we know it's time to flip them back down
	flipped_card_count: 0,
	
	words: ['GIFTS', 'WREATH', 'THANKSGIVING', 'CHRISTMAS'],
	
	word_index: '',
	
	word: '',
	
	
	word_to_guess: '',
	
	// this is the array for the tiles
	tileArr: [],
	
	// this keeps track of the number of matches
	number_of_matches: 0,
	
		
	/*-------------------------------------------------------------------------------------------------
	@param {string} id_of_board
	@param {string} id_of_miss
	@param {int}    how_many_cards
	@return void
	-------------------------------------------------------------------------------------------------*/
	set_board: function(id_of_board, id_of_miss, id_of_word, how_many_cards) {
			
		// First, identify the board and the miss objects
		this.board      = $('#' + id_of_board);
		this.miss = $('#' + id_of_miss);
		this.word =  $('#' + id_of_word);

		var tilesStr = String();
		
		this.setup_word();
		
		
		// create the tiles for the word to be guessed
		//for (var i = 0; i < 	
				
		// Loop for how many cards we're playing with
	/*	for(var i = 0; i < how_many_cards; i++) {
			
			// Every second card, choose a new random letter
			if(i % 2 == 0) {
				var random_letter = this.alphabet[Math.floor(this.alphabet.length * Math.random())];
			}
			
			// Add the card to the array
			cardsArr[i] = "<div class='ATile clickable' id='card" + i + "'>" + random_letter + "</div>";
			
		}
	*/	
	
	
		for (var i = 0; i < (this.alphabet).length; i++) {
		
			this.tileArr[i] = "<div class='tile clickable' id='tile" + this.alphabet[i] + "'>" + "<img src='/images/" + this.alphabet[i] + ".png'" + " alt='" + this.alphabet[i] + "' height='40' width='40'" + "/>" + "</div>";
			
			if (i == 12) {
				this.tileArr[i] = this.tileArr[i] + "<br><br><br>";
			}
			
			console.log(this.tileArr[i]);
	
		}
		
			
		//var tileArray = "<div class='ATile clickable' id='tile1'>V</div>";
		
		// Shuffle the deck / array
	//	cardsArr = this.shuffle(cardsArr);
				
		// Now load the cards array into a string
	/*	for(var card in cardsArr) {
			cardsStr = cardsStr + cardsArr[card];
		}		
	*/
	
		tilesStr = "<div id='alphabetwrapper'>";
	
		for(var tile in this.tileArr) {
			tilesStr = tilesStr + this.tileArr[tile];
		}
		
		tilesStr = tilesStr + "</div>";
	
	
		
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
	
		//$('#alphabetwrapper, .tile').css('background-color', 'red');
	
		var cardObjStr = cardObj.html();
		
		// console.log(cardObj.html());	
		
		console.log(cardObj);
		
		// the letter selected is at position 30		
		var letter_clicked = cardObjStr[30];
		
		console.log("LETTER: " + letter_clicked);
		
		var found = false;
		
		// find match
		for (var i = 0; i <	this.word_to_guess.length; i++) {
			console.log(this.word_to_guess[i]);
			if (letter_clicked == this.word_to_guess[i]) {
				
				this.update_word(letter_clicked);
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
		
		this.word.html(this.word_to_guess);
		
		this.setup_word();
		
		
		/*
			
		// If we already have two cards flipped, unflip them by removing the class "flipped"
		if(this.flipped_card_count == 2) {
			this.board.children().removeClass('flipped');
			this.board.children().addClass('clickable');
			
			// Reset the count
			this.flipped_card_count = 0;
		}
								
		// Increment count of how many cards are flipped
		this.flipped_card_count++;
		
		// To see if the cards match, figure out the letter in the other card vs selected card
		var other_card    = $('.flipped').html();
		var selected_card = cardObj.html();
		
		// Flip the card and remove the clickable class so it can't be clicked again
		cardObj.addClass('flipped');
		cardObj.removeClass('clickable');
	
		// If we have a match!
		if(other_card == selected_card) {
		
			// Award points
			this.points++;	
			
			// Fade out the two active cards
			$('.flipped').hide('slow');
		}
		
		// Update the miss
		this.miss.html(this.points);
		*/		
	},
	/*-------------------------------------------------------------------------------------------------
	From: http://dzone.com/snippets/array-shuffle-javascript
	-------------------------------------------------------------------------------------------------*/
	shuffle: function(obj){ 
    	for(var j, x, i = obj.length; i; j = parseInt(Math.random() * i), x = obj[--i], obj[i] = obj[j], obj[j] = x);
    	return obj;
    },
	
	
	 update_word: function(matched){
	
		console.log("MATCHED " + matched);
	
	
	},
	
	setup_word: function() {
	
		this.word_index = 0;
		
		this.word_to_guess = this.words[this.word_index];
	
		var wordArr = [];
		
		var wordStr = String();
		
		for (var i = 0; i < this.word_to_guess.length; i++) {
			console.log(this.word_to_guess[i]);
			
			wordArr[i] = "<div class='word' id='word" + this.word_to_guess[i] + "'>" + "<img src='/images/blank.png'" + " alt='" + this.word_to_guess[i] + "' height='100' width='100'" + "/>" + "</div>";

			wordStr = wordStr + wordArr[i];	

		}
		
		console.log(wordStr);
		
		this.word.html(wordStr);
		
	}

	
	
}; // eoc





