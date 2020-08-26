#include <Arduino.h>

// Wifi
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>

#define USE_SERIAL Serial
ESP8266WiFiMulti WiFiMulti;
HTTPClient http;

// Telegram
#include "CTBot.h"
CTBot myBot;
String ssid = "Project";
String pass = "12345678";
String token = "1249704369:AAFumAy1cqLw62Mpu6JQqeXJFI0GnDAIb7w";
const int id = 949481085;

// lcd
#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 16, 2);

// SDA ---------------> D2
// SCL ---------------> D1
// VCC ---------------> VIN
// GND ---------------> GND

// servo
#include <Servo.h>
Servo servo;
#define pinServo D0

// Turbidity
int pinTurbidity = A0;
float kekeruhan;
float teg;
String air;

// relay
#define relay D6
#define relay_on LOW
#define relay_off HIGH

// PIN ULTRASONIK
#define echoPin D7
#define trigPin D8
float tinggi_pakan = 11, pakan;

String jadwal, pagi, siang, sore;

boolean cek_wifi = true, looping = true, loop_pakan = false, send_telegram = false;

String ambil_jadwal = "http://192.168.43.239/ikan-cerdas/Data/save?pakan="; 

void setup() {
  Serial.begin(115200);
  USE_SERIAL.begin(115200);
  USE_SERIAL.setDebugOutput(false);

  lcd.init();
  lcd.backlight();
  lcd.setCursor(3, 0);
  lcd.print("MONITORING");
  lcd.setCursor(1, 1);
  lcd.print("PAKAN IKAN KOKI");
  

  for(uint8_t t = 6; t > 0; t--) {
      USE_SERIAL.printf("[SETUP] Tunggu %d...\n", t);
      USE_SERIAL.flush();
      delay(1000);
  }

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("Project", "12345678");

  Serial.print("Persiapan Dimulai\n\n");

  Serial.println("Starting Telegram Bot...");
  myBot.wifiConnect(ssid, pass);
  myBot.setTelegramToken(token);

  if (myBot.testConnection()) {
    Serial.println("Koneksi Bagus");
  } else {
    Serial.println("Koneksi Jelek");
  }

  Serial.print("IP address : ");
  Serial.println(WiFi.localIP());
  
  servo.attach(pinServo);
  servo.write(0);

  pinMode(echoPin, INPUT);
  pinMode(trigPin, OUTPUT);

  pinMode(relay, OUTPUT);
  digitalWrite(relay, relay_off);

  delay(300);

  Serial.print("Persiapan Dimulai\n\n");

  
  delay(1000);
}

