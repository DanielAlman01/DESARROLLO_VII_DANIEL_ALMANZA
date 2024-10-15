
## Reflexión Final

### 1. ¿Qué desafíos encontraste al implementar este sistema?
Durante la implementación, enfrenté varios desafíos, como:

- **Gestión de Sesiones**: Asegurarme de que las sesiones se manejen correctamente y que se mantenga el estado del carrito a lo largo de diferentes páginas.
- **Validación de Datos**: Implementar una validación adecuada de los datos del formulario para prevenir errores y garantizar la seguridad del sistema.
- **Experiencia del Usuario**: Diseñar una interfaz que sea intuitiva y fácil de usar, a la vez que proporciona información clara sobre los productos y el carrito.

### 2. ¿Cómo aseguraste la seguridad de las sesiones y cookies en tu implementación?
Para garantizar la seguridad de las sesiones y cookies, implementé varias medidas:

- **Configuración de Sesiones**: Utilicé `session_start()` con opciones de seguridad como `cookie_httponly`, `cookie_secure`, y `cookie_samesite`.
- **Validación de Datos**: Apliqué `htmlspecialchars()` para sanitizar las entradas del usuario y prevenir ataques XSS.
- **Uso de Cookies**: Las cookies se establecen con un tiempo de vida limitado y son utilizadas solo para recordar el nombre del usuario después de realizar una compra.

### 3. ¿Qué mejoras o características adicionales podrías añadir a este sistema en el futuro?
Existen varias mejoras que podrían implementarse en el futuro:

- **Base de Datos**: Integrar una base de datos para almacenar productos y pedidos, lo que permitiría una gestión más dinámica y escalable.
- **Autenticación de Usuarios**: Implementar un sistema de inicio de sesión para que los usuarios puedan gestionar sus cuentas y ver el historial de compras.
- **Métodos de Pago**: Añadir integración con pasarelas de pago para procesar pagos en línea.
- **Mejoras en la Interfaz**: Mejorar la interfaz de usuario con CSS y JavaScript para una experiencia más atractiva y responsive.

### 4. ¿Cómo se compara el uso de sesiones con otras formas de mantener el estado en aplicaciones web?
El uso de sesiones ofrece varias ventajas sobre otras formas de mantener el estado, como el uso de cookies o almacenamiento en el lado del cliente:

- **Seguridad**: Las sesiones son almacenadas en el servidor, lo que reduce el riesgo de manipulación del lado del cliente.
- **Capacidad**: Las sesiones pueden almacenar datos más complejos y grandes volúmenes de información sin limitarse al tamaño de las cookies.
- **Facilidad de Uso**: Las sesiones simplifican el manejo de estado al permitir el acceso a los datos del usuario a lo largo de diferentes páginas sin la necesidad de gestionarlos manualmente.
