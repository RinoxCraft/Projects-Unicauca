#include "wifi_config.h"
#include "oled_display.h"

const char* ssid = "TuSSID";
const char* password = "TuContraseña";

void conectarWiFi() {
  Serial.println("Conectando a WiFi...");
  mostrarMensajeconnect(ssid); // Mostrar mensaje de conexión en la pantalla OLED
  delay(5000); // Esperar 5 segundos
  
  int intentos = 0;
  while (intentos < 5) { // Intentar conectar un máximo de 5 veces
    WiFi.begin(ssid, password);
    int tiempoEspera = 0;
    while (WiFi.status() != WL_CONNECTED && tiempoEspera < 10) { // Esperar hasta 10 segundos para la conexión
      delay(1000);
      tiempoEspera++;
    }
    if (WiFi.status() == WL_CONNECTED) { // Si se conecta exitosamente, salir del bucle
      Serial.print("Conectado al WiFi. Dirección IP: ");
      Serial.println(WiFi.localIP());
      mostrarMensajeConexion(WiFi.localIP().toString().c_str(), ssid); // Mostrar mensaje de conexión en la pantalla OLED
      delay(5000); // Esperar 5 segundos
      break;
    } else { // Si no se conecta, incrementar el número de intentos
      Serial.println("Error al conectar al WiFi. Reintentando...");
      mostrarMensajeErrorConexion(ssid); // Mostrar mensaje de error de conexión en la pantalla OLED
      delay(1000); // Esperar 1 segundo
      intentos++;
    }
  }
  if (intentos >= 3) { // Si se excede el número de intentos, mostrar un mensaje de error
    Serial.println("Error: No se pudo conectar al WiFi después de varios intentos.");
    mostrarMensajeErrorConexion(ssid); // Mostrar mensaje de error de conexión en la pantalla OLED
    delay(5000); // Esperar 5 segundos
  }
}
