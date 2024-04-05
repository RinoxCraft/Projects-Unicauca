#include <Arduino.h>
#include "WiFi.h"
// #include "SD.h"  // Comentado: Librería para la tarjeta SD
#include "DHT.h"
#include <U8g2lib.h>
#include <ESPAsyncWebServer.h>

// Declaraciones de constantes
const char* ssid = "Readme";
const char* password = "13052023";
const unsigned long WiFiCheckInterval = 60000;
const int UMBRAL_TEMP = 30; // Umbral de temperatura en grados Celsius
const int UMBRAL_HUM = 70;  // Umbral de humedad en porcentaje

// Declaraciones de objetos
DHT dht(4, DHT22); // Pin 4 para DHT22
U8G2_SH1106_128X32_VISIONOX_F_HW_I2C u8g2(U8G2_R0, /* reset=*/ U8X8_PIN_NONE);
AsyncWebServer server(80);

void setup() {
  Serial.begin(115200);
  WiFi.mode(WIFI_STA);
  setupWiFi();
  // setupSDCard();  // Comentado: Configuración de la tarjeta SD
  setupOled();
  setupWebServer();
}

void loop() {
  unsigned long currentMillis = millis();
  static unsigned long lastWiFiCheckTime = 0;

  // Verificar la conexión WiFi cada cierto intervalo de tiempo
  if (currentMillis - lastWiFiCheckTime >= WiFiCheckInterval) {
    lastWiFiCheckTime = currentMillis;
    setupWiFi();
  }
  
  if (!checkWiFiConnection()) {
    Serial.println("Error: En parametros de WiFi");
    updateOled("Error:WiFi");
    delay(5000); 
    lastWiFiCheckTime = currentMillis; 
  }

  // Manejar la solicitud para los datos del sensor
  float temperature = dht.readTemperature();
  float humidity = dht.readHumidity();
  int lightIntensity = analogRead(32); 

  // Verificar los valores de temperatura y humedad
  if (temperature > UMBRAL_TEMP || humidity > UMBRAL_HUM) {
    // Si los valores están fuera de los umbrales, encender el relé correspondiente
    if (temperature > UMBRAL_TEMP) {
      // Encender la bomba de agua
      // Código para activar el relé de la bomba de agua
      Serial.println("Activando bomba de agua");
    }
    if (humidity > UMBRAL_HUM) {
      // Encender el ventilador
      // Código para activar el relé del ventilador
      Serial.println("Activando ventilador");
    }
  } else {
    // Si los valores están dentro de los umbrales, apagar ambos relés
    // Código para apagar los relés de la bomba de agua y el ventilador
    Serial.println("Desactivando bomba de agua y ventilador");
  }

  // Actualizar la pantalla OLED con los valores de los sensores
  String temperatureString = String(temperature);
  String humidityString = String(humidity);
  String lightIntensityString = String(lightIntensity);
  updateOled("Humedad: " + humidityString + " %\nTemperatura: " + temperatureString + " °C\nLuz: " + lightIntensityString + " %");

  delay(2000); // Retraso antes de realizar la próxima lectura de los sensores
}

// Funciones de WiFi
void setupWiFi() {
  Serial.print("Conectando a WiFi ..");
  while (WiFi.status() != WL_CONNECTED) {
    WiFi.begin(ssid, password);
    Serial.print('.');
    delay(5000); 
  }
  Serial.println(WiFi.localIP());
}

bool checkWiFiConnection() {
  return (WiFi.status() == WL_CONNECTED);
}

// Funciones de la tarjeta SD
// void setupSDCard() {
//     while (!SD.begin()) {
//         Serial.println("Card Mount Failed");
//         delay(5000); 
//     }
//     uint8_t cardType = SD.cardType();

//     if (cardType == CARD_NONE) {
//         Serial.println("No SD card attached");
//         return;
//     }

//     Serial.print("SD Card Type: ");
//     if (cardType == CARD_MMC) {
//         Serial.println("MMC");
//     } else if (cardType == CARD_SD) {
//         Serial.println("SDSC");
//     } else if (cardType == CARD_SDHC) {
//         Serial.println("SDHC");
//     } else {
//         Serial.println("UNKNOWN");
//     }
//     uint64_t cardSize = SD.cardSize() / (1024 * 1024);
//     Serial.printf("SD Card Size: %lluMB\n", cardSize);
// }

// Funciones de la pantalla OLED
void setupOled() {
    u8g2.begin();
}

void updateOled(String message) {
    u8g2.clearBuffer();
    u8g2.setFont(u8g2_font_ncenB08_tr);
    u8g2.setCursor(0, 10);
    u8g2.print(message);
    u8g2.sendBuffer();
}

// Funciones del servidor web
void setupWebServer() {
  // Manejar la solicitud para los datos del sensor
  server.on("/datos", HTTP_GET, [](AsyncWebServerRequest *request) {
    float temperature = dht.readTemperature();
    float humidity = dht.readHumidity();
    int lightIntensity = analogRead(32); 

    String temperatureString = String(temperature);
    String humidityString = String(humidity);
    String lightIntensityString = String(lightIntensity);
    String data = "{\"temperatura\": " + temperatureString + ", \"humedad\": " + humidityString + ", \"intensidadLuz\": " + lightIntensityString + "}";
    request->send(200, "application/json", data);
  });

  // Manejar la solicitud para el archivo index.html
  server.on("/", HTTP_GET, [](AsyncWebServerRequest *request) {
    request->send(SD, "/index.html", "text/html");
  });

  // Iniciar el servidor
  server.begin();
}
