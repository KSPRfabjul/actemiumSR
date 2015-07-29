// Array to hold each digit's starting background-position Y value
var initialPosVisits = [0, -309, -618, -927, -1236, -1545, -1854, -2163, -2472, -2781];


var date1 = new Date('2011-09-09 00:00:00');
var date2 = new Date();
var nbrDays = Number(dateDiff(date1, date2));

// Initializing variables
var subStartVisits, subEndVisits;

// Splits each value into an array of digits
function splitToArrayVisits(input){
	var digitsVisits = new Array();
	var c = input.length;
	for (var i = 0; i < c; i++){
		var subStartVisits = input.length - (i + 1),
		subEndVisits = input.length - i;
		digitsVisits[i] = input.substring(subStartVisits, subEndVisits);
	}
	return digitsVisits;
}

function dateDiff(date1, date2){

	var diff = {};
	var tmp = date2 - date1;

	tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
    diff.sec = tmp % 60;                    // Extraction du nombre de secondes
 
    tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
    diff.min = tmp % 60;                    // Extraction du nombre de minutes
 
    tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
    diff.hour = tmp % 24;
	 
	tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
	diff.day = tmp;

	return diff.day;
}

// Sets the correct digits on load
function initialDigitCheckVisits(initial){
	// Creates the right number of digits
	var countVisits = initial.toString().length;

	var bit = 1;
	for (var i = 0; i < countVisits; i++){
		$("#countdown-visits").prepend('<li id="dvisits' + i + '"></li>');
		if (bit != (countVisits) && bit % 3 == 0) $("#countdown-visits").prepend('<li class="seperator"></li>');
		bit++;
	}
	// Sets them to the right number
	var digitsVisits = splitToArrayVisits(initial.toString());
	c = digitsVisits.length;
	for (var i = 0; i < c ; i++){
		$("#dvisits" + i).css({'background-position': '0 ' + initialPosVisits[digitsVisits[i]] + 'px'});
	}
}

// Start it up
initialDigitCheckVisits(nbrDays);