<?php
/**
 * Script de exploración completa de FacturaDirecta API
 *
 * Este script obtiene y muestra toda la configuración necesaria:
 * - Series de facturación
 * - Impuestos configurados
 * - Contactos/Clientes
 * - Facturas existentes
 */

require_once('facturadirecta_config.php');

// Función auxiliar para hacer peticiones
function apiRequest($endpoint, $method = 'GET', $data = null) {
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
        if ($data) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        'success' => ($httpCode >= 200 && $httpCode < 300),
        'code' => $httpCode,
        'data' => json_decode($response, true),
        'raw' => $response
    ];
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorador FacturaDirecta API</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
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
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
        }
        h3 {
            color: #666;
            margin-top: 20px;
            border-left: 4px solid #28a745;
            padding-left: 10px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            background: white;
        }
        th {
            background-color: #007bff;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f8f9fa;
        }
        .code {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 3px;
            padding: 2px 6px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            color: #e83e8c;
        }
        .copy-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 11px;
            margin-left: 10px;
        }
        .copy-btn:hover {
            background-color: #218838;
        }
        pre {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            overflow-x: auto;
            font-size: 12px;
        }
        .section {
            margin: 20px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
            margin-left: 5px;
        }
        .badge-success { background-color: #28a745; color: white; }
        .badge-info { background-color: #17a2b8; color: white; }
        .badge-warning { background-color: #ffc107; color: #000; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Explorador de Configuración FacturaDirecta</h1>
        <p><strong>Fecha:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>

        <?php
        // ===================================
        // 1. OBTENER SERIES DE FACTURACIÓN
        // ===================================
        echo "<h2>📑 1. Series de Facturación</h2>";

        $series = apiRequest('/document-series');

        if ($series['success'] && isset($series['data']['content'])) {
            $seriesList = $series['data']['content'];

            if (count($seriesList) > 0) {
                echo '<div class="success">✅ Se encontraron ' . count($seriesList) . ' serie(s) configurada(s)</div>';
                echo '<table>';
                echo '<tr><th>Nombre/Serie</th><th>Tipo</th><th>ID</th><th>Acción</th></tr>';

                foreach ($seriesList as $serie) {
                    $name = isset($serie['name']) ? $serie['name'] : 'Sin nombre';
                    $type = isset($serie['documentType']) ? $serie['documentType'] : 'N/A';
                    $id = isset($serie['id']) ? $serie['id'] : 'N/A';

                    echo '<tr>';
                    echo '<td><strong>' . htmlspecialchars($name) . '</strong></td>';
                    echo '<td>' . htmlspecialchars($type) . '</td>';
                    echo '<td><span class="code">' . htmlspecialchars($id) . '</span></td>';
                    echo '<td><button class="copy-btn" onclick="copyToClipboard(\'' . htmlspecialchars($name) . '\')">Copiar</button></td>';
                    echo '</tr>';
                }
                echo '</table>';

                echo '<div class="info">';
                echo '<strong>📋 Para la configuración:</strong><br>';
                echo 'Anota qué series usarás para:<br>';
                echo '• Facturas bonificadas<br>';
                echo '• Facturas privadas (prefijo P)<br>';
                echo '• Facturas rectificativas (prefijo R)';
                echo '</div>';
            } else {
                echo '<div class="warning">⚠️ No se encontraron series. Debes crear al menos una serie en FacturaDirecta.</div>';
            }
        } else {
            echo '<div class="error">❌ Error al obtener series: HTTP ' . $series['code'] . '</div>';
        }

        // ===================================
        // 2. OBTENER IMPUESTOS/TAXES
        // ===================================
        echo "<h2>💰 2. Impuestos Configurados</h2>";

        $taxes = apiRequest('/taxes');

        if ($taxes['success'] && isset($taxes['data']['content'])) {
            $taxesList = $taxes['data']['content'];

            if (count($taxesList) > 0) {
                echo '<div class="success">✅ Se encontraron ' . count($taxesList) . ' impuesto(s) configurado(s)</div>';
                echo '<table>';
                echo '<tr><th>Nombre</th><th>Porcentaje</th><th>ID</th><th>Tipo</th><th>Acción</th></tr>';

                foreach ($taxesList as $tax) {
                    $name = isset($tax['name']) ? $tax['name'] : 'Sin nombre';
                    $percentage = isset($tax['percentage']) ? $tax['percentage'] . '%' : 'N/A';
                    $id = isset($tax['id']) ? $tax['id'] : 'N/A';
                    $type = isset($tax['type']) ? $tax['type'] : 'N/A';

                    echo '<tr>';
                    echo '<td><strong>' . htmlspecialchars($name) . '</strong></td>';
                    echo '<td>' . htmlspecialchars($percentage) . '</td>';
                    echo '<td><span class="code">' . htmlspecialchars($id) . '</span></td>';
                    echo '<td>' . htmlspecialchars($type) . '</td>';
                    echo '<td><button class="copy-btn" onclick="copyToClipboard(\'' . htmlspecialchars($id) . '\')">Copiar ID</button></td>';
                    echo '</tr>';
                }
                echo '</table>';

                echo '<div class="info">';
                echo '<strong>📋 IDs importantes para la configuración:</strong><br>';
                echo 'Busca y anota los IDs de:<br>';
                echo '• <strong>IGIC 0% / Exento:</strong> (el que usarás por defecto)<br>';
                echo '• <strong>IGIC 7%:</strong> (si aplica)<br>';
                echo '• <strong>IGIC 3%:</strong> (si aplica)<br>';
                echo '<br>Estos IDs irán en el archivo de configuración.';
                echo '</div>';
            } else {
                echo '<div class="warning">⚠️ No se encontraron impuestos configurados.</div>';
            }
        } else {
            echo '<div class="error">❌ Error al obtener impuestos: HTTP ' . $taxes['code'] . '</div>';
        }

        // ===================================
        // 3. OBTENER CONTACTOS/CLIENTES
        // ===================================
        echo "<h2>👥 3. Contactos/Clientes</h2>";

        $contacts = apiRequest('/contacts');

        if ($contacts['success'] && isset($contacts['data']['content'])) {
            $contactsList = $contacts['data']['content'];

            if (count($contactsList) > 0) {
                echo '<div class="success">✅ Se encontraron ' . count($contactsList) . ' contacto(s)</div>';
                echo '<table>';
                echo '<tr><th>Nombre/Razón Social</th><th>CIF/NIF</th><th>Email</th><th>ID</th><th>Acción</th></tr>';

                $shown = 0;
                foreach ($contactsList as $contact) {
                    if ($shown >= 10) break; // Mostrar solo los primeros 10

                    $name = isset($contact['name']) ? $contact['name'] : 'Sin nombre';
                    $taxId = isset($contact['taxId']) ? $contact['taxId'] : 'N/A';
                    $email = isset($contact['email']) ? $contact['email'] : 'N/A';
                    $id = isset($contact['id']) ? $contact['id'] : 'N/A';

                    echo '<tr>';
                    echo '<td><strong>' . htmlspecialchars($name) . '</strong></td>';
                    echo '<td>' . htmlspecialchars($taxId) . '</td>';
                    echo '<td>' . htmlspecialchars($email) . '</td>';
                    echo '<td><span class="code">' . htmlspecialchars($id) . '</span></td>';
                    echo '<td><button class="copy-btn" onclick="copyToClipboard(\'' . htmlspecialchars($id) . '\')">Copiar ID</button></td>';
                    echo '</tr>';

                    $shown++;
                }
                echo '</table>';

                if (count($contactsList) > 10) {
                    echo '<div class="info">ℹ️ Mostrando los primeros 10 de ' . count($contactsList) . ' contactos totales</div>';
                }

                echo '<div class="info">';
                echo '<strong>📋 Estrategia de contactos:</strong><br>';
                echo 'Tienes contactos ya creados. Opciones:<br>';
                echo '• <strong>Opción 1:</strong> Agregar campo "facturadirecta_contact_id" a la tabla "empresas" de tu BD<br>';
                echo '• <strong>Opción 2:</strong> Crear contactos automáticamente desde la integración<br>';
                echo '• <strong>Opción 3:</strong> Buscar contacto por CIF antes de facturar';
                echo '</div>';
            } else {
                echo '<div class="warning">⚠️ No hay contactos creados. Se pueden crear automáticamente al facturar.</div>';
            }
        } else {
            echo '<div class="error">❌ Error al obtener contactos: HTTP ' . $contacts['code'] . '</div>';
        }

        // ===================================
        // 4. OBTENER FACTURAS EXISTENTES
        // ===================================
        echo "<h2>📄 4. Facturas Existentes</h2>";

        $invoices = apiRequest('/invoices?limit=5');

        if ($invoices['success'] && isset($invoices['data']['content'])) {
            $invoicesList = $invoices['data']['content'];

            if (count($invoicesList) > 0) {
                echo '<div class="success">✅ Se encontraron facturas en el sistema</div>';
                echo '<table>';
                echo '<tr><th>Número</th><th>Fecha</th><th>Cliente</th><th>Total</th><th>Estado</th></tr>';

                foreach ($invoicesList as $invoice) {
                    $number = isset($invoice['docNumber']) ?
                        $invoice['docNumber']['series'] . '-' . $invoice['docNumber']['number'] : 'N/A';
                    $date = isset($invoice['date']) ? $invoice['date'] : 'N/A';
                    $client = isset($invoice['contact']['name']) ? $invoice['contact']['name'] : 'N/A';
                    $total = isset($invoice['total']) ? number_format($invoice['total'], 2) . ' EUR' : 'N/A';
                    $status = isset($invoice['status']) ? $invoice['status'] : 'N/A';

                    echo '<tr>';
                    echo '<td><strong>' . htmlspecialchars($number) . '</strong></td>';
                    echo '<td>' . htmlspecialchars($date) . '</td>';
                    echo '<td>' . htmlspecialchars($client) . '</td>';
                    echo '<td>' . htmlspecialchars($total) . '</td>';
                    echo '<td><span class="badge badge-info">' . htmlspecialchars($status) . '</span></td>';
                    echo '</tr>';
                }
                echo '</table>';

                echo '<div class="info">ℹ️ Mostrando las últimas 5 facturas</div>';
            } else {
                echo '<div class="info">ℹ️ No hay facturas creadas aún (cuenta nueva o sandbox)</div>';
            }
        } else {
            echo '<div class="warning">⚠️ No se pudieron obtener facturas</div>';
        }

        // ===================================
        // 5. RESUMEN Y PRÓXIMOS PASOS
        // ===================================
        echo "<h2>✅ Resumen y Configuración Necesaria</h2>";

        echo '<div class="section">';
        echo '<h3>🎯 Información recopilada:</h3>';
        echo '<table style="background: white;">';
        echo '<tr><td><strong>Series disponibles:</strong></td><td>' .
            (isset($seriesList) ? count($seriesList) : 0) . '</td></tr>';
        echo '<tr><td><strong>Impuestos configurados:</strong></td><td>' .
            (isset($taxesList) ? count($taxesList) : 0) . '</td></tr>';
        echo '<tr><td><strong>Contactos existentes:</strong></td><td>' .
            (isset($contactsList) ? count($contactsList) : 0) . '</td></tr>';
        echo '<tr><td><strong>Facturas en sistema:</strong></td><td>' .
            (isset($invoicesList) ? count($invoicesList) : 0) . '</td></tr>';
        echo '</table>';
        echo '</div>';

        echo '<div class="warning">';
        echo '<h3>📝 Próximos pasos:</h3>';
        echo '<ol>';
        echo '<li><strong>Actualizar facturadirecta_config.php</strong> con las series e IDs de impuestos correctos</li>';
        echo '<li><strong>Decidir estrategia de contactos:</strong> ¿Mapear existentes o crear automáticamente?</li>';
        echo '<li><strong>Modificar tablas de BD</strong> (opcional): Agregar campo para guardar ID de factura en FacturaDirecta</li>';
        echo '<li><strong>Crear clase de integración</strong> para enviar facturas a FacturaDirecta</li>';
        echo '<li><strong>Integrar con factura_bonificada.php y factura_privada.php</strong></li>';
        echo '</ol>';
        echo '</div>';

        echo '<div class="info">';
        echo '<h3>🔒 Seguridad:</h3>';
        echo '• Elimina este archivo después de obtener la información<br>';
        echo '• No expongas los archivos de configuración públicamente<br>';
        echo '• En producción, desactiva el modo DEBUG';
        echo '</div>';
        ?>
    </div>

    <script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('✅ Copiado: ' + text);
        }, function(err) {
            console.error('Error al copiar: ', err);
        });
    }
    </script>
</body>
</html>
