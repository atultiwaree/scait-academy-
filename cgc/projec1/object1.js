document.write("");
tuly = prompt();
function hotel(name,trm,brm,vrm,club){
	this.name=name;
	this.trm=trm;
	this.brm=brm;
	this.vrm= function(){
	          var avlb = this.trm-this.brm;
	          var percents = (brm/trm)*100;
              var arry = [avlb,percents];
	          return arry;

	};
}


var raman = new hotel('Raman Hotel',100,50,'hola');
raman.club = 'available';

var saman = new hotel('saman Hotel',50,25);
var gaman = new hotel('gaman Hotel',60,30);
var laman = new hotel('laman Hotel',20,10);
var daman = new hotel('daman Hotel',70,30);
var baman = new hotel('baman Hotel',80,30);
var taman = new hotel('taman Hotel',30,30);
var faman = new hotel('baman Hotel',80,30);


//alert(raman.vrm()[1]+"% rooms are booked");



switch(tuly){
	case 'raman':
	document.writeln("Name Of Hotel : "+raman.name+"<br>");
	document.write("Total Rooms     : "+raman.trm+"<br>");
	document.write("Occupied Rooms  : "+raman.brm+"<br>");
	document.write("Available Room : "+raman.vrm()[0]+" Hurry Only "+raman.vrm()[1]+"% are Available!<br>");
	document.write("<cite>Offer Only For You! :)--</cite> Get 10% off on  10 lakh/night <br> Royal Booking ")
	break;

		case 'saman':
	document.writeln("Name Of Hotel : "+saman.name+"<br>");
	document.write("Total Rooms     : "+saman.trm+"<br>");
	document.write("Occupied Rooms  : "+saman.brm+"<br>");
	document.write("Available Room : "+saman.vrm()[0]+" Hurry Only "+saman.vrm()[1]+"% are Available!<br>");
	document.write("<cite>Offer Only For You! :)--</cite> Get 20% off on  20 lakh/night <br> Hot Booking ")
	break;

		case 'gaman':
	document.writeln("Name Of Hotel : "+gaman.name+"<br>");
	document.write("Total Rooms     : "+gaman.trm+"<br>");
	document.write("Occupied Rooms  : "+gaman.brm+"<br>");
	document.write("Available Room : "+gaman.vrm()[0]+" Hurry Only "+gaman.vrm()[1]+"% are Available!<br>");
	document.write("<cite>Offer Only For You! :)--</cite> Get 30% off on  30 lakh/night <br> Loyal Booking ")
	break;

		case 'laman':
	document.writeln("Name Of Hotel : "+laman.name+"<br>");
	document.write("Total Rooms     : "+laman.trm+"<br>");
	document.write("Occupied Rooms  : "+laman.brm+"<br>");
	document.write("Available Room : "+laman.vrm()[0]+" Hurry Only "+laman.vrm()[1]+"% are Available!<br>");
	document.write("<cite>Offer Only For You! :)--</cite> Get 40% off on  05 lakh/night <br> Cool Booking ")
	break;

		case 'daman':
	document.writeln("Name Of Hotel : "+daman.name+"<br>");
	document.write("Total Rooms     : "+daman.trm+"<br>");
	document.write("Occupied Rooms  : "+daman.brm+"<br>");
	document.write("Available Room : "+daman.vrm()[0]+" Hurry Only "+daman.vrm()[1]+"% are Available!<br>");
	document.write("<cite>Offer Only For You! :)--</cite> Get 50% off on  50 thousand/night <br> royal Booking ")
	break;

		case 'baman':
	document.writeln("Name Of Hotel : "+baman.name+"<br>");
	document.write("Total Rooms     : "+baman.trm+"<br>");
	document.write("Occupied Rooms  : "+baman.brm+"<br>");
	document.write("Available Room : "+baman.vrm()[0]+" Hurry Only "+baman.vrm()[1]+"% are Available!<br>");
	document.write("<cite>Offer Only For You! :)--</cite> Get 29% off on  10 thousand/night very  <br> cheap Booking ")
	break;
	
	case 'taman':
	document.writeln("Name Of Hotel : "+taman.name+"<br>");
	document.write("Total Rooms     : "+taman.trm+"<br>");
	document.write("Occupied Rooms  : "+taman.brm+"<br>");
	document.write("Available Room : "+taman.vrm()[0]+" Hurry Only "+taman.vrm()[1]+"% are Available!<br>");
	document.write("<cite>Offer Only For You! :)--</cite> Get 80% off on  40 thousand/night  <br> cheap Booking ")
	break;

		case 'faman':
	document.writeln("Name Of Hotel : "+faman.name+"<br>");
	document.write("Total Rooms     : "+faman.trm+"<br>");
	document.write("Occupied Rooms  : "+faman.brm+"<br>");
	document.write("Available Room : "+faman.vrm()[0]+" Hurry Only "+faman.vrm()[1]+"% are Available!<br>");
	document.write("<cite>Offer Only For You! :)--</cite> Get 34% off on  90 thousand/night <br> pro Booking ")
	break;

	default:
	document.write("You have entered<br>"+"<b><cite>"+tuly+"</cite></b>"+"  which is not allowed!<br>");
	document.write("Refresh This Page to enter valid name")
	break;


}



























