#include <WiFi.h>
#include "sensores.h"
#include "wifi_config.h"
#include "oled_display.h"

void setup() {
  Serial.begin(115200);
  
  inicializarDisplay(); // Inicializar la pantalla OLED
  
  conectarWiFi(); // Conectar a WiFi
  
  iniciarSensores(); // Inicializar los sensores
}

void loop() {
  float temperatura = leerTemperatura(); // Leer temperatura
  float humedad = leerHumedad(); // Leer humedad
  int luz = leerLuz(); // Leer luz
  
  // Mostrar datos de los sensores
  mostrarDatosSensores(temperatura, humedad, luz);
  
  delay(2000); // Esperar 2 segundos antes de la siguiente lectura
}
