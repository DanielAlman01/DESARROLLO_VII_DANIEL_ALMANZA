# README - Sistema de Gestión de Biblioteca

Este proyecto es una implementación de un sistema de gestión de biblioteca que utiliza tanto MySQLi como PDO. A continuación, se presentan reflexiones sobre el desarrollo del sistema.

## Reflexiones sobre la implementación

### 1. ¿Qué diferencias notaste al implementar el sistema con MySQLi y PDO?
Al implementar el sistema con MySQLi y PDO, noté algunas diferencias clave. MySQLi está más orientado a la base de datos MySQL y proporciona un acceso más directo, lo que puede resultar en una curva de aprendizaje más fácil si ya estás familiarizado con MySQL. Por otro lado, PDO es más versátil, ya que permite conectar a diferentes bases de datos con el mismo código, lo que es una gran ventaja si en el futuro decido cambiar de base de datos. Además, PDO tiene una sintaxis más limpia y utiliza un enfoque orientado a objetos, lo que lo hace más intuitivo para quienes prefieren este estilo de programación.

### 2. ¿Cuál de los dos métodos te pareció más fácil de usar y por qué?
En términos de facilidad de uso, encontré que PDO es más sencillo de trabajar. La gestión de errores es más clara y permite utilizar excepciones, lo que me ayudó a manejar problemas de forma más eficaz. La forma en que se manejan las consultas preparadas también es más directa y menos propensa a errores de sintaxis. Además, la documentación de PDO es más accesible y me sentí más cómodo explorando sus características avanzadas.

### 3. ¿Cómo manejaste la seguridad en ambas implementaciones?
La seguridad fue una prioridad en ambas implementaciones. Utilicé consultas preparadas en MySQLi y PDO para prevenir inyecciones SQL, lo cual es fundamental para proteger la base de datos. También aseguré que todas las entradas de usuario fueran validadas y sanitizadas antes de ser procesadas. Esto incluye comprobar el formato del correo electrónico y asegurarme de que las contraseñas fueran almacenadas de forma segura. Aunque no implementé encriptación de contraseñas en esta versión, sé que es un paso esencial y planeo hacerlo en futuras actualizaciones.

### 4. ¿Qué aspectos del sistema podrían mejorarse o expandirse en el futuro?
Hay varias áreas en las que podría mejorar el sistema en el futuro. Una de ellas es la implementación de un sistema de autenticación y autorización más robusto, que permita a los usuarios registrarse, iniciar sesión y gestionar sus propios préstamos. También me gustaría añadir una interfaz de usuario más amigable y atractiva para facilitar la navegación. Además, podría incorporar funcionalidades como la búsqueda avanzada de libros, un sistema de recomendaciones basado en las preferencias de los usuarios, y la posibilidad de reservar libros en línea. Finalmente, integrar un sistema de notificaciones para recordar a los usuarios sobre los préstamos pendientes sería una gran adición.
