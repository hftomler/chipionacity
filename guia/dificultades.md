# Dificultades encontradas

1. La primera dificultad seria encontrada fue la validación desde el lado del cliente de los formularios de login, register y contacto. Al haberlos diseñado con modales, en vez de recargar la página cada vez, provocaba diversos fallos:
* Por ejemplo, al fallar la validación de servidor, por ejemplo la contraseña, el controlador me devolvía a la página de login pero pasándola a través del index.php de nuevo, lo que provocaba la pérdida del modal y la carga completa de la página de login.
* La solución es realizar una doble comprobación: Por un lado en jQUery, con **validate** y una vez comprobada la validez de los campos se envía al servidor.

2. La carga de ficheros de imagen para usar en las imágenes de profile del usuario.
* Tras varios intentos de usar el fileInput de kartik o algunos otros plugins que me permitieran hacer un crop sobre la imagen por parte del usuario antes del envío definitivo, desarrollé la carga y subida directamente en php y jQUery, usando la posibilidad de usar imágenes de avatar proporcionadas por el propio sistema  o las subidas desde el dispositivo del propio usuario. 

4. Control sobre el ancho y el alto de las imágenes de avatar.
* Si el usuario subía imágenes con una relación ancho/alto demasiado pronunciada la imágen de perfil aparecía apaisada o alargada en vertical lo que provocaba una disrupción de la continuidad del diseño. La solución adoptada, aunque no debería ser la definitiva, es la de limitar las dimensiones de la imagen a un rectángulo de 200x300 píxeles, en cualquiera de los dos aspectos (horizontal o vertical).

En definitiva, varias dificultades graves, que han sido solventadas, de una u otra forma, y varias decenas de pequeños incovenientes, tanto de diseño como programación, que se han solucionado incorporando diversas funcionalidades
