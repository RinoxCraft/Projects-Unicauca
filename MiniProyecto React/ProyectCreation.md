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
  "name": "api",
  "main": "expo-router/entry",
  "version": "1.0.0",
  "scripts": {
    "start": "expo start",
    "reset-project": "node ./scripts/reset-project.js",
    "android": "expo start --android",
    "ios": "expo start --ios",
    "web": "expo start --web",
    "test": "jest --watchAll",
    "lint": "expo lint"
  },
  "jest": {
    "preset": "jest-expo"
  },
  "dependencies": {
    "@expo/vector-icons": "^14.0.0",
    "@react-navigation/native": "^6.0.2",
    "expo": "~51.0.14",
    "expo-constants": "~16.0.2",
    "expo-font": "~12.0.7",
    "expo-linking": "~6.3.1",
    "expo-router": "~3.5.16",
    "expo-splash-screen": "~0.27.5",
    "expo-status-bar": "~1.12.1",
    "expo-system-ui": "~3.0.6",
    "expo-web-browser": "~13.0.3",
    "react": "18.2.0",
    "react-dom": "18.2.0",
    "react-native": "0.74.2",
    "react-native-animatable": "^1.4.0",
    "react-native-gesture-handler": "~2.16.1",
    "react-native-reanimated": "~3.10.1",
    "react-native-safe-area-context": "4.10.1",
    "react-native-screens": "3.31.1",
    "react-native-web": "~0.19.10",
    "expo-secure-store": "~13.0.1"
  },
  "devDependencies": {
    "@babel/core": "^7.20.0",
    "@types/jest": "^29.5.12",
    "@types/react": "~18.2.45",
    "@types/react-test-renderer": "^18.0.7",
    "jest": "^29.2.1",
    "jest-expo": "~51.0.1",
    "react-test-renderer": "18.2.0",
    "typescript": "~5.3.3"
  },
  "private": true
}
```
- Igualmente nuestro archivo "babel.config.js"
```
module.exports = function(api) {
  api.cache(true);
  return {
    presets: ['babel-preset-expo'],
  };
};
```
### Arbol del Proyecto
<p align="center"><img width="310" height="450" src="https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/d339d64f-4fe6-431f-957b-958491422ea7"> </p>

4. Ejecutar el Proyecto
<p align="center"><img width="1099" height="313" src="https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/4a8ca0fa-0c52-4f40-bbc4-7f97fbf34835"> </p>
   - Inicia el proyecto : ``` npm start ```

> [!TIP]
> Esto abrirá una nueva ventana en tu navegador con la interfaz de Expo. Desde aquí, puedes escanear el código QR con la aplicación Expo Go en tu dispositivo móvil (disponible en la App Store y Google Play) para ver tu aplicación en tiempo real.

>[!IMPORTANT]
>Es recomendable para el proyecto instalar las siguientes dependencias ```npm install @react-navigation/native @react-navigation/native-stack expo-secure-store expo-sqlite react-native-animatable npm install react-native-screens react-native-safe-area-context```
5. Abrir el Proyecto en VS Code
   - En Visual Studio Code, selecciona File > Open Folder....
   - Navega a la carpeta ListaCompras dentro de "Micro Proyecto React" y ábrela.

### CÓDIGOS DEL PROYECTO
