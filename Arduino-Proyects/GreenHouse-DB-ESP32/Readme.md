# ***GreenHouse whit ESP32 and Data Base*** :monocle_face:

## Tasks to be done :robot:
- [x] Download Arduino Environment
- [x] Environment Configuration for ESP32
- [ ] Implementation of WiFi Service with ESP32
- [ ] Reading DHT22 and Photocell Sensors
- [ ] Database Creation and Configuration
- [ ] HTML modification for sensor reading
- [ ] HTML Modification for CRUD with Database
- [ ] Testing

# ***PROJECT START*** :space_invader:
1. Arduino IDE Installer: [Arduino IDE](https://www.arduino.cc/en/software)
2. Arduino setup for ESP32:
   - To import ESP32 to our Arduino environment we must add preferences to download it, to do this we will go to the following path Files>Preferences>Additional Boards Manager URLs
     we add the following: `http://arduino.esp8266.com/stable/package_esp8266com_index.json,https://dl.espressif.com/dl/package_esp32_index.json`
   - Once downloaded we can go to select our board, the board we are going to use is `DOIT ESP32 DEVKIT V1`
> [!NOTE] 
> We use this type of board since it is the most common one that can be worked on, but it can be managed with another type of board. The important thing is that it can compile to ESP code.
3. Implementation WiFi Service
