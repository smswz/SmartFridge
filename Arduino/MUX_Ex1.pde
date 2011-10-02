/*
  Button
 
 Turns on and off a light emitting diode(LED) connected to digital  
 pin 13, when pressing a pushbutton attached to pin 2. 
 
 
 The circuit:
 * LED attached from pin 13 to ground 
 * pushbutton attached to pin 2 from +5V
 * 10K resistor attached to pin 2 from ground
 
 * Note: on most Arduinos there is already an LED on the board
 attached to pin 13.
 
 
 created 2005
 by DojoDave <http://www.0j0.org>
 modified 28 Oct 2010
 by Tom Igoe
 
 This example code is in the public domain.
 
 http://www.arduino.cc/en/Tutorial/Button
 */

// constants won't change. They're used here to 
// set pin numbers:
const int muxSigPin = 2;     // The pin the MUX SIG is attached to
const int muxS0 = 6;
const int muxS1 = 5;
const int muxS2 = 4;
const int muxS3 = 3;

const int ledPin =  13;      // the number of the LED pin

// variables will change:
int buttonsPressed = 0;


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

void setInput(int buttonNumber)
{
  // select input buttonNumber on the MUX 
  digitalWrite(muxS0, buttonNumber & 1);   
  digitalWrite(muxS1, buttonNumber & 2); 
  digitalWrite(muxS2, buttonNumber & 4); 
  digitalWrite(muxS3, buttonNumber & 8);   
}

void loop(){
  buttonsPressed = 0;
  // read the state of the pushbutton value:
  for (int i=0; i <= 3; i++){
    setInput(i);
    buttonsPressed += digitalRead(muxSigPin);
    delay(10);
   } 
  Serial.println(buttonsPressed, DEC);
  delay(200);
}
