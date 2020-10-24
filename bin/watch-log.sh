WP_CONTENT_DIR="wp-content";
DEBUG_LOG_FILENAME="debug.log";
TARGET="$WP_CONTENT_DIR/$DEBUG_LOG_FILENAME";

touch $TARGET;
rm $TARGET;
touch $TARGET;
echo "Watching $TARGET";
tail -f $TARGET;
