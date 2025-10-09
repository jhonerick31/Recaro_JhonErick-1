<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
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
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(1200px 600px at 10% 10%, rgba(16,185,129,0.04), transparent 40%),
                radial-gradient(1200px 600px at 80% 20%, rgba(5,150,105,0.03), transparent 45%),
                linear-gradient(135deg, var(--bg-start), var(--bg-end));
            color: #111827;
        }

        /* Page container */
        body > * { box-sizing: border-box; }
    .page-wrap { max-width: 1100px; margin: 32px auto; padding: 0 20px; }

        h2 {
            text-align: center;
            margin: 12px 0 24px 0;
            font-size: 28px;
            background: linear-gradient(90deg, var(--gold-500), var(--gold-700));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 0.3px;
        }

    a { text-decoration: none; color: var(--gold-500); }
    a:hover { color: var(--gold-600); text-decoration: underline; }

    p { margin-bottom: 15px; color: var(--text-muted); text-align: center; }

        /* Search bar */
        form { margin: 20px auto; text-align: center; }
        input[type="text"] {
            padding: 12px 14px;
            width: 320px;
            max-width: 90vw;
            border: 1px solid rgba(15,50,40,0.4);
            border-radius: 12px;
            background: #042a21;
            color: var(--text-main);
            outline: none;
            transition: border-color 180ms ease, box-shadow 180ms ease;
        }
        input[type="text"]:focus { border-color: var(--gold-500); box-shadow: 0 0 0 4px var(--ring); }

        button {
            padding: 12px 18px;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            border: none;
            border-radius: 12px;
            color: #041812;
            font-weight: 700;
            letter-spacing: 0.2px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(0,0,0,0.6);
            transition: transform 120ms ease, box-shadow 200ms ease, filter 200ms ease;
        }
        button:hover { filter: brightness(0.98); box-shadow: 0 10px 24px rgba(0,0,0,0.7); transform: translateY(-1px); }
        button:active { transform: translateY(0); box-shadow: 0 6px 16px rgba(0,0,0,0.6); }

        /* Table card */
        .table-card {
            background: var(--card-bg);
            border: 1px solid rgba(10,58,47,0.6);
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: transparent;
        }
        th, td {
            border-bottom: 1px solid rgba(10,58,47,0.5);
            padding: 14px 12px;
            text-align: center;
            color: var(--text-main);
        }
        th {
            background: linear-gradient(135deg, #023027, #04352d);
            color: #dffaf0;
            font-weight: 700;
            letter-spacing: 0.3px;
        }
        tr:nth-child(even) td { background: rgba(255,255,255,0.02); }
        tr:hover td { background: rgba(16,185,129,0.03); }

        /* Buttons */
        .btn {
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 13px;
            color: #041812;
            margin: 2px;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0,0,0,0.6);
            transition: transform 120ms ease, filter 150ms ease;
        }
        .btn:hover { transform: translateY(-1px); filter: brightness(1.02); }
        .edit { background: linear-gradient(135deg, #34d399, #10b981); color: #042014; }
        .delete { background: linear-gradient(135deg, #ef4444, #b91c1c); color: #fff; }
        .restore { background: linear-gradient(135deg, #86efac, #10b981); color: #042014; }
        .hard-delete { background: linear-gradient(135deg, #ef4444, #b91c1c); color: #fff; }

        img { border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }

        /* Horizontal Pagination without bullets */
        .pagination ul {
            list-style: none;
            padding: 0;
            margin: 14px 0 0 0;
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .pagination li { display: inline-block; }

        .pagination li a,
        .pagination li span {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--gold-600);
            background: #ffffff;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        }

        .pagination li a:hover {
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            color: #111827;
            border-color: transparent;
        }

        .pagination li span.active {
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            color: #111827;
            border: 1px solid transparent;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="page-wrap">
        <h2>Students List</h2>

    <p>
        <?php if (!empty($is_admin)): ?>
            <a href="/students/create">➕ Add New Student</a> |
        <?php endif; ?>
        <a href="/auth/logout">🚪 Logout</a>
    </p>

    <!-- Toggle Active / Deleted -->
    <p>
        <?php if (!empty($is_admin)): ?>
            <?php if (!empty($show_deleted)): ?>
                <a href="/students/get-all">👥 Show Active Students</a>
            <?php else: ?>
                <a href="/students/get-all?show=deleted">🗑️ Show Deleted Students</a>
            <?php endif; ?>
        <?php endif; ?>
    </p>

    <!-- Search -->
    <form method="get" action="/students/get-all">
        <input type="hidden" name="show" value="<?= $show_deleted ? 'deleted' : 'active' ?>">
        <input type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($search ?? '') ?>">
        <input type="hidden" name="per_page" value="<?= $per_page ?>">
        <button type="submit">Search</button>
    </form>

    <div class="table-card">
    <table>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php $counter = 1; ?>
            <?php if (!empty($records)): ?>
                <?php foreach ($records as $r): ?>
                    <tr>
                        <td><?= $counter ?></td>
                        <td>
                            <?php if (!empty($r['photo'])): ?>
                                <img src="<?= $upload_url . htmlspecialchars($r['photo']) ?>" width="50" alt="Photo">
                            <?php else: ?>
                                No Photo
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($r['first_name'] . ' ' . $r['last_name']) ?></td>
                        <td><?= htmlspecialchars($r['email']) ?></td>
                        <td>
                            <?php if (!empty($is_admin)): ?>
                                <?php if (empty($show_deleted)): ?>
                                    <a class="btn edit" href="/students/update/<?= $r['id'] ?>">📝 Edit</a>
                                    <a class="btn delete" href="/students/delete/<?= $r['id'] ?>" onclick="return confirm('Delete student?')">🗑️ Delete</a>
                                <?php else: ?>
                                    <a class="btn restore" href="/students/restore/<?= $r['id'] ?>">♻️ Restore</a>
                                    <a class="btn hard-delete" href="/students/hard_delete/<?= $r['id'] ?>" onclick="return confirm('Permanently delete this student?')">❌ Hard Delete</a>
                                <?php endif; ?>
                            <?php else: ?>
                                View Only
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No records found.</td></tr>
            <?php endif; ?>
        </table>
        </div>

        <div class="pagination">
            <?= $pagination_links ?? '' ?>
        </div>
    </div>
</body>
</html>