#!/bin/sh
# ==========================================
# Laras Banyuwangi — Docker Entrypoint
# Runs every time the container starts
# ==========================================

set -e

# Create SQLite database file if CACHE or QUEUE uses database driver
# (prevents "database file does not exist" errors)
if [ "${CACHE_STORE:-}" = "database" ] || [ "${QUEUE_CONNECTION:-}" = "database" ] || [ "${SESSION_DRIVER:-}" = "database" ]; then
    touch /app/database/database.sqlite
    chown www-data:www-data /app/database/database.sqlite
fi

# Optimize Laravel (runtime env vars are respected here)
php artisan optimize:clear --ansi --no-interaction 2>/dev/null || true
php artisan optimize --ansi --no-interaction 2>/dev/null || true
php artisan view:cache --ansi --no-interaction 2>/dev/null || true

# Start supervisord
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
