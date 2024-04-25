#include "sensores.h"

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
