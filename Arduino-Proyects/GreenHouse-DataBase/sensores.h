#ifndef SENSORES_H
#define SENSORES_H

#include <DHT.h>

// Configuración del sensor DHT22
#define DHTPIN 4 // Pin definido
#define DHTTYPE DHT22
extern DHT dht;

// Pin del fotoresistor
#define FOTOR_PIN 34 
// Definir los rangos de lectura del sensor de luz
#define LUX_MIN 0    // Valor mínimo de lectura del sensor (oscuridad)
#define LUX_MAX 4095 // Valor máximo de lectura del sensor (máxima luz)

// Inicialización de los sensores
void iniciarSensores();

// Lectura de temperatura desde el sensor DHT22
float leerTemperatura();

// Lectura de humedad desde el sensor DHT22
float leerHumedad();

// Lectura de luz desde el fotoresistor
int leerLuz();

#endif
