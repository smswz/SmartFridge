
// constants won't change. They're used here to 
// set pin numbers:
const int muxSigPin = 0;     // The pin the MUX SIG is attached to
const int muxS0 = 6;
const int muxS1 = 5;
const int muxS2 = 4;
const int muxS3 = 3;

const int ledPin =  13;      // the number of the LED pin

const String rootString = "/smartFridge/sqlite.php?put&fid=";
const String fridgeID = String(2);
const String eggID = "eggs";
const String tempID = "temp";
char temperatureFloat[32];

// variables will change:
int eggsCovered = 0;
int temperature = 0;


void setup() {
  
  Serial.begin(9600);
  // initialize the LED pin as an output:
  pinMode(ledPin, OUTPUT); 
  
  pinMode(muxS0, OUTPUT);
  pinMode(muxS1, OUTPUT);
  pinMode(muxS2, OUTPUT);
  pinMode(muxS3, OUTPUT);
  
  setInput(0);
  
  // initialize the pushbutton pin as an input:
  pinMode(muxSigPin, INPUT);     
}

void setInput(int buttonNumber){
  // select input buttonNumber on the MUX 
  digitalWrite(muxS0, buttonNumber & 1);   
  digitalWrite(muxS1, (buttonNumber & 2)>>1); 
  digitalWrite(muxS2, (buttonNumber & 4)>>2); 
  digitalWrite(muxS3, (buttonNumber & 8)>>3);   
}

bool sensorCovered(int sensorNumber){
    static const int sensorCoveredValue[13] = {
	600, // Light sensor
	600, // Egg 1
	600, // Egg 2
	900, // Egg 3
	730, // Egg 4
	600, // Egg 5
	600, // Egg 6
	600, // Egg 7
	600, // Egg 8
	700, // Egg 9
	600, // Egg 10
	600, // Egg 11
	600 // Egg 12
    };
    setInput(sensorNumber);
    //Serial.print(String(sensorNumber) + " ");
    //Serial.println(analogRead(0));
    if(analogRead(0) > sensorCoveredValue[sensorNumber]){
	//if(sensorNumber == 1){ // backwards
	    //return true;
	//}
	return false;
    } else {
	//if(sensorNumber == 1){ // backwards
	  //  return false;
	//}
	return true;
    }
}

void loop(){
    // read the state of the photocell values:
    while(sensorCovered(0)){};
    while(!sensorCovered(0)){};
    
    eggsCovered = 0;
    for (int i=1; i < 10; i++){
	eggsCovered += sensorCovered(i) ? 1 : 0;
	delay(10);
       }
    //temperature = (int)((analogRead(0) * .004882814 - .5) * 100 * 100);
    Serial.println("Eggs remaining: " + String(eggsCovered));
    //Serial.println(rootString + fridgeID + "&sid=" + eggID + "&value=" + String(eggsCovered));
    //Serial.println(rootString + fridgeID + "&sid=" + tempID + "&value=" + String(temperature / 100) + '.' + String(temperature%100));

  
    delay(200);
}
