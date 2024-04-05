### Greenhouse Project -ESP32
## MATERIALS
* Esp-32 (1)
* Sensors: DHT22 (1),Photoresistor (1),Led RGB (1), Humidity of floor (1)
* Protoboard (2)
* Dissipation Fans (2)
* Water Pump (1)
* Oled screen (1)
* Cabling (Male-Male Male-Female Female-Female)
## Programs
* Arduino IDE
* Visual Studio Code
* Web Page
### Codes
## Code Web Pages
# >> <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control del Sistema</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.time.min.js"></script>
    <style>
        /* Estilos CSS aquí */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(239, 239, 239);
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgb(111, 204, 95);
            border: 1px solid #000000;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #000000;
        }

        .sensor-data {
            margin-bottom: 20px;
        }

        .sensor-data p {
            margin: 10px 0;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sensor-name {
            flex: 1;
            text-align: left;
            color: #000000;
        }

        .value {
            text-align: center;
            flex: 1;
            color: #000000;
            font-weight: bold;
        }

        .graph-container {
            margin-top: 20px;
            max-width: 800px;
            margin: auto;
            display: flex;
            justify-content: space-between;
        }

        .graph {
            width: calc(50% - 10px);
            height: 300px;
            border: 1px solid #000000;
            border-radius: 10px;
            overflow: hidden;
        }

        #error-message {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }

        #connection-status {
            color: green;
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }

        .tooltip {
            position: absolute;
            display: none;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Control del Sistema</h1>
        <div class="sensor-data">
            <p><span class="sensor-name">Temperatura:</span><span class="value" id="temp">-- °C</span></p>
            <p><span class="sensor-name">Humedad:</span><span class="value" id="hum">-- %</span></p>
            <p><span class="sensor-name">Luz:</span><span class="value" id="light">-- %</span></p>
        </div>
    </div>

    <div class="graph-container">
        <div id="tempChart" class="graph"></div>
        <div id="humChart" class="graph"></div>
        <div id="lightChart" class="graph"></div>
    </div>

    <div id="error-message"></div>
    <div id="connection-status"></div>
    <div class="tooltip"></div>

    <script>
        var temperatureData = [];
        var humidityData = [];
        var lightData = [];
        var plotOptions = {
            series: {
                lines: {
                    show: true,
                    lineWidth: 2,
                    shadowSize: 0
                },
                points: {
                    show: true
                }
            },
            grid: {
                borderWidth: 0,
                hoverable: true,
                backgroundColor: null,
                color: "#000000"
            },
            xaxis: {
                show: false,
                mode: 'time'
            },
            yaxis: {
                color: "#000000"
            }
        };

        function trimData(dataArray, maxLength) {
            if (dataArray.length > maxLength) {
                dataArray.splice(0, dataArray.length - maxLength);
            }
        }

        function updateCharts() {
            trimData(temperatureData, 10);
            trimData(humidityData, 10);
            trimData(lightData, 10);

            $.plot("#tempChart", [{
                data: temperatureData,
                label: "Temperatura (°C)",
                color: "#FF0000"
            }], plotOptions);

            $.plot("#humChart", [{
                data: humidityData,
                label: "Humedad (%)",
                color: "#0000FF"
            }], plotOptions);

            $.plot("#lightChart", [{
                data: lightData,
                label: "Luz (%)",
                color: "#FFFF00"
            }], plotOptions);
        }

        function showTooltip(x, y, contents) {
            $('.tooltip').html(contents)
                .css({
                    top: y + 5,
                    left: x + 5
                })
                .fadeIn();
        }

        updateCharts();
        fetchData();
        setInterval(fetchData, 5000);

        function fetchData() {
            fetch('http://192.168.0.103/datos') // Reemplaza '192.168.1.2' con la dirección IP de tu ESP32
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la Lectura de Datos');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    document.getElementById('error-message').textContent = '';
                    document.getElementById('connection-status').textContent = 'Conectado';
                    document.getElementById('connection-status').style.color = 'green';
                    updateValues(data.temperatura, data.humedad, data.intensidadLuz);
                    temperatureData.push([new Date().getTime(), data.temperatura]);
                    humidityData.push([new Date().getTime(), data.humedad]);
                    lightData.push([new Date().getTime(), data.intensidadLuz]);
                    updateCharts();
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                    document.getElementById('error-message').textContent = 'Error al cargar datos';
                    document.getElementById('connection-status').textContent = 'Red no disponible';
                    document.getElementById('connection-status').style.color = 'red';
                    updateValues(null, null, null);
                });
        }

        function updateValues(temperature, humidity, light) {
            if (temperature !== undefined && humidity !== undefined && light !== undefined) {
                document.getElementById('temp').textContent = temperature.toFixed(2) + ' °C';
                document.getElementById('hum').textContent = humidity.toFixed(2) + ' %';
                document.getElementById('light').textContent = light.toFixed(2) + ' %';
                document.getElementById('error-message').textContent = '';
            } else {
                document.getElementById('temp').textContent = '-- °C';
                document.getElementById('hum').textContent = '-- %';
                document.getElementById('light').textContent = '-- %';
                document.getElementById('error-message').textContent = 'Error al recibir datos';
            }
        }

        $('#tempChart, #humChart, #lightChart').on('plothover', function (event, pos, item) {
            if (item) {
                var x = item.datapoint[0],
                    y = item.datapoint[1];

                showTooltip(item.pageX, item.pageY, item.series.label + ": " + y.toFixed(2));
            } else {
                $('.tooltip').fadeOut();
            }
        });

    </script>
</body>

</html> <<
## Code Arduino
# Greenhouse code with state machines:
>> #include <Arduino.h>
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
} <<

# Greenhouse code without state machines:
>> #include <Arduino.h>
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
} <<
