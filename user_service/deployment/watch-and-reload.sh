#!/usr/bin/env bash

echo "Starting file watcher for hot reload..."

RELOAD_PENDING=false
LAST_RELOAD=0
DEBOUNCE_SECONDS=1

reload_server() {
    local current_time=$(date +%s)
    local time_since_last=$((current_time - LAST_RELOAD))
    
    if [ $time_since_last -lt $DEBOUNCE_SECONDS ]; then
        # Too soon, mark as pending
        RELOAD_PENDING=true
        return
    fi
    
    echo "Reloading Octane server..."
    php /var/www/html/artisan octane:reload
    echo "✓ Server reloaded at $(date '+%H:%M:%S')"
    LAST_RELOAD=$current_time
    RELOAD_PENDING=false
}

# Background task to handle pending reloads
(
    while true; do
        sleep $DEBOUNCE_SECONDS
        if [ "$RELOAD_PENDING" = true ]; then
            reload_server
        fi
    done
) &

# Watch specific paths
inotifywait -m -r -e modify,create,delete,move \
    --exclude '(\.git|vendor|node_modules|storage|bootstrap/cache|\..*\.swp|\..*\.swx)' \
    /var/www/html/app \
    /var/www/html/routes \
    /var/www/html/config \
    /var/www/html/.env |
while read path action file; do
    # Skip temporary files from editors
    [[ "$file" =~ ^\. ]] && continue
    [[ "$file" =~ ~$ ]] && continue
    
    echo "→ Detected $action on $file"
    reload_server
done
