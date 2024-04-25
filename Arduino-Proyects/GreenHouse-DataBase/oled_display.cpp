#include "oled_display.h"

U8G2_SH1106_128X32_VISIONOX_F_HW_I2C u8g2(U8G2_R0, /* reset=*/ U8X8_PIN_NONE);

void inicializarDisplay() {
  u8g2.begin();
}

void mostrarMensajeConexion(const char* ip, const char* ssid) {
  u8g2.clearBuffer();
  u8g2.setFont(u8g2_font_profont10_mr);
  u8g2.drawStr(0, 12, "Conectado: ");
  u8g2.setCursor(55, 12);
  u8g2.print(ssid);
  u8g2.drawStr(21, 24, "IP: ");
  u8g2.setCursor(49, 24);
  u8g2.print(ip);
  u8g2.sendBuffer();
  delay(5000);
}

void mostrarMensajeconnect(const char* ssid) {
  u8g2.clearBuffer();
  u8g2.setFont(u8g2_font_profont10_mr);
  u8g2.drawStr(0, 9, "Conectando a WiFi..."); // Dibuja en la primera fila
  u8g2.drawStr(0, 18, ssid); // Dibuja en la segunda fila
  u8g2.sendBuffer();
  delay(5000);
  
  // Dibuja "Reintentando..." en la misma pantalla sin borrar el contenido previo
  u8g2.drawStr(0, 25, "Reintentando...");
  u8g2.sendBuffer();
}

void mostrarMensajeErrorConexion(const char* network) {
  u8g2.clearBuffer();
  u8g2.setFont(u8g2_font_profont10_mr);
  u8g2.drawStr(0, 12, "Error:Conexión WiFi");
  u8g2.drawStr(0, 24, "Sin Conexión:");
  u8g2.setCursor(60, 24);
  u8g2.print(network);
  u8g2.sendBuffer();
  delay(5000);
}
