# CREACIÓN DEL PROYECTO PASO A PASO

1. Requerimientos:
- Tener Instalado [Visual Studio Code](https://code.visualstudio.com/)
- Tener Instalado [Node.js](https://nodejs.org/en)
2. Proceso
Vamos paso a paso desde la creación de la carpeta. Asumiré que tienes Visual Studio Code (VS Code) instalado.
1. Abrir la Carpeta en Visual Studio Code
    - Abre Visual Studio Code.
    - Selecciona File > Open Folder....
    - Navega a la carpeta "Micro Proyecto React" que creaste y ábrela.

> [!IMPORTANT]
> El nombre de la carpeta "Micro Proyecto React" es opcional, puedes darle el nombre que quieras

## Configurar el Entorno de Desarrollo.
1. Instalar Node.js y npm
   a. Descarga e instala Node.js desde [nodejs.org](https://nodejs.org/en). Esto también instalará npm (Node Package Manager).
2. Instalar Expo CLI
      - Abre una terminal en VS Code
           - Selecciona Terminal > New Terminal desde el menú superior.
           - Ejecuta el siguiente comando en la terminal para instalar Expo CLI: ``` npm install -g expo-cli ```

   - En la terminal de VS Code, navega a la carpeta "Micro Proyecto React" (si no estás ya ahí):
     ``` cd path/to/your/folder/Micro Proyecto React ```
> [!NOTE]
> Reemplaza path/to/your/folder con la ruta real de la carpeta.
   - Crea un nuevo proyecto  usando el siguiente comando: ``` npx create-expo-app MyProject ```
   - Selecciona una plantilla (elige "blank" para empezar desde cero):
> [!NOTE]
> Usa las teclas de flecha para navegar y presiona Enter para seleccionar.
   - Navega a la carpeta del proyecto recién creado: ```cd MyProyect ```
   - Configuramos nuestro JSON.JS de la siguiente forma:
```{
  "name": "micro-proyecto-react",
  "version": "1.0.0",
  "main": "index.js",
  "scripts": {
    "start": "expo start",
    "android": "expo start --android",
    "ios": "expo start --ios",
    "web": "expo start --web"
  },
  "dependencies": {
    "expo": "~49.0.7",
    "expo-secure-store": "~13.0.3",
    "expo-sqlite": "~12.0.3",
    "react": "18.2.0",
    "react-dom": "18.2.0",
    "react-native": "0.72.3",
    "react-native-animatable": "^1.3.3",
    "react-native-safe-area-context": "4.7.4",
    "react-native-screens": "~3.29.0",
    "@react-navigation/native": "^6.1.6",
    "@react-navigation/native-stack": "^6.10.2"
  },
  "devDependencies": {
    "@babel/core": "^7.22.0",
    "@types/react": "^18.2.20",
    "@types/react-native": "^0.72.0"
  }
}
```

### Arbol del Proyecto
<p align="center"><img width="260" height="246" src="https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/ac64ebb5-7dbf-4965-9a3c-db32291008f0"> </p>

4. Ejecutar el Proyecto
<p align="center"><img width="1099" height="313" src="https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/4a8ca0fa-0c52-4f40-bbc4-7f97fbf34835"> </p>
   - Inicia el proyecto : ``` npm start ```

> [!TIP]
> Esto abrirá una nueva ventana en tu navegador con la interfaz de Expo. Desde aquí, puedes escanear el código QR con la aplicación Expo Go en tu dispositivo móvil (disponible en la App Store y Google Play) para ver tu aplicación en tiempo real.

>[!IMPORTANT]
>Es recomendable para el proyecto instalar las siguientes dependencias ```npm install @react-navigation/native @react-navigation/native-stack expo-secure-store expo-sqlite react-native-animatable```
5. Abrir el Proyecto en VS Code
   - En Visual Studio Code, selecciona File > Open Folder....
   - Navega a la carpeta ListaCompras dentro de "Micro Proyecto React" y ábrela.

### CÓDIGOS DEL PROYECTO
