#include "sensores.h"
#include "oled_display.h"

DHT dht(DHTPIN, DHTTYPE);

void iniciarSensores() {
  dht.begin();
}

float leerTemperatura() {
  return dht.readTemperature();
}

float leerHumedad() {
  return dht.readHumidity();
}

int leerLuz() {
  int valorLuz = analogRead(FOTOR_PIN);
  int luzPorcentaje = map(valorLuz, LUX_MIN, LUX_MAX, 0, 100);
  luzPorcentaje = constrain(luzPorcentaje, 0, 100);
  return luzPorcentaje;
}
void mostrarDatosSensores(float temperatura, float humedad, int luz) {
  u8g2.clearBuffer();
  u8g2.setFont(u8g2_font_profont12_mr);
  
  // Mostrar temperatura en la primera fila
  u8g2.drawStr(0, 12, "Temperatura:");
  u8g2.setCursor(90, 12);
  u8g2.print(temperatura);
  
  // Mostrar humedad en la segunda fila
  u8g2.drawStr(0, 24, "Humedad:");
  u8g2.setCursor(90, 24);
  u8g2.print(humedad);
  
  // Mostrar luz en la tercera fila
  u8g2.drawStr(0, 36, "Luz:");
  u8g2.setCursor(90, 36);
  u8g2.print(luz);
  
  u8g2.sendBuffer(); // Enviar el contenido del buffer a la pantalla
}
