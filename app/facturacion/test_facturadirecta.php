<?php
/**
 * Script de prueba de conexión con FacturaDirecta API
 *
 * INSTRUCCIONES:
 * 1. Completa los datos en facturadirecta_config.php
 * 2. Sube ambos archivos al servidor
 * 3. Accede a este archivo desde el navegador: http://tu-dominio.com/app/facturacion/test_facturadirecta.php
 * 4. Verifica que la conexión sea exitosa antes de continuar
 */

// Cargar configuración
require_once('facturadirecta_config.php');

// ======================================
// CONFIGURACIÓN DE SALIDA HTML
// ======================================
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Conexión FacturaDirecta API</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #007bff;
            padding-bottom: 10px;
        }
        h2 {
            color: #555;
            margin-top: 30px;
        }
        .success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        pre {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            overflow-x: auto;
            font-size: 12px;
        }
        .test-item {
            margin: 20px 0;
            padding: 15px;
            border-left: 4px solid #007bff;
            background-color: #f8f9fa;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
        }
        .badge-success { background-color: #28a745; color: white; }
        .badge-danger { background-color: #dc3545; color: white; }
        .badge-warning { background-color: #ffc107; color: #000; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔌 Test de Conexión FacturaDirecta API</h1>
        <p><strong>Fecha/Hora:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>

        <?php
        // ======================================
        // PASO 1: VALIDAR CONFIGURACIÓN
        // ======================================
        echo "<h2>📋 Paso 1: Validación de Configuración</h2>";

        $erroresConfig = validarConfiguracionFacturaDirecta();

        if (!empty($erroresConfig)) {
            echo '<div class="error">';
            echo '<strong>❌ Errores en la configuración:</strong><ul>';
            foreach ($erroresConfig as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul></div>';
            echo '<div class="warning"><strong>⚠️ Acción requerida:</strong><br>';
            echo 'Edita el archivo <code>facturadirecta_config.php</code> y completa los datos solicitados.</div>';
            echo '</div></body></html>';
            exit;
        }

        echo '<div class="success">✅ Configuración válida</div>';

        echo '<div class="test-item">';
        echo '<strong>API Key configurada:</strong> ' . substr(FACTURADIRECTA_API_KEY, 0, 10) . '...' . substr(FACTURADIRECTA_API_KEY, -5) . '<br>';
        echo '<strong>Company ID:</strong> ' . FACTURADIRECTA_COMPANY_ID . '<br>';
        echo '<strong>URL API:</strong> ' . FACTURADIRECTA_API_URL . '<br>';
        echo '<strong>Modo Debug:</strong> ' . (FACTURADIRECTA_DEBUG ? 'Activado' : 'Desactivado');
        echo '</div>';

        // ======================================
        // PASO 2: VERIFICAR EXTENSIONES PHP
        // ======================================
        echo "<h2>🔧 Paso 2: Verificación de Extensiones PHP</h2>";

        $extensiones = [
            'curl' => function_exists('curl_init'),
            'json' => function_exists('json_encode'),
            'mbstring' => function_exists('mb_strlen')
        ];

        $todasOk = true;
        echo '<div class="test-item">';
        foreach ($extensiones as $ext => $disponible) {
            $badge = $disponible ? '<span class="badge badge-success">OK</span>' : '<span class="badge badge-danger">NO</span>';
            echo "<strong>$ext:</strong> $badge<br>";
            if (!$disponible) $todasOk = false;
        }
        echo '</div>';

        if (!$todasOk) {
            echo '<div class="error">❌ Faltan extensiones PHP requeridas. Contacta con tu proveedor de hosting.</div>';
            echo '</div></body></html>';
            exit;
        }

        // ======================================
        // FUNCIÓN PARA HACER PETICIONES A LA API
        // ======================================
        function facturadirectaRequest($endpoint, $method = 'GET', $data = null) {
            $url = FACTURADIRECTA_API_URL . '/' . FACTURADIRECTA_COMPANY_ID . $endpoint;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, FACTURADIRECTA_TIMEOUT);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'facturadirecta-api-key: ' . FACTURADIRECTA_API_KEY,
                'Content-Type: application/json',
                'Accept: application/json'
            ]);

            if ($method === 'POST') {
                curl_setopt($ch, CURLOPT_POST, true);
                if ($data) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                }
            }

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);

            curl_close($ch);

            return [
                'success' => ($httpCode >= 200 && $httpCode < 300),
                'http_code' => $httpCode,
                'response' => $response,
                'error' => $error,
                'url' => $url
            ];
        }

        // ======================================
        // PASO 3: TEST DE CONEXIÓN BÁSICA
        // ======================================
        echo "<h2>🌐 Paso 3: Test de Conexión a la API</h2>";

        $testConexion = facturadirectaRequest('/invoices', 'GET');

        if (FACTURADIRECTA_DEBUG) {
            echo '<div class="info">';
            echo '<strong>🔍 Debug - Detalles de la petición:</strong><br>';
            echo '<strong>URL:</strong> ' . htmlspecialchars($testConexion['url']) . '<br>';
            echo '<strong>HTTP Code:</strong> ' . $testConexion['http_code'] . '<br>';
            echo '</div>';
        }

        if ($testConexion['success']) {
            echo '<div class="success">';
            echo '✅ <strong>Conexión exitosa con la API de FacturaDirecta</strong><br>';
            echo 'HTTP Status: ' . $testConexion['http_code'];
            echo '</div>';
        } else {
            echo '<div class="error">';
            echo '❌ <strong>Error en la conexión</strong><br>';
            echo 'HTTP Status: ' . $testConexion['http_code'] . '<br>';

            if (!empty($testConexion['error'])) {
                echo 'Error cURL: ' . htmlspecialchars($testConexion['error']) . '<br>';
            }

            // Interpretar códigos de error comunes
            switch ($testConexion['http_code']) {
                case 401:
                    echo '<br><strong>⚠️ Error de autenticación:</strong> Verifica que tu API Key sea correcta.';
                    break;
                case 403:
                    echo '<br><strong>⚠️ Acceso denegado:</strong> Verifica que tu API Key tenga los permisos necesarios.';
                    break;
                case 404:
                    echo '<br><strong>⚠️ Company ID no encontrado:</strong> Verifica que tu Company ID sea correcto.';
                    break;
                case 0:
                    echo '<br><strong>⚠️ Error de red:</strong> No se pudo conectar con el servidor. Verifica tu conexión a Internet.';
                    break;
            }
            echo '</div>';

            if (FACTURADIRECTA_DEBUG && !empty($testConexion['response'])) {
                echo '<div class="info">';
                echo '<strong>Respuesta del servidor:</strong>';
                echo '<pre>' . htmlspecialchars($testConexion['response']) . '</pre>';
                echo '</div>';
            }

            echo '</div></body></html>';
            exit;
        }

        // ======================================
        // PASO 4: LISTAR FACTURAS (TEST LECTURA)
        // ======================================
        echo "<h2>📄 Paso 4: Test de Lectura de Datos</h2>";

        $responseData = json_decode($testConexion['response'], true);

        if ($responseData !== null) {
            echo '<div class="success">✅ Respuesta JSON válida recibida</div>';

            if (isset($responseData['content']) && is_array($responseData['content'])) {
                $numFacturas = count($responseData['content']);
                echo '<div class="test-item">';
                echo '<strong>📊 Facturas encontradas:</strong> ' . $numFacturas . '<br>';

                if ($numFacturas > 0) {
                    echo '<br><strong>Últimas 3 facturas:</strong><br>';
                    echo '<pre>';
                    $facturasMostrar = array_slice($responseData['content'], 0, 3);
                    foreach ($facturasMostrar as $factura) {
                        if (isset($factura['docNumber'])) {
                            echo "- Factura: " . $factura['docNumber']['series'] . "-" . $factura['docNumber']['number'];
                            if (isset($factura['date'])) {
                                echo " | Fecha: " . $factura['date'];
                            }
                            if (isset($factura['total'])) {
                                echo " | Total: " . number_format($factura['total'], 2) . " EUR";
                            }
                            echo "\n";
                        }
                    }
                    echo '</pre>';
                }
                echo '</div>';
            } else {
                echo '<div class="info">ℹ️ No se encontraron facturas en la cuenta (esto es normal si es una cuenta nueva)</div>';
            }

            if (FACTURADIRECTA_DEBUG) {
                echo '<div class="info">';
                echo '<strong>🔍 Debug - Respuesta completa:</strong>';
                echo '<pre>' . htmlspecialchars(json_encode($responseData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . '</pre>';
                echo '</div>';
            }
        } else {
            echo '<div class="warning">⚠️ No se pudo decodificar la respuesta JSON</div>';
        }

        // ======================================
        // PASO 5: VERIFICAR SERIES CONFIGURADAS
        // ======================================
        echo "<h2>📑 Paso 5: Series de Facturación Configuradas</h2>";

        echo '<div class="test-item">';
        echo '<strong>Serie Bonificada:</strong> ' . FACTURADIRECTA_SERIE_BONIFICADA . '<br>';
        echo '<strong>Serie Privada:</strong> ' . FACTURADIRECTA_SERIE_PRIVADA . '<br>';
        echo '<strong>Serie Rectificativa:</strong> ' . FACTURADIRECTA_SERIE_RECTIFICATIVA . '<br>';
        echo '<br><strong>⚠️ Importante:</strong> Verifica que estas series existan en tu cuenta de FacturaDirecta.';
        echo '</div>';

        // ======================================
        // RESUMEN FINAL
        // ======================================
        echo "<h2>✅ Resumen del Test</h2>";
        echo '<div class="success">';
        echo '<strong>¡Conexión exitosa con FacturaDirecta API!</strong><br><br>';
        echo '<strong>✓ Configuración válida</strong><br>';
        echo '<strong>✓ Extensiones PHP disponibles</strong><br>';
        echo '<strong>✓ Autenticación correcta</strong><br>';
        echo '<strong>✓ Lectura de datos funcionando</strong><br><br>';
        echo '<strong>🎯 Próximos pasos:</strong><br>';
        echo '1. Verifica que las series de facturación existan en FacturaDirecta<br>';
        echo '2. Confirma los IDs de impuestos (IGIC) en tu cuenta<br>';
        echo '3. Revisa el mapeo de clientes/contactos<br>';
        echo '4. Procede con la integración completa<br>';
        echo '</div>';

        echo '<div class="warning">';
        echo '<strong>🔒 Seguridad:</strong><br>';
        echo '- Elimina este archivo del servidor después de completar las pruebas<br>';
        echo '- No expongas el archivo facturadirecta_config.php públicamente<br>';
        echo '- Desactiva el modo DEBUG en producción';
        echo '</div>';
        ?>
    </div>
</body>
</html>
