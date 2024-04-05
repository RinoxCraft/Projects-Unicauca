#include <Arduino.h>
#include "WiFi.h"
#include "SD.h"
#include "DHT.h"
#include <U8g2lib.h>
#include <ESPAsyncWebServer.h>

// Declaraciones de constantes
AsyncWebServer server(80);
const char* ssid = "Readme";
const char* password = "13052023";
const unsigned long WiFiCheckInterval = 60000;
const int PIN_VENTILADOR = 12; // Pin para controlar el ventilador
const int PIN_BOMBA_AGUA = 13; // Pin para controlar la bomba de agua
const int UMBRAL_TEMP = 30; // Umbral de temperatura en grados Celsius
const int UMBRAL_HUM = 60;  // Umbral de humedad en porcentaje

// Declaraciones de funciones
void setupOled();
void setupWiFi();
bool checkWiFiConnection();
void setupSDCard();
void updateOledWithSensorValues(float temperature, float humidity, int lightIntensity);
void controlarReles(float temperature, float humidity);

// Declaraciones de objetos
DHT dht(4, DHT22); // Pin 4 para DHT22
U8G2_SH1106_128X32_VISIONOX_F_HW_I2C u8g2(U8G2_R0, /* reset=*/ U8X8_PIN_NONE);

enum Estado {
  INICIALIZACION,
  VERIFICACION_WIFI,
  MOSTRAR_IP,
  VERIFICACION_SD,
  LECTURA_SENSORES,
  MANEJO_SOLICITUDES_WEB
};

Estado estadoActual = INICIALIZACION;
unsigned long estadoAnteriorMillis = 0;
const unsigned long duracionIPMillis = 5000; // Duración de la visualización de la IP en milisegundos

IPAddress ip;
int lightIntensity; // Declaración de la variable lightIntensity fuera del switch

void setup() {
  Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  setupSDCard();
  setupOled();
  pinMode(PIN_VENTILADOR, OUTPUT);
  pinMode(PIN_BOMBA_AGUA, OUTPUT);
}

void loop() {
  unsigned long currentMillis = millis();
  static unsigned long lastWiFiCheckTime = 0;
  
  switch (estadoActual) {
    case INICIALIZACION:
      setupWiFi();
      estadoActual = VERIFICACION_WIFI;
      break;
    
    case VERIFICACION_WIFI:
      if (currentMillis - lastWiFiCheckTime >= WiFiCheckInterval) {
        lastWiFiCheckTime = currentMillis;
        if (checkWiFiConnection()) {
          estadoActual = MOSTRAR_IP;
          estadoAnteriorMillis = currentMillis;
        }
      }
      break;

    case MOSTRAR_IP:
      if (currentMillis - estadoAnteriorMillis <= duracionIPMillis) {
        updateOledWithIP(ip);
      } else {
        estadoActual = VERIFICACION_SD;
      }
      break;

    case VERIFICACION_SD:
      if (SD.begin()) {
        estadoActual = LECTURA_SENSORES;
      } else {
        Serial.println("Error: No se pudo montar la tarjeta SD");
        delay(5000);
        estadoActual = INICIALIZACION;
      }
      break;

    case LECTURA_SENSORES:
      dht.begin();
      lightIntensity = analogRead(32); // Leer valor analógico de la fotorresistencia
      updateOledWithSensorValues(dht.readTemperature(), dht.readHumidity(), lightIntensity);
      controlarReles(dht.readTemperature(), dht.readHumidity());
      estadoActual = MANEJO_SOLICITUDES_WEB;
      break;

    case MANEJO_SOLICITUDES_WEB:
      server.on("/datos", HTTP_GET, [](AsyncWebServerRequest *request) {
        float temperature = dht.readTemperature();
        float humidity = dht.readHumidity();
        int lightIntensity = analogRead(32); // Leer valor analógico de la fotorresistencia
        String json = "{\"temperatura\": " + String(temperature) + ", \"humedad\": " + String(humidity) + ", \"intensidadLuz\": " + String(lightIntensity) + "}";
        request->send(200, "application/json", json);
      });

      server.on("/", HTTP_GET, [](AsyncWebServerRequest *request) {
        request->send(SD, "/index.html", "text/html");
      });

      server.serveStatic("/", SD, "/");
      server.begin();
      break;
  }
}

// Funciones de WiFi
void setupWiFi() {
  Serial.print("Conectando a WiFi ..");
  while (WiFi.status() != WL_CONNECTED) {
    WiFi.begin(ssid, password);
    Serial.print('.');
    delay(5000);
  }
  ip = WiFi.localIP();
  Serial.println(ip);
}

bool checkWiFiConnection() {
  return (WiFi.status() == WL_CONNECTED);
}

// Funciones de la tarjeta SD
void setupSDCard() {
  while (!SD.begin()) {
    Serial.println("Error: No se pudo montar la tarjeta SD");
    delay(5000);
  }
  uint8_t cardType = SD.cardType();

  if (cardType == CARD_NONE) {
    Serial.println("No hay tarjeta SD conectada");
    return;
  }

  Serial.print("Tipo de tarjeta SD: ");
  if (cardType == CARD_MMC) {
    Serial.println("MMC");
  } else if (cardType == CARD_SD) {
    Serial.println("SDSC");
  } else if (cardType == CARD_SDHC) {
    Serial.println("SDHC");
  } else {
    Serial.println("Desconocido");
  }

  uint64_t cardSize = SD.cardSize() / (1024 * 1024);
  Serial.printf("Tamaño de la tarjeta SD: %lluMB\n", cardSize);
}

// Funciones de la pantalla OLED
void setupOled() {
  u8g2.begin();
  u8g2.setFont(u8g2_font_ncenB08_tr); // Utilizar una fuente más pequeña
}

void updateOledWithSensorValues(float temperature, float humidity, int lightIntensity) {
  u8g2.clearBuffer();
  u8g2.setCursor(0, 10);
  u8g2.print("Temp: ");
  u8g2.print(temperature);
  u8g2.print(" C\n");

  u8g2.setCursor(0, 20);
  u8g2.print("Humedad: ");
  u8g2.print(humidity);
  u8g2.print(" %\n");

  u8g2.setCursor(0, 30);
  u8g2.print("Luz: ");
  u8g2.print(lightIntensity);
  u8g2.print(" %\n");

  u8g2.sendBuffer();
}

void updateOledWithIP(IPAddress ip) {
  u8g2.clearBuffer();
  u8g2.setCursor(0, 10);
  u8g2.print("IP: ");
  u8g2.print(ip);
  u8g2.sendBuffer();
}

void controlarReles(float temperature, float humidity) {
  // Verificar los valores de temperatura y humedad
  if (temperature >= UMBRAL_TEMP || (humidity < UMBRAL_HUM && temperature >= 32)) {
    // Encender el ventilador
    digitalWrite(PIN_VENTILADOR, HIGH);

    // Verificar si también se necesita encender la bomba de agua
    if (humidity < UMBRAL_HUM && temperature >= 32) {
      digitalWrite(PIN_BOMBA_AGUA, HIGH);
    } else {
      digitalWrite(PIN_BOMBA_AGUA, LOW);
    }
  } else {
    // Apagar ambos relés
    digitalWrite(PIN_VENTILADOR, LOW);
    digitalWrite(PIN_BOMBA_AGUA, LOW);
  }
}
