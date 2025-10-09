<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* Black + green theme */
        :root {
            --bg-start: #000000;
            --bg-end: #04201a;
            --card-bg: #071917;
            --text-main: #e6fff5;
            --text-muted: #9fe2c9;
            --gold-500: #10b981;
            --gold-600: #059669;
            --gold-700: #047857;
            --border: #0a3a2f;
            --ring: rgba(16,185,129,0.15);
            --shadow: 0 10px 30px rgba(0,0,0,0.6);
        }
        body {
            font-family: "Segoe UI", Roboto, Inter, Arial, sans-serif;
            background:
                radial-gradient(1200px 600px at 10% 10%, rgba(16,185,129,0.04), transparent 40%),
                radial-gradient(1200px 600px at 80% 20%, rgba(5,150,105,0.03), transparent 45%),
                linear-gradient(135deg, var(--bg-start), var(--bg-end));
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            color: var(--text-main);
        }
        .container {
            background: var(--card-bg);
            padding: 32px;
            border-radius: 16px;
            box-shadow: var(--shadow);
            width: 360px;
            border: 1px solid rgba(15,50,40,0.6);
            backdrop-filter: saturate(1.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 24px;
            font-size: 24px;
            line-height: 1.2;
            background: linear-gradient(90deg, var(--gold-500), var(--gold-700));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 0.3px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            margin: 8px 0 12px 0;
            border: 1px solid rgba(15,50,40,0.4);
            border-radius: 12px;
            background: #042a21;
            color: var(--text-main);
            transition: border-color 180ms ease, box-shadow 180ms ease, transform 120ms ease;
            outline: none;
        }
        .input-group { position: relative; }
        input:focus {
            border-color: var(--gold-500);
            box-shadow: 0 0 0 4px var(--ring);
        }
        button {
            width: 100%;
            padding: 12px 16px;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            border: none;
            border-radius: 12px;
            color: #041812;
            font-weight: 700;
            letter-spacing: 0.3px;
            cursor: pointer;
            box-shadow: 0 20px 20px rgba(0,0,0,0.6);
            transition: transform 120ms ease, box-shadow 100ms ease, filter 100ms ease;
        }
        
        button:hover {
            filter: brightness(0.98);
            box-shadow: 0 10px 24px rgba(245, 158, 11, 0.45);
            transform: translateY(-1px);
            background: linear-gradient(135deg, var(--gold-600), var(--gold-700));
            color: #111827;
        }
        button:active {
            transform: translateY(0);
            box-shadow: 0 6px 16px rgba(245, 158, 11, 0.35);
        }
        p {
            text-align: center;
            margin-top: 16px;
            color: var(--text-muted);
        }
        p a {
            color: var(--gold-500);
            font-weight: 600;
            text-decoration: none;
        }
        p a:hover {
            color: var(--gold-600);
            text-decoration: underline;
        }
        .error {
            color: #ffb4b4;
            text-align: center;
            margin-bottom: 12px;
            background: rgba(255, 20, 20, 0.06);
            border: 1px solid rgba(255,20,20,0.12);
            border-radius: 10px;
            padding: 8px 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="/auth/login">
            <input type="email" name="email" placeholder="👨‍🎓 Email" required>
            <div class="input-group">
                <input type="password" name="password" placeholder="🔐 Password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <p>Don’t have an account? <a href="/auth/register">Register</a></p>
    </div>
 
</body>
</html>