void loop() {
    
  if (cek_wifi == true)
  {
    for (int u = 1; u <= 3; u++)
    {
      if ((WiFiMulti.run() == WL_CONNECTED))
      {
        USE_SERIAL.println("Alhamdulillah wifi konek");
        USE_SERIAL.flush();
        delay(1000);
      }
      else
      {
        Serial.println("Hmmm wifi belum konek");
        delay(1000);
      }
    }

    lcd.clear();
  }

  int durasi, jarak, pos=0;
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  durasi = pulseIn(echoPin, HIGH);
  jarak = (durasi / 2) / 29.1;
  pakan = ((tinggi_pakan - jarak) * 7 * 7) / 11;
  
  if (pakan < 0)
  {
    pakan = 0;
  }

  Serial.print("Jarak pakan : ");
  Serial.println(jarak);
  Serial.print("Volume Pakan : ");
  Serial.print(pakan);
  Serial.print(" %\n\n");

  delay(300);

  int sensorValue = analogRead(A0);
  teg = sensorValue * (5.0 / 1024.0);
  kekeruhan = 100 - (sensorValue / 10.24);

  Serial.print("Sensor Turbidity Output (V) : ");
  Serial.println(teg);
  Serial.print("Kekeruhan Air : ");
  Serial.println(kekeruhan);
  Serial.print("Air : ");
  Serial.println(air);
  Serial.print("\n");

  if (kekeruhan <= 5.00)
  {
    air = "Jernih";
    digitalWrite(relay, relay_off);
    Serial.print("Pompa Air Tidak Berjalan\n\n");
  }
  else if (kekeruhan >= 5.01 && kekeruhan <= 15.00)
  {
    air = "Keruh";
    digitalWrite(relay, relay_on);
    Serial.print("Pompa Air Berjalan\n\n");
  }
  else
  {
    air = "Kotor";
    digitalWrite(relay, relay_on);
    Serial.print("Pompa Air Berjalan\n\n");
  }

  delay(300);

  lcd.clear();
  delay(100);
  
  lcd.setCursor(0, 0);
  lcd.print("PAKAN : ");
  lcd.setCursor(8, 0);
  lcd.print(pakan);
  lcd.setCursor(15, 0);
  lcd.print("%");
  lcd.setCursor(0, 1);
  lcd.print("AIR   : ");
  lcd.setCursor(8, 1);
  lcd.print(air);

  if ((WiFiMulti.run() == WL_CONNECTED))
  {
    USE_SERIAL.print("[HTTP] Memulai...\n");
    
    http.begin( ambil_jadwal + (String) pakan + "&kekeruhan=" + (String) kekeruhan );
    
    USE_SERIAL.print("[HTTP] Menyimpan ke database & mengambil data jadwal ...\n");
    int httpCode = http.GET();

    if(httpCode > 0)
    {
      USE_SERIAL.printf("[HTTP] kode response GET jadwal : %d\n", httpCode);

      if (httpCode == HTTP_CODE_OK)
      {
        jadwal = http.getString();
        USE_SERIAL.println("Jadwal : " + jadwal);
        pagi = jadwal.substring(0,1);
        siang = jadwal.substring(1,2);
        sore = jadwal.substring(2,3);

        USE_SERIAL.println("Pagi : " + pagi);
        delay(200);
        USE_SERIAL.println("Siang : " + siang);
        delay(200);
        USE_SERIAL.println("Sore : " + sore);
        
        delay(200);
      }
    }
    else
    {
      USE_SERIAL.printf("[HTTP] GET data gagal, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  }

  Serial.print("\n");
  
  if (pagi.toInt() == 1)
  {
    if (loop_pakan == false)
    {
      Serial.print("Sedang diberi pakan\n\n");
      servo.write(90);
      delay(500);
      servo.write(0);
  
      loop_pakan = true;
    }
    else
    {
      Serial.print("Sudah diberi pakan\n\n");
    }
  }
  else if (siang.toInt() == 1)
  {
    if (loop_pakan == false)
    {
      Serial.print("Sedang diberi pakan\n\n");
      servo.write(90);
      delay(500);
      servo.write(0);
  
      loop_pakan = true;
    }
    else
    {
      Serial.print("Sudah diberi pakan\n\n");
    }
  }
  else if (sore.toInt() == 1)
  {
    if (loop_pakan == false)
    {
      Serial.print("Sedang diberi pakan\n\n");
      servo.write(90);
      delay(500);
      servo.write(0);
  
      loop_pakan = true;
    }
    else
    {
      Serial.print("Sudah diberi pakan\n\n");
    }
  }
  else
  {
    loop_pakan = false;
  }

  if (pakan == 0)
  {
    if (send_telegram == false)
    {
      myBot.sendMessage(id, "Pakan Sudah Habis");
      Serial.print("Pesan Terkirim\n\n");

      send_telegram = true;
    }
  }
  else
  {
    send_telegram = false;
  }

  cek_wifi = false;
  delay(1500);
  
}

float round_to_dp( float in_value, int decimal_place )
{
  float multiplier = powf( 10.0f, decimal_place );
  in_value = roundf( in_value * multiplier ) / multiplier;
  return in_value;
}
