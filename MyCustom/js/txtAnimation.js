const TypeWriter = function(txtElement, words, wait = 2000) {
	this.txtElement = txtElement;
	this.words      = words;
	this.txt        = '';
	this.wordIndex  = 0;
	this.wait       = parseInt(wait, 10);
	this.type();
	this.isDeleting = false;
}

// type method
TypeWriter.prototype.type = function() {
	// Current index of word
	const current = this.wordIndex % this.words.length;

	// Get full text of current word
	const fullTxt = this.words[current];

	// Check if deleting
	if (this.isDeleting) {
		// remove a character
		this.txt = fullTxt.substring(0, this.txt.length - 1);
	} else {
		// add a character
		this.txt = fullTxt.substring(0, this.txt.length + 1);
	}

	// Insert txt into element
	this.txtElement.innerHTML = `<span class="txt">${this.txt}</span>`;

	// Initial type speed
	let typeSpeed = 300;

	if (this.isDeleting) {
		typeSpeed /= 2;
	}

	// if word is complete
	if (!this.isDeleting && this.txt === fullTxt) {
		// make pause at end
		typeSpeed = this.wait;

		// set delete to true
		this.isDeleting = true;
	} else if (this.isDeleting && this.txt === '') {
		// set delete to false
		this.isDeleting = false;

		// move to next word
		this.wordIndex++;

		// pause before start typing
		typeSpeed = 500;
	}

	setTimeout(() => this.type(), typeSpeed)
}

// Initialize On DOM Load
document.addEventListener('DOMContentLoaded', init);

// Initialize the span tag
function init() {
	const txtElement = document.querySelector('.txt-type');
	const words      = JSON.parse(txtElement.getAttribute('data-words'));
	const wait       = txtElement.getAttribute('data-wait');

	// Initialize TypeWriter
	new TypeWriter(txtElement, words, wait);
}
