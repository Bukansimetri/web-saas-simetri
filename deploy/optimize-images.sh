#!/usr/bin/env bash
# Recompress uploaded images in place (same filename/format, so existing URLs keep working).
# Run on the server as the web user or root:  bash optimize-images.sh /path/to/project/storage/app/public
# Backups of originals go to ./image-backup-<timestamp> next to where you run it.
set -euo pipefail

DIR="${1:?usage: optimize-images.sh <storage/app/public>}"
MAX_WIDTH=1920
QUALITY=80
BACKUP="image-backup-$(date +%Y%m%d%H%M%S)"

command -v mogrify >/dev/null || { echo "Install ImageMagick: apt-get install -y imagemagick jpegoptim optipng"; exit 1; }

mkdir -p "$BACKUP"
# Only touch files larger than 200 KB; skip conversion folders created by the media library
find "$DIR" -type f \( -iname '*.jpg' -o -iname '*.jpeg' -o -iname '*.png' \) -size +200k ! -path '*/conversions/*' -print0 |
while IFS= read -r -d '' f; do
    rel="${f#"$DIR"/}"
    mkdir -p "$BACKUP/$(dirname "$rel")"
    cp -p "$f" "$BACKUP/$rel"
    before=$(stat -c%s "$f")
    mogrify -auto-orient -strip -resize "${MAX_WIDTH}x>" -quality "$QUALITY" -interlace Plane "$f"
    after=$(stat -c%s "$f")
    # Keep the original if recompression didn't help
    if [ "$after" -ge "$before" ]; then cp -p "$BACKUP/$rel" "$f"; after=$before; fi
    echo "$rel  $((before/1024))KB -> $((after/1024))KB"
done
echo "Done. Originals saved in $BACKUP"
