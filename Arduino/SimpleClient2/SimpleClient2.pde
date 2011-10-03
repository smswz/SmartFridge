/*
 * A simple sketch that uses WiServer to get the hourly weather data from LAX and prints
 * it via the Serial API
 */

#include <WiServer.h>

#define WIRELESS_MODE_INFRA	1
#define WIRELESS_MODE_ADHOC	2
#define OPEN  0
#define WEP  1
#define WPA  2
#define WPA2  3


// Wireless configuration parameters ----------------------------------------
unsigned char local_ip[] = {192,168,1,13};	// IP address of WiShield
unsigned char gateway_ip[] = {192,168,1,1};	// router or gateway IP address
unsigned char subnet_mask[] = {255,255,255,0};	// subnet mask for the local network
const prog_char ssid[] PROGMEM = {"dd-wrt"};		// max 32 bytes

unsigned char security_type = WPA;	// 0 - open; 1 - WEP; 2 - WPA; 3 - WPA2

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


// Function that prints data from the server
void printData(char* data, int len) {
  
  // Print the data returned by the server
  // Note that the data is not null-terminated, may be broken up into smaller packets, and 
  // includes the HTTP header. 
  while (len-- > 0) {
    Serial.print(*(data++));
  } 
}


// IP Address for www.weather.gov  
uint8 ip[] = {50,22,139,222};

// A request that gets the latest METAR weather data for LAX
GETrequest goUpdate(ip, 80, "uec.gsverse.com", "/smartFridge/sqlite.php?put&fid=2&sid=45&value=6666");


void setup() {
  
  Serial.write("Connecting to the Wifi Router\n");
  // Initialize WiServer (we'll pass NULL for the page serving function since we don't need to serve web pages) 
  WiServer.init(NULL);
  
  // Enable Serial output and ask WiServer to generate log messages (optional)
  Serial.begin(57600);
  WiServer.enableVerboseMode(true);

  // Have the processData function called when data is returned by the server
  goUpdate.setReturnFunc(printData);
  
  Serial.write("Connectioned established... Initalized...\n");
}

void loop(){
  
  Serial.write("Going..\n");
  
  // Run WiServer
  WiServer.server_task();
 
  delay(10000);
}
