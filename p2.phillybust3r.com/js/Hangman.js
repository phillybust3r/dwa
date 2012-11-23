/**
* A simple memory card game
*
* @class Memory
* @constructor set_board
*
* Usage:
* 	Create two divs, one with id "board", one with id "scoreboard"
* 	Initiate game, specifying how many cards you want to play with:
* 	Memory.set_board("board", "scoreboard", 10);
* 
* 
*/

var Hangman = {
	
	// {int} Keep a running total of points
	points: 0,
	
	// {Object} HTML Objects
	board: '',
	scoreboard: '',
	
	// {array} To label the cards with
	alphabet: ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'],
	
	// {int} Keep track of how many cards are flipped, so when two are flipped up we know it's time to flip them back down
	flipped_card_count: 0,
	
	words: ['GIFTS', 'WREATH', 'THANKSGIVING', 'CHRISTMAS'],
	
	word_index: '',
	
	word_to_guess: [],
		
	/*-------------------------------------------------------------------------------------------------
	@param {string} id_of_board
	@param {string} id_of_scoreboard
	@param {int}    how_many_cards
	@return void
	-------------------------------------------------------------------------------------------------*/
	set_board: function(id_of_board, id_of_scoreboard, how_many_cards) {
			
		// First, identify the board and the scoreboard objects
		this.board      = $('#' + id_of_board);
		this.scoreboard = $('#' + id_of_scoreboard);

		// This will hold all the cards as we load them, so we can easily shuffle them
		var cardsArr = [];
	
		// This will hold the HTML string of divs that are our cards
		var cardsStr = String();
		
		
		var tilesStr = String();
		
		this.word_index = 0;
		
		
		this.word_to_guess = this.words[this.word_index];
		
		
		console.log(this.word_to_guess);
		
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
	
		var tileArr = [];
	
		for (var i = 0; i < (this.alphabet).length; i++) {
		
		
			tileArr[i] = "<div class='tile clickable' id='tile" + this.alphabet[i] + "'>" + "<img src='/images/" + this.alphabet[i] + ".png'" + "height='40' width='40'" + "/>" + "</div>";
			
			if (i == 12) {
				tileArr[i] = tileArr[i] + "<br><br><br>";
			}
			
			console.log(tileArr[i]);
		

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
	
		for(var tile in tileArr) {
			tilesStr = tilesStr + tileArr[tile];
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
	
		console.log(this.words[1]);
		
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
		
		// Update the scoreboard
		this.scoreboard.html(this.points);
		*/		
	},
	/*-------------------------------------------------------------------------------------------------
	From: http://dzone.com/snippets/array-shuffle-javascript
	-------------------------------------------------------------------------------------------------*/
	shuffle: function(obj){ 
    	for(var j, x, i = obj.length; i; j = parseInt(Math.random() * i), x = obj[--i], obj[i] = obj[j], obj[j] = x);
    	return obj;
    }
	
	
}; // eoc





