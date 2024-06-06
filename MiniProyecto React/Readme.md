# _Proyecto React Native_ 📱

1. Objetivos
   Reforzar los conceptos más importantes para la implementación de aplicaciones móviles usando frameworks multiplataforma.
   
3. Prerequerimientos
- Uso de un framework multiplataforma: Ionic, React Native, Flutter, etc.
> [!NOTE]
> En nuestro Caso usaremos un framework llamado [Reack Native](https://reactnative.dev/)
- Manejo de base de datos
- Validación de datos en la interfaz de usuario
- Seguridad (opcional).
  
4. Descripción
Como usuario de la aplicación se espera que sea una herramienta que ayude a realizar las compras del día a día, a través de la administración de una
sencilla lista de compras personal, que además le permita hacerles seguimiento a las compras.
- Se quiere desarrollar una aplicación móvil multiplataforma que permita administrar una lista de compras personalizada con las siguientes características:
  
1. Para ingresar se debe usar login y password. El login será una cadena de texto con una longitud máxima de 40 caracteres. Para la validación, no se distingue entre mayúsculas y minúsculas. El password es una cadena con una longitud máxima de 200 caracteres, porque se debe guardar cifrado utilizando algún algoritmo de tipo RSA con un cifrado mínimo (secret key) de 256bits.
   
2. Mostrar, en la interfaz principal, una lista de productos con dos columnas mínimo: el nombre del producto y el lugar o sitio en donde quiero comprarlo. Algo similar a la siguiente figura:
<p align="center"><img width="240" height="132" src="https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/af7b6bc2-81b0-4c4a-b129-bba78f97714d"> </p>

> [!NOTE]
> El diseño gráfico queda por cuenta de los desarrolladores.

3. Se debe presentar siempre la lista mas reciente (cuya fecha de creación sea la mas reciente). La tabla _listacompras_  debe tener al menos los siguientes
campos:
- **Id**: identificador único de la lista de compras.
- **FechaRegistro**: fecha y hora del sistema en la que se realiza el registro de la lista en la base de datos.

4. Para los elementos de la lista, se tiene una tabla llamada elementoslista, con los siguientes campos:
- Id: identificador único del elemento o producto a comprar.
- Nombre: nombre del producto.
- IdSitio: identificador del sitio en donde se quiere comprar el producto.
- IdLista: identificador de la lista a la que pertenece el producto.
  
5. En el estado inicial de la aplicación, no hay datos, por lo tanto, la lista aparece vacía.
   
6. Se tiene un botón para adicionar elementos a la lista. El estándar, en aplicaciones móviles, recomienda un botón con el signo más (+) ubicado estratégicamente para un fácil acceso.
   
7. Al presionar el botón más (+), se debe abrir una venta modal con un pequeño formulario para el ingreso de los datos: nombre del producto (cuadro de texto) y el sitio (lista de selección), como se muestra en la siguiente figura:
<p align="center"><img width="240" height="132" src="https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/fea86e56-4e52-4f97-bba9-f15ec8a0b740"> </p>

> [!NOTE]
> Cuando se selecciona un sitio, es posible que la lista inicial este vacía o que el sitio no se encuentra en la lista, entonces, debe existir un botón para adicionar un nuevo elemento a la lista de sitios.

8. Al presionar el botón mas (+) de la lista de sitios, se debe mostrar otra ventana modal para registrar el sitio. Algo similar a la siguiente figura:
<p align="center"><img width="240" height="132" src="https://github.com/RinoxCraft/Projects-Unicauca/assets/67917424/4035ae2b-9e9d-4943-a467-5f6e7d465a02"> </p>

> [!NOTE]
> Si presiona el botón cancelar, se cierra la ventana modal y regresa a la ventana modal anterior. No sucede nada más.

9. Si presiona el botón Guardar, el nuevo nombre del sitio se guarda en la base de datos y se actualiza la lista de selección de sitios en la ventana modal de Nuevo producto.
    
10. Nota: La tabla de sitios en la base de datos, debe contener, al menos, los siguientes campos:
- Id: cada sitio debe manejar su propio id para que pueda se identificado dentro de la aplicación.
- Nombre: el nombre del sitio que se desea registrar.
- FechaRegistro: la fecha y hora del sistema, en la que se realiza el registro o inserción del sitio en la base de datos.

11. Desde la ventana de Nuevo producto, se puede presionar el botón Cancelar, y regresa a la lista de compras.
    
12. Si presiona el botón Guardar, la información del producto se guarda en la base de datos y se actualiza la lista de compras.
    
13. Desde la interfaz de la lista de compras, el usuario puede ir señalando (marcando) cada elemento que va comprando mediante un gesto como swipe (desplazamiento lateral) o doble tap (similar al doble click).
    
14. Se puede eliminar elementos de la lista mediante un swipe full, si y solo si, no está marcado.
    
15. Se puede modificar un elemento/producto de la lista. Usar el gesto swipe con un botón para editar, en cuyo caso se abre una ventana modal similar a la de Nuevo producto. Cambia los datos y se actualiza tanto en la base de datos como en la lista de compras.
    
16. Finalmente, es posible crear una lista de compras nueva, a partir de alguna ya existente. Para ello, debe elegir la mejor manera de implementarlo, ya sea a partir de un botón en la interfaz de usuario, una opción del menú de la aplicación, etc.
    
17. La creación de la nueva lista será en realidad, la clonación o copia de la lista previa seleccionada. En esta parte se tendrá en cuenta la creatividad del equipo de desarrollo para diseñar la opción mas simple y usable para el usuario.
    
18. Los formularios de datos deben validar los campos de información de acuerdo con la definición de los campos en la base de datos. Así, por ejemplo, se deben tener en cuenta:
- Campos obligatorios
- Caracteres especiales
- Longitud de los campos de datos
- Rangos de valores permitidos

> [!IMPORTANT]
> Se deben validar los campos de datos en los formularios de datos para garantizar la consistencia de la información.

## LINK PASO A PASO DE CREACIÓN DE PROYECTO
PASO A PASO [LINK :accessibility: 🤟](https://github.com/RinoxCraft/Projects-Unicauca/blob/d140c63184b31830f3fca3d70487f63f5d5123e2/MiniProyecto%20React/ProyectCreation.md)



