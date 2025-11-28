================================================================================
  INSTRUCCIONES - TEST DE CONEXIÓN CON FACTURADIRECTA API
================================================================================

ARCHIVOS CREADOS:
-----------------
1. facturadirecta_config.php  - Configuración y credenciales de la API
2. test_facturadirecta.php    - Script de prueba de conexión
3. README_FACTURADIRECTA.txt  - Este archivo de instrucciones


PASO A PASO:
============

PASO 1: OBTENER CREDENCIALES DE FACTURADIRECTA
-----------------------------------------------

1. Accede a tu cuenta de FacturaDirecta:
   https://app.facturadirecta.com/

2. Ve a la sección de configuración/API (Settings > API)

3. Obtén los siguientes datos:
   - API KEY: Una clave larga alfanumérica
   - COMPANY ID: Formato com_xxxxxxxxxxxxxxxxxxxxxxxx


PASO 2: CONFIGURAR LAS CREDENCIALES
------------------------------------

1. Abre el archivo: facturadirecta_config.php

2. Localiza estas líneas (aprox. línea 15-20):

   define('FACTURADIRECTA_API_KEY', 'TU_API_KEY_AQUI');
   define('FACTURADIRECTA_COMPANY_ID', 'TU_COMPANY_ID_AQUI');

3. Reemplaza 'TU_API_KEY_AQUI' con tu API Key real

4. Reemplaza 'TU_COMPANY_ID_AQUI' con tu Company ID real

   Ejemplo:
   define('FACTURADIRECTA_API_KEY', 'fd_live_xxxxxxxxxxxxxxxxxxx');
   define('FACTURADIRECTA_COMPANY_ID', 'com_abcd1234efgh5678ijkl');

5. Guarda el archivo


PASO 3: CONFIGURAR SERIES DE FACTURACIÓN (OPCIONAL)
---------------------------------------------------

En el mismo archivo facturadirecta_config.php, verifica las series:

define('FACTURADIRECTA_SERIE_BONIFICADA', 'BON');
define('FACTURADIRECTA_SERIE_PRIVADA', 'PRIV');
define('FACTURADIRECTA_SERIE_RECTIFICATIVA', 'RECT');

Ajústalas según las series que uses en FacturaDirecta.


PASO 4: SUBIR ARCHIVOS AL SERVIDOR
-----------------------------------

1. Sube estos 2 archivos a tu servidor:
   - facturadirecta_config.php
   - test_facturadirecta.php

2. Ubícalos en: /app/facturacion/

3. Asegúrate de que tengan permisos de lectura (chmod 644)


PASO 5: EJECUTAR EL TEST
-------------------------

1. Abre tu navegador

2. Accede a la URL:
   http://TU-DOMINIO/app/facturacion/test_facturadirecta.php

   O en local:
   http://eduka-te.com/gestion/app/facturacion/test_facturadirecta.php

3. El script ejecutará 5 pruebas automáticas:

   ✓ Paso 1: Validación de configuración
   ✓ Paso 2: Verificación de extensiones PHP (cURL, JSON)
   ✓ Paso 3: Test de conexión a la API
   ✓ Paso 4: Test de lectura de datos (listado de facturas)
   ✓ Paso 5: Verificación de series configuradas

4. Verás mensajes en verde (✅) si todo está correcto
   O mensajes en rojo (❌) si hay errores


INTERPRETACIÓN DE RESULTADOS:
==============================

✅ CONEXIÓN EXITOSA:
-------------------
Si ves: "✅ Conexión exitosa con la API de FacturaDirecta"
→ Todo está funcionando correctamente
→ Puedes proceder con la integración completa
→ Anota los datos mostrados para la configuración final


❌ ERRORES COMUNES:
------------------

Error 401 - Autenticación fallida:
→ Verifica que tu API Key sea correcta
→ Copia y pega sin espacios adicionales

Error 403 - Acceso denegado:
→ Tu API Key no tiene permisos suficientes
→ Revisa la configuración de permisos en FacturaDirecta

Error 404 - Company ID no encontrado:
→ Verifica que tu Company ID sea correcto
→ Debe incluir el prefijo "com_"

Error 0 - No se puede conectar:
→ Problema de red o firewall
→ Verifica que el servidor tenga acceso a Internet
→ Contacta con tu hosting si persiste


INFORMACIÓN ADICIONAL QUE NECESITARÁS:
=======================================

Después de completar el test exitosamente, anota lo siguiente
desde tu panel de FacturaDirecta:

1. IDs DE IMPUESTOS:
   - IGIC Exento: S_IGIC_0 (o similar)
   - IGIC 7%: S_IGIC_7
   - IGIC 3%: S_IGIC_3

   Ubicación en FacturaDirecta:
   Settings > Taxes / Impuestos

2. SERIES ACTIVAS:
   - ¿Qué series tienes creadas?
   - ¿Cuáles usarás para bonificadas/privadas/rectificativas?

   Ubicación en FacturaDirecta:
   Settings > Document Series

3. CONTACTOS/CLIENTES:
   - ¿Ya tienes empresas creadas como contactos?
   - Formato del ID: con_xxxxxxxxxxxxxxxxxxxxxxxx

   Ubicación en FacturaDirecta:
   Contacts / Contactos


SEGURIDAD:
==========

⚠️ IMPORTANTE - DESPUÉS DE COMPLETAR EL TEST:

1. ELIMINA el archivo test_facturadirecta.php del servidor
   (contiene información sensible y no debe ser accesible públicamente)

2. PROTEGE el archivo facturadirecta_config.php:
   - No lo subas a repositorios públicos (Git)
   - Agrégalo a .gitignore
   - Mantén permisos restrictivos (chmod 640)

3. DESACTIVA el modo DEBUG en producción:
   define('FACTURADIRECTA_DEBUG', false);


PRÓXIMOS PASOS:
===============

Una vez completado el test exitosamente:

1. Comparte los resultados (captura de pantalla o copia el resultado)

2. Confirma la información sobre:
   - Series de facturación a usar
   - IDs de impuestos (IGIC)
   - Estrategia para mapear clientes

3. Procederemos con la integración completa:
   - Crear clases PHP para la API
   - Integrar con factura_bonificada.php
   - Integrar con factura_privada.php
   - Sincronización de datos


SOPORTE:
========

Si encuentras problemas:

1. Activa el modo DEBUG (ya está activo por defecto)
2. Captura el mensaje de error completo
3. Verifica los logs de PHP del servidor
4. Comparte la información para diagnóstico


================================================================================
Creado: 2025-11-27
Versión: 1.0
================================================================================
