find . -type f -name '*.php' -exec php -l {} \; |grep -v "No syntax errors detected"
find . -type f -name '*.php' -exec php -l {} \;
find . -type f -not -path "./vendor/*" -not -path "./wp-admin/*" -not -path "./wp-includes/*" -not -path "./wp-content/plugins/wordfence/*" -not -path "./wp-content/themes/twentytwenty/*" -name '*.php' -exec php -l {} \;
