# ***GreenHouse whit ESP32 and Data Base*** :monocle_face:

## Tasks to be done :robot:
- [x] Download Arduino Environment
- [x] Environment Configuration for ESP32
- [x] Implementation of WiFi Service with ESP32
- [x] Reading DHT22 and Photocell Sensors
- [x] Database Creation
- [ ] Database Configuration in ESP-32
- [ ] Extras added
- [ ] PHP modification for sensor reading
- [ ] PHP Modification for CRUD with Database
- [ ] Testing

# ***PROJECT START*** :space_invader:
## 1. Arduino IDE Installer: [Arduino IDE](https://www.arduino.cc/en/software)
## 2. Arduino setup for ESP32:
   - To import ESP32 to our Arduino environment we must add preferences to download it, to do this we will go to the following path Files>Preferences>Additional Boards Manager URLs
     we add the following: `http://arduino.esp8266.com/stable/package_esp8266com_index.json,https://dl.espressif.com/dl/package_esp32_index.json`
   - Once downloaded we can go to select our board, the board we are going to use is `DOIT ESP32 DEVKIT V1`
> [!NOTE] 
> We use this type of board since it is the most common one that can be worked on, but it can be managed with another type of board. The important thing is that it can compile to ESP code.

> [!WARNING]
> We are going to make our code in layers, in other words the .ino (main) file will be as clean as possible, so we will implement the .h and .cpp sections if necessary

## 3. Implementation WiFi Service
* We start with the creation of a .h file from which it will take the name `WiFi_config.h`.
  
                                            + `WiFi_config.h file`:
![image](https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/aab5f199-bdef-4f7c-84ed-e14be636e934).

                                             + `InvernaderoDB.ino`:
![image](https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/33e6a9f6-03a3-46f6-85f4-6f8d9c2090c3).

                                                   + `Testing`:
![image](https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/a3353319-07e5-4e5c-8b03-f037bc2bc48f).

> [!NOTE]
> The parameters in 'Your WiFi Network' and 'Your WiFi Password' are replaced with the parameters of your personal or business network.

> [!TIP]
> If you need to put error messages or connection messages, it can be implemented

## 4. Implementation and Reading of DHT22 and Photocell Data
* We start with the creation of a file called `Sensores.h`, where we are going to implement the reading of DHT22 and Photocell sensors

                                                   + `Sensores.h`:
  ![image](https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/91731889-b025-4d82-bb62-16449959d7d3)


  > [!NOTE]
  > The pins of the DHT22 and the Photocell can be defined as you want, but you must be careful which pin it should be to project data

                                               + `Invernadero.ino`:
  ![image](https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/b075e1db-85ae-4b0c-b878-9c5776bd38d9)


                                                  + `testing`:
  ![image](https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/3888e171-fd59-4e62-b411-65ed5b0702f7)

## 5. Database Creation
### To continue with the configuration of our project we recommend visiting our .doc file: [Greenhouse Project with Database and HTML](https://docs.google.com/document/d/1E_aDSJ7xsLImMLE22vqVSqqBkkm7MOsCMc3BbSUyEO4/edit?usp=sharing)

## 6. Database Configuration 
### To continue with the configuration of the ESP-32 for connection with MYSQL, we recommend visiting our .doc file: [Greenhouse Project with Database and HTML V2](https://docs.google.com/document/d/15Av9mOf5KoJdoDAUe40zs3s7e7orfK0BSMMuHV0Ers0/edit?usp=sharing)

## 7. Php page Careation
### To continue with the configuration of the php page for connection with WYSQL, we recommend visiting our .doc file: [PHP PAGE CREATION](https://docs.google.com/document/d/1HfKc8gn0Ez2fvbKJX8Q61wi4ZsRbIRd4ang0red0dWE/edit?usp=sharing)

## FILES
> [!NOTE]
> You will find the downloadable files for the Arduino configuration, remember to modify what is necessary for your use
> [!NOTE]
> You will find the downloadable files for the configuration of the PHP page, remember to modify what is necessary for your use
> [!NOTE]
> Database file used (PHPMyAdmin)
 

  




  
