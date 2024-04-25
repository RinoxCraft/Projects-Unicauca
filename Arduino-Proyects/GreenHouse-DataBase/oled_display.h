#ifndef OLED_DISPLAY_H
#define OLED_DISPLAY_H

#include <U8g2lib.h>

extern U8G2_SH1106_128X32_VISIONOX_F_HW_I2C u8g2;

void inicializarDisplay();
void mostrarMensajeconnect(const char* ssid);
void mostrarMensajeConexion(const char* ip, const char* ssid);
void mostrarMensajeErrorConexion(const char* ssid);
void mostrarDatosSensores(float temperatura, float humedad, int luz);

#endif
