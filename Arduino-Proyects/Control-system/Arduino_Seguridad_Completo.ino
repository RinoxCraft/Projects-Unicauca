#include <LiquidCrystal.h>
#include <Keypad.h>
#include <DHT.h>
#include <AsyncTaskLib.h>

/* Display */
LiquidCrystal lcd(12, 11, 10, 9, 8, 7);

/* Keypad setup */
const byte KEYPAD_ROWS = 4;
const byte KEYPAD_COLS = 3;
byte rowPins[KEYPAD_ROWS] = { 5, 4, 3, 2 };  // R1 = 5, R2 = 4, R3 = 3. R4 = 2
byte colPins[KEYPAD_COLS] = { A3, A2, A1 };
char keys[KEYPAD_ROWS][KEYPAD_COLS] = {
  { '1', '2', '3' },
  { '4', '5', '6' },
  { '7', '8', '9' },
  { '*', '0', '#' }
};

Keypad keypad = Keypad(makeKeymap(keys), rowPins, colPins, KEYPAD_ROWS, KEYPAD_COLS);

char password[5] = "1234";  // Nueva contraseña: 1234
char inputPassword[5];      // Almacena la clave ingresada
unsigned char idxPassword = 0;
unsigned char idxAsterisks = 0;
int failedAttempts = 0;  // Contador de intentos fallidos

// Pins del LED RGB
const int redPin = 14;
const int greenPin = 15;
const int bluePin = 16;

// Pin del sensor de luz (fotoresistor)
const int lightSensorPin = A8;

// Pin del sensor DHT22
const int dhtPin = 28;

// Crear un objeto DHT para el sensor DHT22
DHT dht(dhtPin, DHT22);



// Estado del sistema
enum Estado {
  INICIO,
  VALIDACION_CONTRASENA,
  BLOQUEADO,
  ALARMATEMPERATURA,
  MOSTRAR_VALORES  // Agregado el estado para mostrar los valores
};

Estado estadoActual = INICIO;

// Variable para almacenar el estado anterior
Estado estadoAnterior = MOSTRAR_VALORES;

// Definición de las tareas asíncronas
void showTemperatureValue(void);
AsyncTask TemperatureTask(2500, true, showTemperatureValue);

void showHumidityValue(void);
AsyncTask HumidityTask(2000, true, showHumidityValue);

void showLightValue(void);
AsyncTask LightTask(1500, true, showLightValue);

// Definir una tarea asíncrona para el bloqueo
void funct_led(void);
AsyncTask LedTask(650, true, funct_led);

void funct_ledAlarm(void);
AsyncTask LedTaskAlarm(650, true, funct_ledAlarm);

void funct_time(void);
AsyncTask TimeTask(10000, false, funct_time);

void funct_timeAlarm(void);
AsyncTask TimeTaskAlarm(3000, false, funct_timeAlarm);

void funt_ledAlarmBloq(void);
AsyncTask LedAlarmBloq(800, true, funt_ledAlarmBloq);

void funt_ledAlarmTemp(void);
AsyncTask LedAlarmTemp(500, true, funt_ledAlarmTemp);

int ledState = LOW;

void funct_led(void) {
  ledState = !ledState;
  digitalWrite(redPin, ledState);
}

void funct_ledAlarm(void) {
  ledState = !ledState;
  digitalWrite(bluePin, ledState);
}

void funt_ledAlarmBloq(void) {
  unsigned long startTime = millis();
  while (millis() - startTime < 300) {
    // Azul
    analogWrite(redPin, 255);
  }
  // Apagar el LED RGB
  analogWrite(redPin, 0);
}

void funt_ledAlarmTemp(void) {
  unsigned long startTime = millis();
  while (millis() - startTime < 3000) {
    // Azul
    analogWrite(bluePin, 255);
  }

  // Apagar el LED RGB
  analogWrite(bluePin, 0);
}

void funct_time(void) {
  LedTask.Stop();
  analogWrite(redPin, ledState);
  analogWrite(greenPin, 0);
  analogWrite(bluePin, 0);
  lcd.clear();
  failedAttempts = 0;
  // Verificar el estado anterior al entrar en el estado bloqueado
  if (estadoAnterior == MOSTRAR_VALORES) {
    LedAlarmBloq.Start();
    estadoActual = MOSTRAR_VALORES;  // Restablecer el estado anterior

  } else {
    // Si venimos de otro estado, mantenemos el bloqueo indefinidamente
    estadoActual = INICIO;  // Restablecer el estado anterior
  }
}

void funct_timeAlarm(void) {
  LedTaskAlarm.Stop();
  analogWrite(bluePin, ledState);
  analogWrite(greenPin, 0);
  analogWrite(bluePin, 0);
  lcd.clear();
  // Verificar el estado anterior al entrar en el estado bloqueado
  if (estadoAnterior == MOSTRAR_VALORES) {
    LedAlarmTemp.Start();
    estadoActual = MOSTRAR_VALORES;  // Restablecer el estado anterior
  }
}

unsigned long lastKeyPressTime = 0;  // Variable para almacenar el tiempo del último ingreso del teclado
unsigned long startTime = 0;         // Variable para almacenar el tiempo de inicio de la visualización

unsigned char flagInicio = 0;

void setup() {
  pinMode(redPin, OUTPUT);
  pinMode(greenPin, OUTPUT);
  pinMode(bluePin, OUTPUT);

  // Encender solo el color azul al inicio
  analogWrite(redPin, 255);
  analogWrite(greenPin, 255);
  analogWrite(bluePin, 255);
  startTime = millis();  // Inicializa el tiempo de inicio
  delay(2000);           // Mantener encendido durante 3 segundos

  // Apagar todos los LED RGB
  analogWrite(redPin, 0);
  analogWrite(greenPin, 0);
  analogWrite(bluePin, 0);

  lcd.begin(16, 2);
  dht.begin();
  estadoActual = INICIO;
}

