#!/usr/bin/env sh

set -eu

PROJECT_DIR=$(CDPATH= cd -- "$(dirname -- "$0")" && pwd)
ARTIST_ID=${1:-default}
PORT=${2:-8080}

case "$ARTIST_ID" in
    default|callii|devadata|kayl|maf|lili) ;;
    *)
        echo "Unknown artist: $ARTIST_ID"
        echo "Available artists: default, callii, devadata, kayl, maf, lili"
        exit 1
        ;;
esac

case "$PORT" in
    ''|*[!0-9]*)
        echo "Port must be a number."
        exit 1
        ;;
esac

if ! command -v php >/dev/null 2>&1; then
    echo "PHP is required but was not found."
    exit 1
fi

if [ ! -f "$PROJECT_DIR/app/environment.php" ]; then
    cp "$PROJECT_DIR/app/environment.example.php" "$PROJECT_DIR/app/environment.php"
    echo "Created app/environment.php from the example configuration."
fi

if [ ! -f "$PROJECT_DIR/public/assets/app.css" ]; then
    if ! command -v npm >/dev/null 2>&1; then
        echo "The compiled CSS is missing and npm is not available."
        exit 1
    fi

    if [ ! -d "$PROJECT_DIR/node_modules" ]; then
        echo "Installing frontend dependencies..."
        (cd "$PROJECT_DIR" && npm install)
    fi

    echo "Building Tailwind CSS..."
    (cd "$PROJECT_DIR" && npm run build)
fi

echo "Running artist '$ARTIST_ID' at http://localhost:$PORT"
echo "Press Ctrl+C to stop."

cd "$PROJECT_DIR"
exec env ARTIST_ID="$ARTIST_ID" SITE_URL="http://localhost:$PORT" php -S "localhost:$PORT" -t public
