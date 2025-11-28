<?php
/**
 * Configuración de FacturaDirecta API
 *
 * INSTRUCCIONES:
 * 1. Completa los datos de tu cuenta de FacturaDirecta
 * 2. Guarda este archivo
 * 3. NO subas este archivo a repositorios públicos (contiene credenciales sensibles)
 */

// ======================================
// CREDENCIALES - COMPLETA ESTOS DATOS
// ======================================

// Tu API Key de FacturaDirecta (obligatorio)
// Obtenla desde: https://app.facturadirecta.com/settings/api
define('FACTURADIRECTA_API_KEY', 'b6hPmn.XjuupwecYRhcQq8kYTAzFlqxsXYUNPVD');

// Tu Company ID (obligatorio)
// Formato: com_xxxxxxxxxxxxxxxxxxxxxxxx
// Obtenlo desde el panel de FacturaDirecta
define('FACTURADIRECTA_COMPANY_ID', 'com_sandbox_1_36a55a38-c1fd-4985-844c-c44000a95b09');

// ======================================
// CONFIGURACIÓN DE LA API
// ======================================

// URL base de la API de FacturaDirecta
define('FACTURADIRECTA_API_URL', 'https://app.facturadirecta.com/api');

// Timeout para las peticiones (en segundos)
define('FACTURADIRECTA_TIMEOUT', 30);

// Modo debug (true = muestra información detallada, false = producción)
define('FACTURADIRECTA_DEBUG', true);

// ======================================
// CONFIGURACIÓN DE FACTURAS
// ======================================

// Series de facturación
define('FACTURADIRECTA_SERIE_BONIFICADA', 'BON');  // Serie para facturas bonificadas
define('FACTURADIRECTA_SERIE_PRIVADA', 'PRIV');    // Serie para facturas privadas (prefijo P)
define('FACTURADIRECTA_SERIE_RECTIFICATIVA', 'RECT'); // Serie para facturas rectificativas

// Moneda por defecto
define('FACTURADIRECTA_CURRENCY', 'EUR');

// ID del impuesto IGIC exento en FacturaDirecta
// IMPORTANTE: Debes obtener este ID desde tu cuenta de FacturaDirecta
// Posibles valores: 'S_IGIC_0', 'S_IVA_EXENTO', etc.
define('FACTURADIRECTA_TAX_EXENTO', 'S_IGIC_0');

// IDs de impuestos IGIC según porcentaje
define('FACTURADIRECTA_TAX_IGIC_7', 'S_IGIC_7');   // IGIC 7%
define('FACTURADIRECTA_TAX_IGIC_3', 'S_IGIC_3');   // IGIC 3%

// ======================================
// VALIDACIÓN
// ======================================

function validarConfiguracionFacturaDirecta() {
    $errores = [];

    if (FACTURADIRECTA_API_KEY === 'TU_API_KEY_AQUI' || empty(FACTURADIRECTA_API_KEY)) {
        $errores[] = "Falta configurar FACTURADIRECTA_API_KEY";
    }

    if (FACTURADIRECTA_COMPANY_ID === 'TU_COMPANY_ID_AQUI' || empty(FACTURADIRECTA_COMPANY_ID)) {
        $errores[] = "Falta configurar FACTURADIRECTA_COMPANY_ID";
    }

    if (!function_exists('curl_init')) {
        $errores[] = "La extensión cURL de PHP no está instalada";
    }

    return $errores;
}

?>
