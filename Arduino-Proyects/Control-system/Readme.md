# --------> ARDUINO CON MAQUINA DE ESTADOS <--------

This project is developed in the area of ​​Telematics Technology of the subject Digital Systems Laboratory-TTM-I, where it is based on the implementation of Arduino Mega 
as a basic prototype of a greenhouse.
##Where software such as Arduino is used and its implementation in code with a State Machine, giving the following states as a path:
- START
- PASSWORD_VALIDATION
- BLOCKING
- SHOW_VALUES.

## >> The usage elements are based on:
- Arduino Mega
- DHT22
- PhotoResistor
- RGB LEDs
- Potentiometer
- LCD screen (16*2)
- Keypad (4*3)
- Male-Male and Male-Female Wiring.

### >> The usage code is generalized in the following image
## ![imagen](https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/6063dce1-84f2-4f17-b6fd-d7e57caf8296)
# Code explanation
When starting the code, all variables and tasks are initialized, of which their states are:
START
MONITORING
BLOCKING
ALARM

When starting the machine, the purple LED turns on for 2 seconds, therefore it asks us for a password that defaults to "1234" having two variables. If the password entered is incorrect, a message will appear that says "INCORRECT PASSWORD" illuminating the red LED, when If the incorrect password is entered three times, it goes to a LOCKED state where a "BLOCKED SYSTEM" message appears with a red LED for 6 seconds. Once those seconds have passed, it will return us to the START where it will ask us for the password. Now, if the password is correct, we will sends to a MONITORING state, where it will show us Light, Temperature and Humidity data, when we are in the monitoring system there will be two variables, when the temperature is greater than 32 degrees, it will send us to an ALARM state where a message "ALARM >32" is projected. for 3 seconds, but if the system continues to detect that the temperature is still higher than 32 degrees, the system will not go back to the monitoring state until the temperature stabilizes. Once stabilized, we will go back to the monitoring state with the aforementioned values. Now if in another variable the Temperature is greater than 30 degrees and the light is also less than 40, it will go to a blocking state with a message "Warning T > 30 L < 40" as well as the previous method if the values ​​remain like this of highs the system will not pass the monitoring until the values ​​stabilize, if they stabilize it will send us to the monitoring state again.

### >> The physical implementation is as follows:
The program used for the simulation is:
https://wokwi.com/ 
## ![imagen](https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/7c3cd0e0-5b0b-447f-a29b-03bce1752739)
### >> Code: 
The code can be obtained by downloading the "Arduino Security Complete" file:
https://github.com/RinoxCraft/Projects-Unicauca/blob/b082608f5e1afec260a8bd3fb163cdd101bd5957/Arduino-Proyects/Control-system/Arduino_Seguridad_Completo.ino 






