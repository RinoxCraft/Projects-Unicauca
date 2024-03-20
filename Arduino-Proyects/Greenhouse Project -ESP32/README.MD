### Greenhouse Project -ESP32
### MATERIALS
* Esp-32 (1)
* Sensors: DHT22 (1),Photoresistor (1),Led RGB (1), Humidity of floor (1)
* Protoboard (2)
* Dissipation Fans (2)
* Water Pump (1)
* Keypad 4*3
* Oled screen (1)
* Cabling (Male-Male Male-Female Female-Female)
* Potentiometer
### Programs
* Arduino IDE
* Visual Studio Code
* Web Page
### -- PROJECT START --

Creating a basic data visualization environment for ESP-32 integration
When preparing to work with the ESP-32 microcontroller and sensor data, it is essential to establish a solid data visualization platform. This platform will serve as a basis for displaying real-time data acquired from sensors. In this effort, Visual Studio Code stands out as a preferred tool for its versatility and extensive support for web development. This guide describes the process of creating a basic data visualization environment using Visual Studio Code, starting with a test implementation using simulated data. Afterwards, we will seamlessly integrate the sensor data into our website.

1. Set up Visual Studio code:
     - Install Visual Studio Code from the official website (https://code.visualstudio.com/).
     - Familiarize yourself with the interface and basic functionalities to speed up development.

2. Creating the website structure:
     - Initialize a new project folder for the website.
## Code 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualización de datos ESP32</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
        }
        .sensor-data {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .sensor-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Datos del ESP32</h1>
        <div class="sensor-data">
            <span class="sensor-label">Temperatura:</span>
            <span id="temperature">--</span>
        </div>
        <div class="sensor-data">
            <span class="sensor-label">Humedad:</span>
            <span id="humidity">--</span>
        </div>
        <!-- Puedes agregar más datos del ESP32 aquí -->
    </div>
</body>
</html>

4. Website Test:
     - Start a local development server to preview the website.
     - Verify that data visualization elements render correctly and respond to changes in the simulated data set.
     - Debug any issues or inconsistencies in the viewing process.



5. Sensor data integration:
     - Establish communication between the ESP-32 microcontroller and the website using appropriate protocols (e.g. MQTT, WebSocket).
     - Develop a mechanism in the ESP-32 to transmit sensor data to the website at regular intervals.
     - Modify the website's JavaScript code to receive and process sensor data in real time.
     - Update data display elements to dynamically reflect incoming sensor readings.
## Code 
#include <WiFi.h>
#include <WebServer.h>
// Definición de las credenciales de WiFi
const char* ssid = "TP-LINK_DE16";
const char* password = "67743667";

// Definición del objeto WebServer
WebServer server(80);

void setup() {
  Serial.begin(115200);

  // Conexión a la red WiFi
  WiFi.begin(ssid, password);
  Serial.println("Conectando al WiFi...");

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Conectando al WiFi...");
  }

  Serial.println("Conectado al WiFi");
  Serial.print("Dirección IP: ");
  Serial.println(WiFi.localIP());

  // Definición de las rutas para el servidor web
  server.on("/", HTTP_GET, []() {
    server.send(200, "text/html", "<h1>Hola desde ESP32</h1>");
  });

  server.on("/datos", HTTP_GET, []() {
    // Aquí se enviarán los datos de los sensores en formato JSON
    // Por ahora, enviaremos valores de ejemplo
    String datos = "{\"temperatura\": 25.5, \"humedad\": 60, \"luz\": 500}";
    server.send(200, "application/json", datos);
  });

  // Iniciar el servidor web
  server.begin();
  Serial.println("Servidor web iniciado");
}

void loop() {
  // Manejar las solicitudes del cliente
  server.handleClient();
}
6. Tests with real sensor data:
     - Connect the sensors to the ESP-32 and ensure its correct operation.
     - Monitor the website to confirm it accurately reflects real-time sensor data.
     - Adjust display parameters and layout as necessary for optimal data representation.

  7. Data Visualization
