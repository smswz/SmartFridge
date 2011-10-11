#ifndef ENABLE_CLIENT_MODE
#define ENABLE_CLIENT_MODE
#endif
#include <WiServer.h>

#define WIRELESS_MODE_INFRA	1
#define WIRELESS_MODE_ADHOC	2

// Wireless configuration parameters ----------------------------------------
unsigned char local_ip[] = {192,168,1,12};	// IP address of WiShield
unsigned char gateway_ip[] = {192,168,1,1};	// router or gateway IP address
unsigned char subnet_mask[] = {255,255,255,0};	// subnet mask for the local network
const prog_char ssid[] PROGMEM = {"dd-wrt"};		// max 32 bytes

unsigned char security_type = 2;	// 0 - open; 1 - WEP; 2 - WPA; 3 - WPA2

// WPA/WPA2 passphrase
const prog_char security_passphrase[] PROGMEM = {"Shadow12"};	// max 64 characters

// WEP 128-bit keys
// sample HEX keys
prog_uchar wep_keys[] PROGMEM = { 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d,	// Key 0
				  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,	// Key 1
				  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00,	// Key 2
				  0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00	// Key 3
				};

// setup the wireless mode
// infrastructure - connect to AP
// adhoc - connect to another WiFi device
unsigned char wireless_mode = WIRELESS_MODE_INFRA;

unsigned char ssid_len;
unsigned char security_passphrase_len;
// End of wireless configuration parameters ----------------------------------------


// IP Address for inventionstudio.gatech.edu  
uint8 ip[] = {130,207,188,22};

// constants won't change. They're used here to 
// set pin numbers:
const int muxSigPin = 0;     // The pin the MUX SIG is attached to
const int muxS0 = 6;
const int muxS1 = 5;
const int muxS2 = 4;
const int muxS3 = 3;

const int ledPin =  13;      // the number of the LED pin

const String rootString = "/arduino/";
const String fridgeID = String(2);
const String urlDelim = "/";
const String eggID = "eggs";
const String tempID = "temp";
char temperatureFloat[32];

// variables will change:
int eggsCovered = 0;
int temperature = 0;

boolean sendNoPage(char* url){
    return true;
}

void setup() {
  

    WiServer.init(sendNoPage);
    WiServer.enableVerboseMode(true);

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
	return false;
    } else {
	return true;
    }
}

void loop(){
    GETrequest setEggs(ip, 80, "inventionstudio.gatech.edu", "null");
    GETrequest setTemp(ip, 80, "inventionstudio.gatech.edu", "null");
    char urlArray[48];
    // read the state of the photocell values:
    while(sensorCovered(0)){
	static int counter = 0;
	if(++counter == 10000){
	    setInput(14);
	    temperature = (int)((analogRead(0) * .004882814 - .5) * 100 * 100);
	    Serial.println("Temperature: " + String(temperature / 100) + '.' + String(temperature % 100) + 'C');
	    (rootString + "update_temp/" + fridgeID + urlDelim + tempID + urlDelim + String(temperature / 100) + '.' + String(temperature % 100)).toCharArray(urlArray, 48);
	    setTemp.setURL(urlArray);
	    setTemp.submit();
	    counter = 0;
	}
    }
    while(!sensorCovered(0)){}
    
    eggsCovered = 0;
    for (int i=1; i < 10; i++){
	eggsCovered += sensorCovered(i) ? 1 : 0;
	delay(10);
    }
    Serial.println("Eggs remaining: " + String(eggsCovered));
    (rootString + "update_eggs/" + fridgeID + urlDelim + eggID + urlDelim + String(eggsCovered)).toCharArray(urlArray, 48);
    setEggs.setURL(urlArray);
    setEggs.submit();

    WiServer.server_task();
    //Serial.println(rootString + fridgeID + "&sid=" + eggID + "&value=" + String(eggsCovered));
    //Serial.println(rootString + fridgeID + "&sid=" + tempID + "&value=" + String(temperature / 100) + '.' + String(temperature%100));

  
    delay(200);
}
