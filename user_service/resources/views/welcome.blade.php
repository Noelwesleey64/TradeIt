<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradeIt - User Service</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 48px;
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 16px;
            font-weight: 700;
        }
        p {
            color: #666;
            font-size: 1.125rem;
            line-height: 1.6;
            margin-bottom: 32px;
        }
        .status {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 8px 20px;
            border-radius: 24px;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 24px;
        }
        .info {
            background: #f3f4f6;
            border-radius: 8px;
            padding: 20px;
            margin-top: 24px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            color: #6b7280;
            font-weight: 500;
        }
        .info-value {
            color: #111827;
            font-weight: 600;
        }
    </style>
</head>
<body>
        <div class="container">
        <span class="status">✓ Online yes brob</span>
        <h1>TradeIt User Bitch gggg</h1>
       
        
        <div class="info">
            <div class="info-item">
                <span class="info-label">Laravel Version</span>
                <span class="info-value">{{ app()->version() }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">PHP Version</span>
                <span class="info-value">{{ PHP_VERSION }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Environment</span>
                <span class="info-value">{{ app()->environment() }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Server Time</span>
                <span class="info-value">{{ date('Y-m-d H:i:s') }}</span>
            </div>
        </div>
    </div>
</body>
</html>