void loop() {
  LedTask.Update();
  LedAlarmBloq.Update();
  LedAlarmTemp.Update();
  TimeTask.Update();
  TimeTaskAlarm.Update();
  TemperatureTask.Update();
  HumidityTask.Update();
  LightTask.Update();


  char key = keypad.getKey();

  switch (estadoActual) {
    case INICIO:
      analogWrite(redPin, 0);
      if (idxPassword == 0 && flagInicio == 0) {
        lcd.clear();
        lcd.setCursor(1, 0);
        lcd.print("Enter Password:");
        lcd.setCursor(6, 1);  // ***
        flagInicio = 1;
      }  //end if
      if (key) {
        if (idxPassword < 4) {
          inputPassword[idxPassword++] = key;
          lcd.print("*");
          idxAsterisks++;
        }
        if (idxPassword == 4) {
          inputPassword[idxPassword] = '\0';
          estadoActual = VALIDACION_CONTRASENA;
          estadoAnterior = INICIO;
        }
      }  //fin if
      break;

    case VALIDACION_CONTRASENA:
      if (strcmp(inputPassword, password) == 0) {
        analogWrite(greenPin, 255);
        lcd.clear();
        lcd.setCursor(4, 0);
        lcd.print("Correct");
        lcd.setCursor(4, 1);
        lcd.print("Password");
        estadoActual = MOSTRAR_VALORES;  // Cambiado a MOSTRAR_VALORES
        estadoAnterior = VALIDACION_CONTRASENA;
      } else {
        analogWrite(redPin, 255);
        lcd.clear();
        lcd.setCursor(4, 0);
        lcd.print("Incorrect");
        lcd.setCursor(4, 1);
        lcd.print("Password");
        failedAttempts++;
        flagInicio = 0;
        if (failedAttempts >= 3) {
          estadoActual = BLOQUEADO;
          estadoAnterior = VALIDACION_CONTRASENA;
        } else {
          estadoActual = INICIO;
          estadoAnterior = VALIDACION_CONTRASENA;
        }
      }
      delay(1000);
      idxPassword = 0;
      idxAsterisks = 0;  // Reiniciar el contador de asteriscos
      break;

    case BLOQUEADO:
      if (!TimeTask.IsActive()) {
        // Verificar el estado anterior al entrar en el estado bloqueado
        if (estadoAnterior == MOSTRAR_VALORES) {
          TimeTask.Start();
          LedAlarmBloq.Start();
          TemperatureTask.Stop();
          HumidityTask.Stop();
          LightTask.Stop();
          lcd.clear();
          lcd.setCursor(5, 0);
          lcd.print("Bloqueado");
          lcd.setCursor(3, 2);
          lcd.print("L <40 T >30 ");
        } else {
          // Si venimos de otro estado, mantenemos el bloqueo indefinidamente
          LedTask.Start();
          TimeTask.Start();
          TemperatureTask.Stop();
          HumidityTask.Stop();
          LightTask.Stop();
          lcd.clear();
          lcd.setCursor(4, 0);
          lcd.print("Blocked");
          lcd.setCursor(4, 2);
          lcd.print("System");
        }
      }
      break;

    case ALARMATEMPERATURA:
      if (!TimeTaskAlarm.IsActive()) {
        if (estadoAnterior == MOSTRAR_VALORES) {
          TimeTaskAlarm.Start();
          LedAlarmTemp.Start();
          TemperatureTask.Stop();
          HumidityTask.Stop();
          LightTask.Stop();
          lcd.clear();
          lcd.setCursor(5, 0);
          lcd.print("ALARM");
          lcd.setCursor(3, 2);
          lcd.print(" Temp >32 ");
        }

        break;

        case MOSTRAR_VALORES:
          LedAlarmBloq.Stop();
          LedAlarmTemp.Stop();
          analogWrite(greenPin, 0);
          // Lógica para mostrar valores
          if (!TemperatureTask.IsActive()) {
            lcd.clear();
            TemperatureTask.Start();
            HumidityTask.Start();
            LightTask.Start();
          }
          if (analogRead(lightSensorPin) <= 40 && dht.readTemperature() >= 27) {  // Si los valores de luz y temperatura cumplen con las condiciones
            lcd.clear();
            estadoActual = BLOQUEADO;
            estadoAnterior = MOSTRAR_VALORES;
          }
          if (dht.readTemperature() > 28) {  // si los valores de temperatura cuymplen las condiciones
            lcd.clear();
            estadoActual = ALARMATEMPERATURA;
            estadoAnterior = MOSTRAR_VALORES;
          }
          break;
      }
  }
}

  // Definición de las funciones para mostrar los valores
  void showTemperatureValue(void) {
    float temperature = dht.readTemperature();
    lcd.setCursor(8, 0);
    lcd.print("T: ");
    lcd.print(temperature);
    lcd.print("C");
  }

  void showHumidityValue(void) {
    float humidity = dht.readHumidity();
    lcd.setCursor(3, 1);
    lcd.print("H: ");
    lcd.print(humidity);
    lcd.print("%");
  }

  void showLightValue(void) {
    int lightValue = analogRead(lightSensorPin);
    lcd.setCursor(0, 0);
    lcd.print("L: ");
    lcd.print(lightValue);
  }
